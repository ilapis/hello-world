<?php

ini_set('display_errors', 0);

$g_error_code = getRandomString(8);

function errorHandler($errno, $errstr, $errfile, $errline) {
    if ( str_contains($_SERVER['HTTP_ACCEPT'], 'text/html' ) ) {
        echo "Klaidos kodas: <b>" . getErrorCode() . "</b><br/>";
        logError( getErrorCode()  . PHP_EOL . date('Y-m-d H:i:s') . " ERROR: on line $errline in $errfile" . PHP_EOL . " [$errno] $errstr ");
    };
}

function fatalErrorHandler()
{
    $error = error_get_last();
    if( $error !== null ) {
        if ( str_contains($_SERVER['HTTP_ACCEPT'], 'text/html' ) ) {
            echo "Klaidos kodas: <b>" . getErrorCode() . "</b><br/>" . PHP_EOL;
            logError( getErrorCode()  . PHP_EOL . json_encode($error));
        }
    }
}
register_shutdown_function("fatalErrorHandler");
set_error_handler("errorHandler");

function logError(string $error) {

    if ( !file_exists("/var/www/html/logs") ) {
        mkdir("logs", 0777, true);
    }

    file_put_contents("/var/www/html/logs/php.log", $error . PHP_EOL, FILE_APPEND);
}

function getRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function getErrorCode(): string {

    global $g_error_code;

    return $g_error_code;
}