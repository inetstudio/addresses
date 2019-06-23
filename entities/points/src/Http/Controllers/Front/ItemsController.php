<?php

namespace InetStudio\AddressesPackage\Points\Http\Controllers\Front;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\AddressesPackage\Points\Services\Front\ItemsService;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Front\MapPointsResponseContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Front\ItemsControllerContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Возвращаем точки для карты.
     *
     * @param  ItemsService  $pointsService
     * @param  string  $pointType
     *
     * @return MapPointsResponseContract
     *
     * @throws BindingResolutionException
     */
    public function getMapPoints(ItemsService $pointsService, string $pointType = ''): MapPointsResponseContract
    {
        $points = $pointsService->getMapPoints($pointType);

        return $this->app->make(
            MapPointsResponseContract::class,
            [
                'data' => compact('points'),
            ]
        );
    }
}
