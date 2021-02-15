<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\Model\LoginModel;
use App\HttpRequest;

class LoginPageController extends AdminController {

    public function __construct (
        private LoginModel $model
    ) {
        parent::__construct();
    }

    function index() {

        $this->addView(
            "login_admin.tpl",
        );

        $this->output();
    }

    function post(HttpRequest $httpRequest) {
        echo json_encode(
            $this->model->getHash(
                $httpRequest->getJson()['username']
            )[0]
        );
    }
}