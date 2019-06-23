<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back;

use InetStudio\AddressesPackage\Points\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\AddressesPackage\Points\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Requests\Back\SaveItemRequestContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

/**
 * Interface ResourceControllerContract.
 */
interface ResourceControllerContract
{
    /**
     * Список объектов.
     *
     * @param  DataTableServiceContract  $dataTableService
     *
     * @return IndexResponseContract
     */
    public function index(DataTableServiceContract $dataTableService): IndexResponseContract;

    /**
     * Создание объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     *
     * @return FormResponseContract
     */
    public function create(ItemsServiceContract $resourceService): FormResponseContract;

    /**
     * Создание объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  SaveItemRequestContract  $request
     *
     * @return SaveResponseContract
     */
    public function store(ItemsServiceContract $resourceService, SaveItemRequestContract $request): SaveResponseContract;

    /**
     * Редактирование объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  int  $id
     *
     * @return FormResponseContract
     */
    public function edit(ItemsServiceContract $resourceService, int $id = 0): FormResponseContract;

    /**
     * Обновление объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  SaveItemRequestContract  $request
     * @param  int  $id
     *
     * @return SaveResponseContract
     */
    public function update(
        ItemsServiceContract $resourceService,
        SaveItemRequestContract $request,
        int $id = 0
    ): SaveResponseContract;

    /**
     * Удаление объекта.
     *
     * @param  ItemsServiceContract  $resourceService
     * @param  int  $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(ItemsServiceContract $resourceService, int $id = 0): DestroyResponseContract;
}
