<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return PointModelContract
     */
    public function save(array $data, int $id): PointModelContract;
}
