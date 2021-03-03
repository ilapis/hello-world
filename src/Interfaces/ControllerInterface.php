<?php declare(strict_types = 1);

namespace App\Interfaces;

interface ControllerInterface {

    function output(): void;
    function addView(string $template, array $model = [], string $position = "center"): ControllerInterface;
    function view(string $position): void;
}
