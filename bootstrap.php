<?php

spl_autoload_register( function ($namespace) {
    $exploded = explode('\\', $namespace);
    array_shift($exploded);
    include 'src/' . implode('/', $exploded ) . '.php';
});