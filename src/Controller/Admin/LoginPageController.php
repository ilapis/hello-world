<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\HttpRequest;

class LoginPageController extends AdminController {

    function index() {

        $this->addView(
            "login_admin.tpl",
        );

        $this->output();
    }

    function post(HttpRequest $httpRequest) {
        echo $httpRequest->getBody();
    }
}