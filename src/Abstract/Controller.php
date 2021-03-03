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

     function addView(string $template, array $model = [], string $position = "center"): ControllerInterface
    {
        $this->views[$position][] = [
            "template" => $template,
            "model" => $model,
        ];

        return $this;
    }

    public function view(string $position): void
    {
        foreach ( $this->views[$position] as $view ) {
            $model = $view["model"];
            include __DIR__ . "/../../templates/" . $view["template"];
        }
    }

    public function response(array $array): void
    {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit(0);
    }
}