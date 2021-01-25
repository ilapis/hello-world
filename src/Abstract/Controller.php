<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class Controller {

    public  $layout = "default";
    private $views = [];

    protected function output() {
        include __DIR__ . "/../../layouts/default/" . $this->layout . ".php";
    }

    public function addView(string $template, array $model = [], string $position = "center") {
        $this->views[$position][] = [
            "template" => $template,
            "model" => $model,
        ];
    }

    public function view(string $position) {
        foreach ( $this->views[$position] as $view ) {
            $model = $view["model"];
            include __DIR__ . "/../../templates/" . $view["template"];
        }
    }

}