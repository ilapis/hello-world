<?php

session_start();

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/../bootstrap.php";

use App\Security\Roles;
use App\Security\Access;

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
        url: '/admin/logout',
        namespace: 'App\Controller\Admin\LoginPageController::logout',
    )
    ->add(
        url: '/admin/dashboard',
        namespace: 'App\Controller\Admin\DashboardPageController::index',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    ->add(
        url: '/admin/article',
        namespace: 'App\Controller\Admin\ArticlePageController::index',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    ->add(
        url: '/product',
        namespace: 'App\Controller\ProductPageController::index',
    )
    ->add(
        url: '/product',
        namespace: 'App\Controller\ProductPageController::index',
    )
;

$container->executeMethod($router->process() ?? 'App\Controller\ErrorPageController::index');

