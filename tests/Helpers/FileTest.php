<?php

namespace Tests\Helpers;

use App\Helpers\File;
use App\Services\ElectronicItems;
use App\Entities\Electronics\Television;
use App\Entities\Electronics\Controller;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    protected function setUp() : void
    {
        $this->file = __DIR__.'/../../storage/sorted_items.csv';

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

        $electronic = new ElectronicItems([$televisionOne]);
        $this->list = $electronic->getSortedItems();
    }

    public function testGenerateFile()
    {
        File::writeFileSorted($this->list);
        $this->assertFileExists($this->file);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }
}