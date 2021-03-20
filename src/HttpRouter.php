<?php declare(strict_types = 1);

namespace App;

use App\Interfaces\HttpRouterInterface;
use App\Security\Roles;
use App\Security\Access;
use App\Security\Authorization;

class HttpRouter implements HttpRouterInterface {

    private array $_routes = [];

    public function __construct(
        private HttpRequest $request,
    ) {}

    public function add(
        string $url,
        string $namespace,
        array $methods = [],
        array $access = [Access::PUBLIC],
        array $roles = [Roles::ANONYMOUS],
    ): HttpRouter {
        $this->_routes[] = [
            "url" => $url,
            "namespace" => $namespace,
            "methods" => $methods,
            "access" => $access,
            "roles" => $roles,
        ];

        return $this;
    }

    public function process(): ?string {

        foreach($this->_routes as $route) {

            $is_authorized = in_array(Authorization::getAccess(), $route['access']) || in_array(ACCESS::PUBLIC, $route['access']) ;
            $has_role = in_array(Authorization::getRole(), $route['roles']) || in_array(ROLES::ANONYMOUS, $route['roles']);
            $found_route = ($route['url'] == $this->request->getParameter('url'));

            if ( ( sizeof($route['methods']) === 0
                || in_array($_SERVER['REQUEST_METHOD'], $route['methods']) )
                && $found_route
            ) {
                if ( !$is_authorized ) { return "NOT AUTHORIZED"; }
                if ( !$has_role ) { return "WRONG ROLE"; }

                return $route['namespace'];
            }
        }

        return "NOT FOUND";
    }

}