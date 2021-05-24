<?php

namespace App\Entities\Electronics;

use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;

/**
 * Class responsible for the television
 */
class Television extends ElectronicItem implements ExtraItemsInterface
{
    /**
     * The amount of extra allowed
     */
    const AMOUNT_OF_EXTRAS = "unlimited";

    /**
     * Store the extra item
     * 
     * @var array
     */
    private $extras = array();

    /**
     * Responsible method for checking whether extra items are allowed or not
     * 
     * @return bool
     */
    public function maxExtras() : bool
    {
        return true;
    }

    /**
     * Set the extra items in an array
     * 
     * @return void
     */
    public function setExtras(ElectronicItem $item) : void
    {
        $this->extras[] = $item;
    }

    /**
     * Return the extras
     * 
     * @return array
     */
    public function getExtras() : array
    {
        return $this->extras;
    }

    /**
     * Count the amount of extras added
     * 
     * @return int
     */
    public function countExtras() : int
    {
        return count($this->extras);
    }

}