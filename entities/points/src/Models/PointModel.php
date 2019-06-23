<?php

namespace InetStudio\AddressesPackage\Points\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\AdminPanel\Models\Traits\HasJSONColumns;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;

/**
 * Class PointModel.
 */
class PointModel extends Model implements PointModelContract
{
    use SoftDeletes;
    use HasJSONColumns;
    use BuildQueryScopeTrait;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'addresses_point';

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'addresses_points';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'point_type',
        'user_address',
        'pretty_address',
        'region',
        'district',
        'city',
        'street',
        'house',
        'building',
        'structure',
        'flat',
        'zip',
        'lat',
        'lon',
        'quality',
        'additional_info',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы к базовым типам.
     *
     * @var array
     */
    protected $casts = [
        'additional_info' => 'array',
    ];

    /**
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id', 'point_type', 'pretty_address', 'city', 'quality', 'additional_info',
        ];
    }

    /**
     * Сеттер атрибута point_type.
     *
     * @param $value
     */
    public function setPointTypeAttribute($value): void
    {
        $this->attributes['point_type'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_address.
     *
     * @param $value
     */
    public function setUserAddressAttribute($value): void
    {
        $this->attributes['user_address'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута pretty_address.
     *
     * @param $value
     */
    public function setPrettyAddressAttribute($value): void
    {
        $this->attributes['pretty_address'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута region.
     *
     * @param $value
     */
    public function setRegionAttribute($value): void
    {
        $this->attributes['region'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута district.
     *
     * @param $value
     */
    public function setDistrictAttribute($value): void
    {
        $this->attributes['district'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута city.
     *
     * @param $value
     */
    public function setCityAttribute($value): void
    {
        $this->attributes['city'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута street.
     *
     * @param $value
     */
    public function setStreetAttribute($value): void
    {
        $this->attributes['street'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута house.
     *
     * @param $value
     */
    public function setHouseAttribute($value): void
    {
        $this->attributes['house'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута building.
     *
     * @param $value
     */
    public function setBuildingAttribute($value): void
    {
        $this->attributes['building'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута structure.
     *
     * @param $value
     */
    public function setStructureAttribute($value): void
    {
        $this->attributes['structure'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута flat.
     *
     * @param $value
     */
    public function setFlatAttribute($value): void
    {
        $this->attributes['flat'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута zip.
     *
     * @param $value
     */
    public function setZipAttribute($value): void
    {
        $this->attributes['zip'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута lat.
     *
     * @param $value
     */
    public function setLatAttribute($value): void
    {
        $this->attributes['lat'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута lon.
     *
     * @param $value
     */
    public function setLonAttribute($value): void
    {
        $this->attributes['lon'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута quality.
     *
     * @param $value
     */
    public function setQualityAttribute($value): void
    {
        $this->attributes['quality'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута additional_info.
     *
     * @param $value
     */
    public function setAdditionalInfoAttribute($value): void
    {
        $this->attributes['additional_info'] = json_encode((array) $value);
    }

    /**
     * Геттер атрибута type.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }
}
