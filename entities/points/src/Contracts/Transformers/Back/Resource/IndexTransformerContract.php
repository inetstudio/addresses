<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Transformers\Back\Resource;

use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  PointModelContract  $item
     *
     * @return array
     */
    public function transform(PointModelContract $item): array;
}
