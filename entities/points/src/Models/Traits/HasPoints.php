<?php

namespace InetStudio\AddressesPackage\Points\Models\Traits;

use ArrayAccess;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;

/**
 * Trait HasPoints.
 */
trait HasPoints
{
    use HasPointsCollection;

    /**
     * The queued points.
     *
     * @var array
     */
    protected $queuedPoints = [];

    /**
     * Get point class name.
     *
     * @return string
     *
     * @throws BindingResolutionException
     */
    public function getPointClassName(): string
    {
        $model = app()->make(PointModelContract::class);

        return get_class($model);
    }

    /**
     * Get all attached points to the model.
     *
     * @return MorphToMany
     *
     * @throws BindingResolutionException
     */
    public function points(): MorphToMany
    {
        $className = $this->getPointClassName();

        return $this->morphToMany($className, 'pointable', 'addresses_pointables')->withTimestamps();
    }

    /**
     * Attach the given point(s) to the model.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @throws BindingResolutionException
     */
    public function setPointsAttribute($points): void
    {
        if (! $this->exists) {
            $this->queuedPoints = $points;

            return;
        }

        $this->attachPoints($points);
    }

    /**
     * Boot the pointable trait for a model.
     */
    public static function bootHasPoints()
    {
        static::created(
            function (Model $pointableModel) {
                if ($pointableModel->queuedPoints) {
                    $pointableModel->attachPoints($pointableModel->queuedPoints);
                    $pointableModel->queuedPoints = [];
                }
            }
        );

        static::deleted(
            function (Model $pointableModel) {
                $pointableModel->syncPoints(null);
            }
        );
    }

    /**
     * Get the point list.
     *
     * @param  string  $keyColumn
     *
     * @return array
     *
     * @throws BindingResolutionException
     */
    public function pointList(string $keyColumn = 'hash'): array
    {
        return $this->points()->pluck('pretty_address', $keyColumn)->toArray();
    }

    /**
     * Scope query with all the given points.
     *
     * @param  Builder  $query
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     * @param  string  $column
     *
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function scopeWithAllPoints(Builder $query, $points, string $column = 'hash'): Builder
    {
        $points = $this->isPointsStringBased($points)
            ? $points : $this->hydratePoints($points)->pluck($column)->toArray();

        collect($points)->each(
            function ($point) use ($query, $column) {
                $query->whereHas(
                    'points',
                    function (Builder $query) use ($point, $column) {
                        return $query->where($column, $point);
                    }
                );
            }
        );

        return $query;
    }

    /**
     * Scope query with any of the given points.
     *
     * @param  Builder  $query
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     * @param  string  $column
     *
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function scopeWithAnyPoints(Builder $query, $points, string $column = 'hash'): Builder
    {
        $points = $this->isPointsStringBased($points)
            ? $points : $this->hydratePoints($points)->pluck($column)->toArray();

        return $query->whereHas(
            'points',
            function (Builder $query) use ($points, $column) {
                $query->whereIn($column, (array) $points);
            }
        );
    }

    /**
     * Scope query with any of the given points.
     *
     * @param  Builder  $query
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     * @param  string  $column
     *
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function scopeWithPoints(Builder $query, $points, string $column = 'hash'): Builder
    {
        return $this->scopeWithAnyPoints($query, $points, $column);
    }

    /**
     * Scope query without the given points.
     *
     * @param  Builder  $query
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     * @param  string  $column
     *
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function scopeWithoutPoints(Builder $query, $points, string $column = 'hash'): Builder
    {
        $points = $this->isPointsStringBased($points)
            ? $points : $this->hydratePoints($points)->pluck($column)->toArray();

        return $query->whereDoesntHave(
            'points',
            function (Builder $query) use ($points, $column) {
                $query->whereIn($column, (array) $points);
            }
        );
    }

    /**
     * Scope query without any points.
     *
     * @param  Builder  $query
     *
     * @return Builder
     */
    public function scopeWithoutAnyPoints(Builder $query): Builder
    {
        return $query->doesntHave('points');
    }

    /**
     * Attach the given point(s) to the model.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return $this
     *
     * @throws BindingResolutionException
     */
    public function attachPoints($points): self
    {
        $this->setPoints($points, 'syncWithoutDetaching');

        return $this;
    }

    /**
     * Sync the given point(s) to the model.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract|null  $points
     *
     * @return $this
     *
     * @throws BindingResolutionException
     */
    public function syncPoints($points): self
    {
        $this->setPoints($points, 'sync');

        return $this;
    }

    /**
     * Detach the given point(s) from the model.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return $this
     *
     * @throws BindingResolutionException
     */
    public function detachPoints($points): self
    {
        $this->setPoints($points, 'detach');

        return $this;
    }

    /**
     * Set the given point(s) to the model.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     * @param  string  $action
     *
     * @throws BindingResolutionException
     */
    protected function setPoints($points, string $action): void
    {
        // Fix exceptional event name
        $event = $action === 'syncWithoutDetaching' ? 'attach' : $action;

        // Hydrate Points
        $points = $this->hydratePoints($points)->pluck('id')->toArray();

        // Fire the Point syncing event
        static::$dispatcher->dispatch('inetstudio.addresses.points.'.$event.'ing', [$this, $points]);

        // Set Points
        $this->points()->$action($points);

        // Fire the Point synced event
        static::$dispatcher->dispatch('inetstudio.addresses.points.'.$event.'ed', [$this, $points]);
    }

    /**
     * Hydrate points.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return Collection
     *
     * @throws BindingResolutionException
     */
    protected function hydratePoints($points): Collection
    {
        $isPointsStringBased = $this->isPointsStringBased($points);
        $isPointsIntBased = $this->isPointsIntBased($points);
        $field = $isPointsStringBased ? 'hash' : 'id';
        $className = $this->getPointClassName();

        return $isPointsStringBased || $isPointsIntBased
            ? $className::query()->whereIn($field, (array) $points)->get() : collect($points);
    }
}
