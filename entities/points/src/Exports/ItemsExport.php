<?php

namespace InetStudio\AddressesPackage\Points\Exports;

use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\AddressesPackage\Points\Contracts\Exports\ItemsExportContract;

/**
 * Class ItemsExport.
 */
class ItemsExport implements ItemsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var string
     */
    protected $pointType = '';

    /**
     * ItemsExport constructor.
     *
     * @param  string  $pointType
     */
    public function __construct(string $pointType = '')
    {
        $this->pointType = $pointType;
    }

    /**
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function query()
    {
        $itemsService = app()->make(
            'InetStudio\ChecksContest\Checks\Contracts\Services\Back\ItemsServiceContract'
        );

        return ($this->pointType)
            ? $itemsService->getModel()->where('point_type', $this->pointType)
            : $itemsService->getModel()->query();
    }

    /**
     * @param $point
     *
     * @return array
     */
    public function map($point): array
    {
        return [
            $point->id,
            $point->point_type,
            $point->pretty_address,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Тип',
            'Адрес',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
