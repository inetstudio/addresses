<?php

namespace InetStudio\AddressesPackage\Points\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;
use InetStudio\AddressesPackage\Points\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var PointModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  PointModelContract  $item
     */
    public function __construct(PointModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        return response()->redirectToRoute(
            'back.addresses.points.edit',
            [
                $item['id'],
            ]
        );
    }
}
