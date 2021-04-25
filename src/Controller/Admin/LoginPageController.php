<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\Model\LoginModel;
use App\HttpRequest;
use App\Security\Roles;
use App\Security\Access;
use App\Security\Authorization;

class LoginPageController extends AdminController {

    public function __construct (
        private LoginModel $model
    ) {
        parent::__construct();
    }

    public function index(HttpRequest $request): void
    {
        if ( Access::ADMIN !== Authorization::getAccess() ) {
            $this
                ->addView(
                    template: "admin/login.tpl"
                );
        } else {
            $this->redirect("/admin/dashboard");
        }
    }

    public function logout(): void
    {
        Authorization::destroy();
        header("location: /admin");
    }

    public function post(HttpRequest $httpRequest): void
    {
        $administrator = $this->model->getAdministrator($httpRequest->getJson()['username']);

        if ( password_verify(
            $httpRequest->getJson()['password'],
            $administrator['password_hash'])
        ) {

            Authorization::setRole(Roles::ADMINISTRATOR);
            Authorization::setAccess(Access::ADMIN);

            $this->response([
                "valid" => true,
                "action" => "redirect",
                "redirect" => "/admin/dashboard",
            ]);
        }

        $this->response([
            "valid" => false,
            "action" => "message",
            "element" => "#message_error",
            "message" => "Invalid login credentials",
        ]);
    }
}