<?php

namespace App\Services;

use App\Entities\ElectronicItem;

class ElectronicItems
{

    /**
     * Store the items list
     * 
     * @var array
     */
    private $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns an array sorted by value
     *
     * @return array
     */
    public function getSortedItems()
    {
        $sorted = array();

        foreach ($this->items as $item) {
            $sorted[($item->getPrice() * 100)] = $item;
        }

        ksort($sorted, SORT_NUMERIC);

        return $sorted;
    }

    /**
     * Get items by type
     * 
     * @param string $type
     * @return array|bool
     */
    public function getItemsByType($type)
    {

        if (in_array($type, ElectronicItem::$types)) {
            
            $callback = function($item) use ($type) {
                return $item->getType() == $type;
            };

            return array_filter($this->items, $callback);
        }

        return false;
    }

    /**
     * Get total price of items ordered
     * 
     * @return float
     */
    public function getTotalPrice() : float
    {
        $total = 0.00;

        foreach ($this->items as $item) {
            // adding the items value
            $total += $item->getPrice();

            // adding the value of extras
            if ($item::AMOUNT_OF_EXTRAS != 0 && !empty($item->getExtras())) {
                $total += $this->getTotalPriceOfExtras($item->getExtras());
            }
        }

        // formating the number
        return number_format($total, 2, '.', '');
    }

    /**
     * Get total price by type of item with the sum of extras
     * 
     * @return float
     */
    public function getTotalPriceByType(string $type) : float
    {
        $total = 0.00;

        // getting the items by type
        $items = $this->getItemsByType($type);

        // checking if the item is returned
        if (!$items) {
            return $total;
        }

        foreach ($items as $item) {
            // adding the items value
            $total += $item->getPrice();

            // adding the value of extras
            if ($item::AMOUNT_OF_EXTRAS != 0 && !empty($item->getExtras())) {
                $total += $this->getTotalPriceOfExtras($item->getExtras());
            }
        }

        // formating the number
        return number_format($total, 2, '.', '');
    }

    /**
     * Getting the total price of extras
     * 
     * @return float
     */
    private function getTotalPriceOfExtras(array $extras) : float
    {
        $total = 0.00;

        foreach ($extras as $item) {
            // adding the extra value
            $total += $item->getPrice();
        }

        // formating the number
        return number_format($total, 2, '.', '');
    }
}