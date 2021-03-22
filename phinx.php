<?php

include __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$enviroments = [];
$enviroments['default_migration_table'] = 'phinxlog';
$enviroments['default_environment'] = $_ENV['ENVIRONMENT'];

//$default_enviroment = $_ENV['ENVIRONMENT'];

$default_enviroment_settings = [
    'adapter' => 'mysql',
    'host' => $_ENV['MYSQL_HOST'],
    'name' => $_ENV['MYSQL_DATABASE'],
    'user' => $_ENV['MYSQL_USER'],
    'pass' => $_ENV['MYSQL_PASSWORD'],
    'port' => $_ENV['MYSQL_PORT'],
    'charset' => $_ENV['MYSQL_CHARSET'],
];

$enviroments[$_ENV['ENVIRONMENT']] = $default_enviroment_settings;

//$enviroments['default_environment'] = $default_enviroment;
//$enviroments[$default_enviroment] = $default_enviroment_settings;

if ( isset($_ENV['TESTING_ENABLED']) && $_ENV['TESTING_ENABLED'] == true ) {

    $testint_enviroment_settings = [
        'adapter' => 'mysql',
        'host' => $_ENV['MYSQL_HOST'],
        'name' => $_ENV['MYSQL_DATABASE_TESTING'],
        'user' => $_ENV['MYSQL_USER_TESTING'],
        'pass' => $_ENV['MYSQL_PASSWORD_TESTING'],
        'port' => $_ENV['MYSQL_PORT'],
        'charset' => $_ENV['MYSQL_CHARSET'],
    ];
    $enviroments["testing"] = $testint_enviroment_settings;
}

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => $enviroments,/*
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => $default_enviroment,
        //$default_enviroment => $default_enviroment_settings,
        $default_enviroment => $default_enviroment_settings,
        "testing" => $testint_enviroment_settings,
    ],*/
    'version_order' => 'creation'
];
