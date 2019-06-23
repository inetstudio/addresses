<?php

namespace InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AddressesPackage\Points\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  Request  $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract;
}
