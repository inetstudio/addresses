<?php

namespace InetStudio\AddressesPackage\Points\Models\Traits;

use ArrayAccess;
use Illuminate\Support\Collection;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;

/**
 * Trait HasPointsCollection.
 */
trait HasPointsCollection
{
    /**
     * Determine if the model has any the given points.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return bool
     */
    public function hasPoint($points): bool
    {
        if ($this->isPointsStringBased($points)) {
            return ! $this->points->pluck('hash')->intersect((array) $points)->isEmpty();
        }

        if ($this->isPointsIntBased($points)) {
            return ! $this->points->pluck('id')->intersect((array) $points)->isEmpty();
        }

        if ($points instanceof PointModelContract) {
            return $this->points->contains('hash', $points['hash']);
        }

        if ($points instanceof Collection) {
            return ! $points->intersect($this->points->pluck('hash'))->isEmpty();
        }

        return false;
    }

    /**
     * Determine if the model has any the given points.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return bool
     */
    public function hasAnyPoint($points): bool
    {
        return $this->hasPoint($points);
    }

    /**
     * Determine if the model has all of the given points.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return bool
     */
    public function hasAllPoints($points): bool
    {
        if ($this->isPointsStringBased($points)) {
            $points = (array) $points;

            return $this->points->pluck('hash')->intersect($points)->count() == count($points);
        }

        if ($this->isPointsIntBased($points)) {
            $points = (array) $points;

            return $this->points->pluck('id')->intersect($points)->count() == count($points);
        }

        if ($points instanceof PointModelContract) {
            return $this->points->contains('hash', $points['hash']);
        }

        if ($points instanceof Collection) {
            return $this->points->intersect($points)->count() == $points->count();
        }

        return false;
    }

    /**
     * Determine if the given point(s) are string based.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return bool
     */
    protected function isPointsStringBased($points): bool
    {
        return is_string($points) || (is_array($points) && isset($points[0]) && is_string($points[0]));
    }

    /**
     * Determine if the given point(s) are integer based.
     *
     * @param  int|string|array|ArrayAccess|PointModelContract  $points
     *
     * @return bool
     */
    protected function isPointsIntBased($points): bool
    {
        return is_int($points) || (is_array($points) && isset($points[0]) && is_int($points[0]));
    }
}
