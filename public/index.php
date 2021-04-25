<?php

session_start();

$xdebug_coverage = false;

include __DIR__ . "/../bootstrap.php";
include __DIR__ . "/../vendor/autoload.php";

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;

if ( $xdebug_coverage ) {
    $filter = new Filter;
    $filter->includeDirectory(__DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR);
    $coverage = new CodeCoverage(
        (new Selector)->forLineCoverage($filter),
        $filter
    );
    //$coverage->start('Default coverage');
    $coverage->start($_GET['url']);
}

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

if ( $xdebug_coverage ) {
    $coverage->stop();
    (new HtmlReport)->process($coverage, '/var/www/html/reports/xdebug_coverage_report');
}