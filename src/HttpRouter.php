<?php declare(strict_types = 1);

namespace App;

use App\HttpRequest;

class HttpRouter {

    private array $_routes;

    public function __construct(
        private HttpRequest $request
    ) {}

    public function add(string $url, string $namespace): HttpRouter {
        $this->_routes[] = [
            "url" => $url,
            "namespace" => $namespace,
        ];

        return $this;
    }

    public function process(): ?string {
        foreach($this->_routes as $route) {
            $url = '/' . $this->request->getParameter('url');
            if ( $url === $route['url'] ) {
                return $route['namespace'];
            }
        }

        return null;
    }

}