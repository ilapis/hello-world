<?php

use App\Security\Roles;
use App\Security\Access;

$router = $container->get('App\HttpRouter');

$router
    ->add(
        url: '/',
        namespace: 'App\Controller\HomePageController::index',
    )
    ->add(
        url: '/admin',
        namespace: 'App\Controller\Admin\LoginPageController::index',
        redirect: '/admin/login'
    )
    ->add(
        url: '/admin/login',
        namespace: 'App\Controller\Admin\LoginPageController::index',
        methods: ["GET"],
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
    /* Default controller get index */
    ->add(
        url: '/admin/{CONTROLLER}',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::index',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller get index */
    ->add(
        url: '/admin/{CONTROLLER}/list',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::list',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller get create */
    ->add(
        url: '/admin/{CONTROLLER}/create',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::create',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller post save */
    ->add(
        url: '/admin/{CONTROLLER}/save',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::save',
        methods: ["POST"],
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller get edit */
    ->add(
        url: '/admin/{CONTROLLER}/edit/:id',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::edit',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller patch update */
    ->add(
        url: '/admin/{CONTROLLER}/update/:id',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::update',
        methods: ["POST"],
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller get delete confirmation */
    ->add(
        url: '/admin/{CONTROLLER}/delete/:id',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::deleteConfirmation',
        methods: ["GET"],
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller delete */
    ->add(
        url: '/admin/{CONTROLLER}/delete/:id',
        namespace: 'App\Controller\Admin\{CONTROLLER}PageController::delete',
        methods: ["DELETE"],
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    /* Default controller get index */
    ->add(
        url: '/admin/{FOLDER}/{CONTROLLER}',
        namespace: 'App\Controller\Admin\{FOLDER}\{CONTROLLER}PageController::index',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    ->add(
        url: '/admin/{FOLDER}/{CONTROLLER}/{ACTION}',
        namespace: 'App\Controller\Admin\{FOLDER}\{CONTROLLER}PageController::{ACTION}',
        access: [ACCESS::ADMIN],
        roles: [ROLES::ADMINISTRATOR],
    )
    ->add(
        url: '/admin/{FOLDER}/{CONTROLLER}/{ACTION}/:id',
        namespace: 'App\Controller\Admin\{FOLDER}\{CONTROLLER}PageController::{ACTION}',
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

