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
        string $redirect = null,
    ): HttpRouter {
        $this->_routes[] = [
            "url" => $url,
            "namespace" => $namespace,
            "methods" => $methods,
            "access" => $access,
            "roles" => $roles,
            "redirect" => $redirect,
        ];

        return $this;
    }

    public function process(): ?string {

        foreach($this->_routes as $route) {

            if ( sizeof($route['methods']) === 0 || in_array($this->request->getMethod(), $route['methods']) ) {

                $is_authorized = in_array(Authorization::getAccess(), $route['access']) || in_array(ACCESS::PUBLIC, $route['access']);
                $has_role = in_array(Authorization::getRole(), $route['roles']) || in_array(ROLES::ANONYMOUS, $route['roles']);

                if (!str_contains($route['url'], "{")) {

                    $found_route = ($route['url'] == $this->request->getParameter('url'));

                    if ($found_route) {
                        if (!$is_authorized) {
                            return "NOT AUTHORIZED";
                        }
                        if (!$has_role) {
                            return "WRONG ROLE";
                        }
                        $this->redirect($route["redirect"]);

                        return $route['namespace'];
                    }

                } else {

                    $routerUrl = explode("/", $route['url']);
                    $currentUrl = explode("/", $this->request->getParameter('url'));

                    if ( $this->patternMatches($routerUrl, $currentUrl) ) {

                        $replace = [];
                        $this->request->clearRouterParameter($currentUrl);

                        foreach ( $routerUrl as $index => $routerUrlElement ) {
                            if ( str_contains($routerUrlElement, "{") ) {
                                $replace[$routerUrlElement] = ucfirst($currentUrl[$index]);
                            }

                            if ( str_starts_with($routerUrlElement, ":") ) {
                                $this->request->setRouterParameter( strtr($routerUrlElement, [":" => ""]), $currentUrl[$index],);
                            }
                        }

                        if (!$is_authorized) {
                            return "NOT AUTHORIZED";
                        }
                        if (!$has_role) {
                            return "WRONG ROLE";
                        }
                        $this->redirect($route["redirect"]);

                        return strtr( $route['namespace'], $replace);
                    }

                }
            }
        }

        return "NOT FOUND";
    }

    public function redirect(?string $redirect) {

        if ( $redirect!= null ) {
            header('location: ' . $redirect );
        }
    }

    public function patternMatches($routerUrl, $currentUrl) {

        if ( sizeof($routerUrl) == sizeof($currentUrl) ) {

                for ( $i = 0; $i < sizeof($routerUrl); $i++ ) {
                    if ( $routerUrl[$i] == $currentUrl[$i] || str_contains($routerUrl[$i], "{") || str_contains($routerUrl[$i], ":") ) {

                        continue;
                    } else {

                        return false;
                    }
                }

                return true;
        }

        return false;
    }
}