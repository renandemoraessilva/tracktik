<?php

namespace Tests\Services;

use App\Services\ElectronicItems;
use App\Entities\Electronics\Television;
use App\Entities\Electronics\Controller;
use App\Entities\Electronics\Microwave;
use PHPUnit\Framework\TestCase;

class ElectronicItemsTest extends TestCase
{
    protected function setUp() : void
    {
        $televisionOne = new Television();
        $televisionOne->setType('television');
        $televisionOne->setPrice(920.90);

        $televisionOneExtras = array(
            ['type' => 'controller', 'price' => 15.50, 'wired' => 'no'],
            ['type' => 'controller', 'price' => 13.20, 'wired' => 'no'],
        );

        foreach ($televisionOneExtras as $extra) {
            if ($televisionOne->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                $televisionOne->setExtras($controller);
            }
        }

        $televisionTwo = new Television();
        $televisionTwo->setType('television');
        $televisionTwo->setPrice(700.45);

        $televisionTwoExtras = array(
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
        );

        foreach ($televisionTwoExtras as $extra) {
            if ($televisionTwo->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                $televisionTwo->setExtras($controller);
            }
        }

        $microwave = new Microwave();
        $microwave->setType('microwave');
        $microwave->setPrice(75.50);

        $this->electronic = new ElectronicItems([$televisionOne, $televisionTwo, $microwave]);
    }

    public function testGetInstanceOf()
    {
        $this->assertInstanceOf(ElectronicItems::class, $this->electronic);
    }

    public function testGetSorteItems()
    {
        $sorted = $this->electronic->getSortedItems();
        $first = array_shift($sorted);

        $this->assertEquals(75.50, $first->getPrice());
    }


    public function testGetItemsByType()
    {
        $result = $this->electronic->getItemsByType('laptop');
        $this->assertEquals(false, $result);

        $result = $this->electronic->getItemsByType('television');
        $this->assertEquals(2, count($result));

        $result = $this->electronic->getItemsByType('microwave');
        $this->assertEquals(1, count($result));
    }

    public function testGetTotalPrice()
    {
        $result = $this->electronic->getTotalPrice();
        $this->assertEquals(1738.35, $result);
    }

    public function testGetTotalPriceByType()
    {
        $result = $this->electronic->getTotalPriceByType('laptop');
        $this->assertEquals(0.00, $result);

        $result = $this->electronic->getTotalPriceByType('microwave');
        $this->assertEquals(75.50, $result);

        $result = $this->electronic->getTotalPriceByType('television');
        $this->assertEquals(1662.85, $result);
    }
}