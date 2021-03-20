<?php

session_start();

include __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new App\Container;

/* If website is not of environment or testing stop it */
if ( !in_array( $_SERVER["HTTP_HOST"], [$_ENV["WEBSITE_URL_TESTING"] ?? null,$_ENV["WEBSITE_URL"], "apache"]) ) {
    $container->executeMethod('App\Controller\ErrorPageController::unregisteredWebsite');
}

if ( $_SERVER["HTTP_HOST"] != $_ENV["WEBSITE_URL"]
    && $_ENV["TESTING_ENABLED"] == "true"
    && in_array( $_SERVER["HTTP_HOST"], [$_ENV["WEBSITE_URL_TESTING"], "apache"])
) {
    $_ENV["ENVIRONMENT"] = 'testing';
    $_ENV["MYSQL_DATABASE"] = $_ENV["MYSQL_DATABASE_TESTING"];
    $_ENV["MYSQL_USER"] = $_ENV["MYSQL_USER_TESTING"];
    $_ENV["MYSQL_PASSWORD"] = $_ENV["MYSQL_PASSWORD_TESTING"];
}


include "router.php";

$container->executeMethod($router->process() ?? 'App\Controller\ErrorPageController::index');

