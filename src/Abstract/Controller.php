<?php declare(strict_types = 1);

namespace App\Abstract;

use App\Interfaces\ControllerInterface;

abstract class Controller implements ControllerInterface {

    public string $layout = "default";
    private array $views = [];

    public function output(): void
    {
        include __DIR__ . "/../../layouts/default/" . $this->layout . ".php";
    }

     function addView(string $template, array $model = [], string $position = "center"): void
    {
        $this->views[$position][] = [
            "template" => $template,
            "model" => $model,
        ];
    }

    public function view(string $position): void
    {
        foreach ( $this->views[$position] as $view ) {
            $model = $view["model"];
            include __DIR__ . "/../../templates/" . $view["template"];
        }
    }

}