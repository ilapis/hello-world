<?php declare(strict_types = 1);

namespace App\Abstract;

use App\HttpRequest;
use App\Interfaces\ControllerInterface;
use phpDocumentor\Reflection\Types\Boolean;

abstract class Controller implements ControllerInterface {

    public string $layout = "default";
    private array $views = [];
    private bool $outputHTML = true;

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
        $this->outputHTML = false;
        header('Content-Type: application/json');
        echo json_encode($array);
        exit(0);
    }

    public function redirect(string $link): void
    {
        $this->outputHTML = false;
        header('location: ' . $link);
        exit(0);
    }

    public function index(HttpRequest $request): void
    {
        $this->getControllerSettings('index');
    }

    public function create(HttpRequest $request): void
    {
        $this->getControllerSettings('create', (int) $request->getRouterParameter('id'));
    }

    public function edit(HttpRequest $request): void
    {
        $this->getControllerSettings('edit', (int) $request->getRouterParameter('id'));
    }

    public function save(HttpRequest $request): void
    {
        $this->getModelSettings('save', $request->getJson());
    }

    public function update(HttpRequest $request): void
    {
        $this->getModelSettings('update', $request->getJson());
    }

    public function delete(HttpRequest $request): void
    {
        $this->getModelSettings('delete', $request->getJson());
    }

    private function getModelSettings(string $method, array $data): void
    {
        if ( isset($this->validator) && !is_null($this->validator) && method_exists($this->validator, 'validate') ) {
            $this->validator->validate($data);
        }

        if ( isset($this->model) && !is_null($this->model) && method_exists($this->model, $method) ) {
            $this->response( $this->model->$method($data) );
        }

        $this->response([
            "status" => "error",
            "action" => "modal",
            "message" => "Method [$method] not implemented in model",
        ]);
    }

    private function getControllerSettings(string $method, int $id = null): void
    {
        $class = explode("\\", get_called_class());
        $controller = strtr(strtolower($class[sizeof($class) - 1]), ["pagecontroller" => ""]);
        array_pop($class);  // remove Class
        array_shift($class);// remove App
        array_shift($class);// remove Controller
        $folder = strtolower(implode("/", $class));

        if ( isset($this->model) && !is_null($this->model) ) {

            if ( $method == "index" ) {
                $this
                    ->addView(
                        template: "$folder/$controller/$method.tpl",
                        model: method_exists($this->model, $method) ? $this->model->$method() : [],
                    )
                ;
            } else {
                $this
                    ->addView(
                        template: "$folder/$controller/$method.tpl",
                        model: method_exists($this->model, $method) ? $this->model->$method($id) : [],
                    )
                ;
            }

        } else {
            $this
                ->addView(
                    template: "$folder/$controller/$method.tpl",
                    model: [],
                )
            ;
        }
    }

    public function __defaultTemplates(): void {}

    public function output(): void
    {
        global $g_error_code;

        if ( $g_error_code == "" ) {
            /**
             * @psalm-suppress UnresolvableInclude
             */
            $this->__defaultTemplates();
            include __DIR__ . "/../../layouts/default/" . $this->layout . ".php";
        }
    }

    protected function isJSON(string $string): bool {
        return is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    public function __destruct() {
        !$this->outputHTML ?: $this->output();
    }
}