<?php

namespace App\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\Entities\Electronics\Console;
use App\Entities\Electronics\Controller;
use App\Entities\Electronics\Microwave;
use App\Entities\Electronics\Television;

use App\Services\ElectronicItems;
use App\Helpers\File;

class ShoppingCommand extends Command
{
    /**
     * The name of the command
     */
    protected static $defaultName = 'command:shopping';

    /**
     * The configuration of the command
     * 
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Command for making purchases and displaying purchased items.')
            ->setHelp(
                'Runnig the command the purchases will be executed and the ordered list of ' . 
                'items and the total value will be displayed.'
            );
    }

    /**
     * Executing the process to make the purchases and display the purchased items
     * 
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // creating the console instance
        $console = new Console();
        $console->setType('console');
        $console->setPrice(200.00);

        // extras array for the console
        $consoleExtras = array(
            ['type' => 'controller', 'price' => 78.56, 'wired' => 'yes'],
            ['type' => 'controller', 'price' => 78.56, 'wired' => 'yes'],
            ['type' => 'controller', 'price' => 80.00, 'wired' => 'no'],
            ['type' => 'controller', 'price' => 80.00, 'wired' => 'no']
        );

        foreach ($consoleExtras as $extra) {
            // validating the amount of extras allowed
            if ($console->maxExtras()) {
                // creating the instance of the extras and adding to the console
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                // adding the extra
                $console->setExtras($controller);
            } else {
                // reached the allowed extras limit, displays a message to the user
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for console.", 
                    $extra['type'], 
                    number_format($extra['price'], 2, '.', ''), 
                    $extra['wired']
                ));
            }
        }

        // creating the television one instance
        $televisionOne = new Television();
        $televisionOne->setType('television');
        $televisionOne->setPrice(999.90);

        // extras array for the television one
        $televisionOneExtras = array(
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
        );

        foreach ($televisionOneExtras as $extra) {
            // validating the amount of extras allowed
            if ($televisionOne->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                // adding the extra
                $televisionOne->setExtras($controller);
            } else {
                // reached the allowed extras limit, displays a message to the user
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for television one.", 
                    $extra['type'], 
                    number_format($extra['price'], 2, '.', ''), 
                    $extra['wired']
                ));
            }
        }

        // creating the television two instance
        $televisionTwo = new Television();
        $televisionTwo->setType('television');
        $televisionTwo->setPrice(700.45);
        
        // extras array for the television two
        $televisionTwoExtras = array(
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
        );

        foreach ($televisionTwoExtras as $extra) {
            // validating the amount of extras allowed
            if ($televisionTwo->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                // adding the extra
                $televisionTwo->setExtras($controller);
            } else {
                // reached the allowed extras limit, displays a message to the user
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for television two.", 
                    $extra['type'], 
                    number_format($extra['price'], 2, '.', ''), 
                    $extra['wired']
                ));
            }
        }

        // creating the microwave instance
        $microwave = new Microwave();
        $microwave->setType('microwave');
        $microwave->setPrice(75.50);

        // calling the service to handle some aspects of this shopping list
        $electronicItems = new ElectronicItems([
            $console,
            $televisionOne,
            $televisionTwo,
            $microwave
        ]);
        
        // getting the sorted list of items by price
        $sortedItems = $electronicItems->getSortedItems();

        // saving the sorted list to a file
        File::writeFileSorted($sortedItems);

        // showing the total price
        $output->writeln(sprintf("The total pricing is: $%s", $electronicItems->getTotalPrice()));

        // showing the total price per type with the sum of extras
        $output->writeln(sprintf("The total cost of the console and its controllers is: $%s", $electronicItems->getTotalPriceByType('console')));

        return Command::SUCCESS;
    }
}