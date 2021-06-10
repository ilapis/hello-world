<?php

namespace App\Controller\Admin\Builder;

use App\Abstract\AdminController;
use App\Model\Admin\Builder\FormModel;

class FormPageController extends AdminController {

    public function __construct (
        public FormModel $model
    ) {}

}