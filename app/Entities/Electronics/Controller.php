<?php

namespace App\Entities\Electronics;

use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;

/**
 * Class responsible for the controller
 */
class Controller extends ElectronicItem implements ExtraItemsInterface
{
    /**
     * The amount of extra allowed
     */
    const AMOUNT_OF_EXTRAS = 0;


    /**
     * Responsible method for checking whether extra items are allowed or not
     * 
     * @return bool
     */
    public function maxExtras(): bool
    {
        if (self::AMOUNT_OF_EXTRAS == 0) {
            return false;
        }

        return true;
    }
}