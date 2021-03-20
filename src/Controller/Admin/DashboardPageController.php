<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\Model\LoginModel;
use App\HttpRequest;

class DashboardPageController extends AdminController {
/*
    public function __construct (
        private LoginModel $model
    ) {
        parent::__construct();
    }
*/
    public function index(): void
    {

        $this->addView(
            "admin/dashboard.tpl",
        );

        $this->output();
    }
}