<?php declare(strict_types = 1);

namespace App\Controller\Admin\Settings;

use App\Abstract\AdminController;
use App\Model\Admin\Settings\AdministratorsModel;

class AdministratorsPageController extends AdminController {

    public function __construct (
        private AdministratorsModel $model
    ) {
        parent::__construct();
    }

    public function index(): void
    {
        $this
            ->addView(
                template: "admin/settings/administrators/index.tpl",
                model: $this->model->geAdministratorsDataForIndex(),
            )
            ->output()
        ;
    }

    public function create(): void
    {
        $this
            ->addView(
                template: "admin/settings/administrators/create.tpl",
            )
            ->output()
        ;
    }
}