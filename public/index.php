<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Imankubbil\TraceTracking\Routes\Router;
use Imankubbil\TraceTracking\Controller\HomeController;

Router::add('GET', '/', HomeController::class, 'index');

Router::run();

?>