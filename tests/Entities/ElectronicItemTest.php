<?php

namespace Tests\Entities;

use App\Entities\ElectronicItem;
use PHPUnit\Framework\TestCase;

class ElectronicItemTest extends TestCase
{
    protected function setUp() : void
    {
        $this->electronicItem = new ElectronicItem();
    }

    public function testGetInstanceOf()
    {
        $this->assertInstanceOf(ElectronicItem::class, $this->electronicItem);
    }

    public function testSetPrice()
    {
        $this->electronicItem->setPrice(19.33);

        $this->assertEquals(19.33, $this->electronicItem->getPrice());
    }

    public function testSetWired()
    {
        $this->electronicItem->setWired('yes');

        $this->assertEquals('yes', $this->electronicItem->getWired());
    }

    public function testSetType()
    {
        $this->electronicItem->setType('controller');

        $this->assertEquals('controller', $this->electronicItem->getType());
    }
}