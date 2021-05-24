<?php

namespace Tests\Entities\Electronics;

use App\Entities\Electronics\Controller;
use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    protected function setUp() : void
    {
        $this->controller = new Controller();
    }

    public function testGetInstanceOf()
    {
        $this->assertInstanceOf(Controller::class, $this->controller);
        $this->assertInstanceOf(ElectronicItem::class, $this->controller);
        $this->assertInstanceOf(ExtraItemsInterface::class, $this->controller);
    }

    public function testGetAmountOfExtras()
    {
        $this->assertEquals(0, $this->controller::AMOUNT_OF_EXTRAS);
    }

    public function testMaxExtras()
    {
        $this->assertEquals(false, $this->controller->maxExtras());
    }
}