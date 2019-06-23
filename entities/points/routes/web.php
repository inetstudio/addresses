<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back',
    ],
    function () {
        Route::any('points/data', 'DataControllerContract@data')
            ->name('back.addresses.points.data.index');

        Route::post('points/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.addresses.points.getSuggestions');

        Route::get('points/export', 'ExportControllerContract@exportItems')
            ->name('back.addresses.points.export');

        Route::resource(
            'points',
            'ResourceControllerContract',
            [
                'except' => [
                    'show',
                ],
                'as' => 'back.addresses',
            ]
        );
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\AddressesPackage\Points\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
        'prefix' => 'addresses',
    ],
    function () {
        Route::any('points/{pointType?}', 'ItemsControllerContract@getMapPoints')->name('front.addresses.points.get');
    }
);
