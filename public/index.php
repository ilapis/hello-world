<?php

include __DIR__ . "/../bootstrap.php";

$container = new App\Container;

$container->executeMethod('App\Controller\HomePageController::index');
//$container->executeMethod('App\Controller\ProductPageController::index');

