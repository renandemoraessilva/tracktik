<?php

namespace Tests\Entities\Electronics;

use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;
use App\Entities\Electronics\Television;
use PHPUnit\Framework\TestCase;

class TelevisionTest extends TestCase
{
    protected function setUp() : void 
    {
        $this->television = new Television();
    }

    public function testGetInstanceOf()
    {
        $this->assertInstanceOf(ElectronicItem::class, $this->television);
        $this->assertInstanceOf(ExtraItemsInterface::class, $this->television);
        $this->assertInstanceOf(Television::class, $this->television);
    }

    public function testGetAmountOfExtras()
    {
        $this->assertEquals('unlimited', $this->television::AMOUNT_OF_EXTRAS);
    }

    public function testMaxExtras()
    {
        $this->assertEquals(true, $this->television->maxExtras());

        $this->television->setExtras(new ElectronicItem());
        $this->television->setExtras(new ElectronicItem());
        $this->television->setExtras(new ElectronicItem());

        $this->assertEquals(true, $this->television->maxExtras());

        $this->television->setExtras(new ElectronicItem());

        $this->assertEquals(true, $this->television->maxExtras());
    }

    public function testGetExtras()
    {
        $this->television->setExtras(new ElectronicItem());
        $this->television->setExtras(new ElectronicItem());

        $this->assertEquals(2, count($this->television->getExtras()));
    }
}