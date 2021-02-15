<?php

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/../bootstrap.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new App\Container;

$router = $container->get('App\HttpRouter');

$router
    ->add(
        url: '/',
        namespace: 'App\Controller\HomePageController::index',
    )
    ->add(
        url: '/admin',
        namespace: 'App\Controller\Admin\LoginPageController::index',
    )
    ->add(
        url: '/admin/login',
        namespace: 'App\Controller\Admin\LoginPageController::post',
        methods: ["POST"],
    )
    ->add(
        url: '/product',
        namespace: 'App\Controller\ProductPageController::index',
    )
;

$container->executeMethod($router->process() ?? 'App\Controller\ErrorPageController::index');

