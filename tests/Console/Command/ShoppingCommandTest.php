<?php

namespace Tests\Console\Command;

use App\Console\Command\ShoppingCommand;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;

class ShoppingCommandTest extends TestCase
{
    protected function setUp() : void
    {
        $this->file = __DIR__.'/../../storage/sorted_items.csv';
    }

    public function testExecute()
    {
        $commandTester = new CommandTester(new ShoppingCommand());
        $commandTester->execute([]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        
        $this->assertStringContainsString('The total pricing is', $output);
        $this->assertStringContainsString('The total cost of ', $output);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }
}