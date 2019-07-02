<?php

namespace InetStudio\AddressesPackage\Points\Services\Front;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;
use InetStudio\AddressesPackage\Points\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  PointModelContract  $model
     */
    public function __construct(PointModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Возвращаем точки для карты.
     *
     * @param  string  $pointType
     *
     * @return array
     */
    public function getMapPoints(string $pointType = ''): array
    {
        $points = $this->getPoints($pointType);

        $items = $points->map(function ($point, $key) {
            $address = str_replace(
                ['г ', 'ул ', 'обл ', 'Респ ', 'ш ', 'пл ', 'мкр ', 'корп ', 'стр ', 'пер ', 'корп ', 'наб '],
                [
                    'г. ',
                    'ул. ',
                    'обл. ',
                    'Респ. ',
                    'ш. ',
                    'пл. ',
                    'мкр. ',
                    'корп. ',
                    'стр. ',
                    'пер. ',
                    'корп. ',
                    'наб. ',
                ],
                $point->pretty_address
            );

            return array_merge([
                'type' => 'Feature',
                'id' => $key + 1,
                'address_id' => $point->id,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        trim($point->lat),
                        trim($point->lon),
                    ],
                ],
                'name' => $address,
                'address' => $address,
                'city' => str_replace('г. ', '', $point->city ?? $point->region),
            ], $point->additional_info);
        });

        $data = [
            'type' => 'FeatureCollection',
            'features' => $items,
        ];

        return $data;
    }

    /**
     * Возвращаем пустую коллекцию точек.
     *
     * @return array
     */
    public function getEmptyMapCollection(): array
    {
        return [
            'type' => 'FeatureCollection',
            'features' => [],
        ];
    }

    /**
     * Выбираем точки по типу.
     *
     * @param  string  $pointType
     *
     * @return Collection
     */
    protected function getPoints(string $pointType = ''): Collection
    {
        return $this->model->buildQuery(
            [
                'columns' => ['region', 'lat', 'lon', 'additional_info'],
            ]
        )->where(
            [
                ['point_type', '=', $pointType],
                ['quality', '=', 100],
            ]
        )->get();
    }
}
