<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ExportControllerContract.
 */
interface ExportControllerContract
{
    /**
     * Выгружаем объекты.
     *
     * @param  string  $pointType
     *
     * @return BinaryFileResponse
     */
    public function exportItems(string $pointType = ''): BinaryFileResponse;
}
