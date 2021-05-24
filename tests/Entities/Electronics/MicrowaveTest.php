<?php

namespace Tests\Entities\Electronics;

use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;
use App\Entities\Electronics\Microwave;
use PHPUnit\Framework\TestCase;

class MicrowaveTest extends TestCase
{
    protected function setUp() : void
    {
        $this->microwave = new Microwave();
    }

    public function testGetinstanceOf()
    {
        $this->assertInstanceOf(ElectronicItem::class, $this->microwave);
        $this->assertInstanceOf(ExtraItemsInterface::class, $this->microwave);
        $this->assertInstanceOf(Microwave::class, $this->microwave);
    }

    public function testGetAmountOfExtras()
    {
        $this->assertEquals(0, $this->microwave::AMOUNT_OF_EXTRAS);
    }

    public function testMaxExtras()
    {
        $this->assertEquals(false, $this->microwave->maxExtras());
    }
}