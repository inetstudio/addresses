<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\AddressesPackage\Points\Contracts\Services\Back\DataTableServiceContract;

/**
 * Interface DataControllerContract.
 */
interface DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param  DataTableServiceContract  $dataTableService
     *
     * @return JsonResponse
     */
    public function data(DataTableServiceContract $dataTableService): JsonResponse;
}
