<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Console\Command\ShoppingCommand;

$application = new Application();

// adding the command to run
$application->add(new ShoppingCommand());
$application->run();