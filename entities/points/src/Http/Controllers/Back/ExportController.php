<?php

namespace InetStudio\AddressesPackage\Points\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back\ExportControllerContract;

/**
 * Class ExportController.
 */
class ExportController extends Controller implements ExportControllerContract
{
    /**
     * Выгружаем объекты.
     *
     * @param  string  $pointType
     *
     * @return BinaryFileResponse
     *
     * @throws BindingResolutionException
     */
    public function exportItems(string $pointType = ''): BinaryFileResponse
    {
        $export = app()->make(
            'InetStudio\AddressesPackage\Points\Contracts\Exports\ItemsExportContract',
            compact('pointType')
        );

        return Excel::download($export, time().'.xlsx');
    }
}
