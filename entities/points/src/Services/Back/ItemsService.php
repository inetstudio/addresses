<?php

namespace InetStudio\AddressesPackage\Points\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;
use InetStudio\AddressesPackage\Points\Contracts\Services\Back\ItemsServiceContract;

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
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return PointModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): PointModelContract
    {
        $action = ($id) ? 'отредактирована' : 'создана';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        event(
            app()->make(
                'InetStudio\AddressesPackage\Points\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Точка «'.$item->pretty_address.'» успешно '.$action);

        return $item;
    }
}
