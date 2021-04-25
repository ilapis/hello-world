<?php declare(strict_types = 1);

namespace App;

class HttpRequest {

    private string $_method;
    private string $_url;
    private array $_post;
    private array $_parameters;
    private array $_headers;
    private string $_body;
    private array $_files;

    public function __construct () {
        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_url = $_SERVER['REQUEST_METHOD'];
        $this->_post = $_POST;
        $this->_parameters = $_GET;
        $this->_headers = getallheaders();
        $this->_body = file_get_contents('php://input');
        $this->_files = $_FILES;
    }

    public function getParameter(string $key): string {
        return $this->_parameters[$key] ?? '';
    }

    public function setParameter(string $key, string $value): HttpRequest {

        $this->_parameters[$key] == $value;

        return $this;
    }

    public function setRouterParameter(string $key, string $value): HttpRequest {

        $_SESSION["ROUTER_PARAMETERS"][$this->_url][$key] = $value;

        return $this;
    }

    public function getRouterParameter(string $key): ?string {

        return $_SESSION["ROUTER_PARAMETERS"][$this->_url][$key] ?? null;
    }

    public function clearRouterParameter(): HttpRequest {

        unset($_SESSION["ROUTER_PARAMETERS"][$this->_url]);

        return $this;
    }

    public function getMethod(): string {

        return $this->_method;
    }

    public function getPost(): array {

        return $this->_post;
    }

    public function getParameters(): array {

        return $this->_parameters;
    }

    public function getHeaders(): array {

        return $this->_headers;
    }

    public function getBody(): string {

        return $this->_body;
    }

    public function getJson(): array {

        return json_decode($this->_body, true);
    }

    public function getFiles(): array {

        return $this->_files;
    }
}