<?php declare(strict_types = 1);

namespace App\Controller\Admin\Settings;

use App\Abstract\AdminController;
use App\Model\Admin\Settings\AdministratorsModel;

class AdministratorsPageController extends AdminController {

    public function __construct (
        protected AdministratorsModel $model
    ) {
        parent::__construct();
    }
}