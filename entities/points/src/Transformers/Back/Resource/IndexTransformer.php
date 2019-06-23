<?php

namespace InetStudio\AddressesPackage\Points\Transformers\Back\Resource;

use Throwable;
use League\Fractal\TransformerAbstract;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;
use InetStudio\AddressesPackage\Points\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends TransformerAbstract implements IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  PointModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(PointModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'point_type' => $item['point_type'],
            'pretty_address' => $item['pretty_address'],
            'additional_info' => view(
                    'admin.module.addresses.points::back.partials.datatables.additional_info',
                    compact('item')
                )
                ->render(),
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'actions' => view(
                'admin.module.addresses.points::back.partials.datatables.actions',
                compact('item')
                )
                ->render(),
        ];
    }
}
