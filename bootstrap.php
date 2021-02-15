<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

spl_autoload_register( function ($namespace) {
    $exploded = explode('\\', $namespace);
    array_shift($exploded);
    include 'src/' . implode('/', $exploded ) . '.php';
});