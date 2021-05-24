<?php

namespace App\Interfaces;

use App\Entities\ElectronicItem;

interface ExtraItemsInterface
{
    /**
     * This function will check whether it is allowed or not to obtain more items from certain electronics
     */
    public function maxExtras() : bool;
}