<?php

namespace InetStudio\AddressesPackage\Points\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\AddressesPackage\Points\Contracts\Models\PointModelContract;
use InetStudio\AddressesPackage\Points\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var PointModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  PointModelContract  $item
     */
    public function __construct(PointModelContract $item)
    {
        $this->item = $item;
    }
}
