<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Services\Front;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Возвращаем точки для карты.
     *
     * @param  string  $pointType
     *
     * @return array
     */
    public function getMapPoints(string $pointType = ''): array;

    /**
     * Возвращаем пустую коллекцию точек.
     *
     * @return array
     */
    public function getEmptyMapCollection(): array;
}
