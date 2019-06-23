<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Front;

use InetStudio\AddressesPackage\Points\Services\Front\ItemsService;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Front\MapPointsResponseContract;

/**
 * Interface ItemsControllerContract.
 */
interface ItemsControllerContract
{
    /**
     * Возвращаем точки для карты.
     *
     * @param  ItemsService  $pointsService
     * @param  string  $pointType
     *
     * @return MapPointsResponseContract
     */
    public function getMapPoints(ItemsService $pointsService, string $pointType = ''): MapPointsResponseContract;
}
