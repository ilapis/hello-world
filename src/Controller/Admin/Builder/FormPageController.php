<?php

namespace App\Controller\Admin\Builder;

use App\Abstract\AdminController;
use App\Model\Admin\Builder\FormPageModel;

class FormPageController extends AdminController {

    public function __construct (
        public FormPageModel $model
    ) {}

}