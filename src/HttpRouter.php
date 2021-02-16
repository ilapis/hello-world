<?php declare(strict_types = 1);

namespace App;

use App\Interfaces\HttpRouterInterface;

class HttpRouter implements HttpRouterInterface {

    private array $_routes = [];

    public function __construct(
        private HttpRequest $request,
    ) {}

    public function add(string $url, string $namespace, array $methods = []): HttpRouter {
        $this->_routes[] = [
            "url" => $url,
            "namespace" => $namespace,
            "methods" => $methods,
        ];

        return $this;
    }

    public function process(): ?string {
        foreach($this->_routes as $route) {
            if ( sizeof($route['methods']) === 0 || in_array($_SERVER['REQUEST_METHOD'], $route['methods']) ) {
                $url = '/' . $this->request->getParameter('url');
                if ($url === $route['url']) {
                    return $route['namespace'];
                }
            }
        }

        return null;
    }

}