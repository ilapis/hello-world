<?php declare(strict_types = 1);

namespace App\Interfaces;

interface HttpRouterInterface {

    function add(string $url, string $namespace, array $methods = []): HttpRouterInterface;
    function process(): ?string;
}
