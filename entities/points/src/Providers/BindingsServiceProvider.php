<?php

namespace InetStudio\AddressesPackage\Points\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        'InetStudio\AddressesPackage\Points\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\AddressesPackage\Points\Events\Back\ModifyItemEvent',
        'InetStudio\AddressesPackage\Points\Contracts\Exports\ItemsExportContract' => 'InetStudio\AddressesPackage\Points\Exports\ItemsExport',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\AddressesPackage\Points\Http\Controllers\Back\ResourceController',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\AddressesPackage\Points\Http\Controllers\Back\DataController',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back\ExportControllerContract' => 'InetStudio\AddressesPackage\Points\Http\Controllers\Back\ExportController',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\AddressesPackage\Points\Http\Controllers\Back\UtilityController',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\AddressesPackage\Points\Http\Controllers\Front\ItemsController',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\AddressesPackage\Points\Http\Requests\Back\SaveItemRequest',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Front\MapPointsResponseContract' => 'InetStudio\AddressesPackage\Points\Http\Responses\Front\MapPointsResponse',
        'InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract' => 'InetStudio\AddressesPackage\Points\Models\PointModel',
        'InetStudio\AddressesPackage\Points\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\AddressesPackage\Points\Services\Back\DataTableService',
        'InetStudio\AddressesPackage\Points\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\AddressesPackage\Points\Services\Back\ItemsService',
        'InetStudio\AddressesPackage\Points\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\AddressesPackage\Points\Services\Back\UtilityService',
        'InetStudio\AddressesPackage\Points\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\AddressesPackage\Points\Services\Front\ItemsService',
        'InetStudio\AddressesPackage\Points\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\AddressesPackage\Points\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\AddressesPackage\Points\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\AddressesPackage\Points\Transformers\Back\Utility\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
