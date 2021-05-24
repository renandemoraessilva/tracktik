<?php

namespace Tests\Entities\Electronics;

use App\Entities\Electronics\Console;
use App\Entities\ElectronicItem;
use App\Interfaces\ExtraItemsInterface;
use PHPUnit\Framework\TestCase;

class ConsoleTest extends TestCase
{
    protected function setUp() : void
    {
        $this->console = new Console();
    }

    public function testGetInstanceOf()
    {
        $this->assertInstanceOf(Console::class, $this->console);
        $this->assertInstanceOf(ElectronicItem::class, $this->console);
        $this->assertInstanceOf(ExtraItemsInterface::class, $this->console);
    }

    public function testGetAmountOfExtras()
    {
        $this->assertEquals(4, $this->console::AMOUNT_OF_EXTRAS);
    }

    public function testMaxExtras()
    {
        $this->assertEquals(true, $this->console->maxExtras());

        $this->console->setExtras(new ElectronicItem());
        $this->console->setExtras(new ElectronicItem());
        $this->console->setExtras(new ElectronicItem());

        $this->assertEquals(true, $this->console->maxExtras());

        $this->console->setExtras(new ElectronicItem());

        $this->assertEquals(false, $this->console->maxExtras());
    }

    public function testGetExtras()
    {
        $this->console->setExtras(new ElectronicItem());
        $this->console->setExtras(new ElectronicItem());

        $this->assertEquals(2, count($this->console->getExtras()));
    }
}