<?php declare(strict_types = 1);

namespace App\Abstract;

use App\Interfaces\ControllerInterface;

abstract class Controller implements ControllerInterface {

    public string $layout = "default";
    private array $views = [];

    public function output(): void
    {
        /**
         * @psalm-suppress UnresolvableInclude
         */
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
        if ( isset($this->views[$position]) ) {
            foreach ($this->views[$position] as $view) {
                $model = $view["model"];
                /**
                 * @psalm-suppress UnresolvableInclude
                 */
                include sprintf(__DIR__ . "/../../templates/" . $view["template"]);
            }
        }
    }

    public function response(array $array): void
    {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit(0);
    }

    public function redirect(string $link): void
    {
        header('location: ' . $link);
        exit(0);
    }
}