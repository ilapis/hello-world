<?php

use App\PrepareResponse;

ini_set('display_errors', 0);

$g_error_code = "";

function errorHandler($errno, $errstr, $errfile, $errline) {
    logError( "ERROR: " . getErrorCode()  . PHP_EOL . date('Y-m-d H:i:s') . " ERROR: on line $errline in $errfile" . PHP_EOL . " [$errno] $errstr ");
    if ( isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == "application/json" ) {
        echo json_encode(
            PrepareResponse::alertModal([
                "status" => "error",
                "message" => getErrorCode(),
            ])
        );
    } else {
        echo "Klaidos kodas: <b>" . getErrorCode() . "</b><br/>" . PHP_EOL;
    }
    exit(0);
}

function fatalErrorHandler()
{
    $error = error_get_last();
    if( $error !== null ) {
        logError( "FATAL ERROR: " . getErrorCode()  . PHP_EOL . json_encode($error));
        if (  isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == "application/json" ) {
            echo json_encode(
                PrepareResponse::alertModal([
                    "status" => "error",
                    "message" => getErrorCode(),
                ])
            );
        } else {
            echo "Klaidos kodas: <b>" . getErrorCode() . "</b><br/>" . PHP_EOL;
        }
        exit(0);
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

    if ( $g_error_code == "" ) {
        $g_error_code = getRandomString(8);
    }

    return $g_error_code;
}