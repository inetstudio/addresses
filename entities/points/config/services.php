<?php

return [

    /*
     * URL для получения информации по адресу.
     */

    'ahunter' => [
        'search_url' => 'https://ahunter.ru/site/cleanse/address?user='.env('AHUNTER_USER').';output=json|pretty|acover|ageo|acodes|adict|afiasall|aqual|apretty|status|ainabr|astations;mode=search;query=',
    ],
];
