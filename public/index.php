<?php

declare(strict_types=1);

use PragmaGoTech\Interview\Application;
use PragmaGoTech\Interview\Input\InputHandler;

require_once dirname(__DIR__).'/vendor/autoload.php';

$inputHandler = new InputHandler();
$app = new Application($inputHandler);
$app->run();
