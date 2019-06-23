<?php

namespace InetStudio\AddressesPackage\Points\Http\Responses\Front;

use Illuminate\Http\Request;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Front\MapPointsResponseContract;

/**
 * Class MapPointsResponse.
 */
class MapPointsResponse implements MapPointsResponseContract
{
    /**
     * @var array
     */
    protected $data;

    /**
     * MapPointsResponse constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем точки для карты.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->data);
    }
}
