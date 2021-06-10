<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\Model\Admin\CategoryModel;

class CategoryPageController extends AdminController {

    public function __construct (
        public CategoryModel $model
    ) {}

}