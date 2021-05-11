<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
use App\HttpRequest;
use App\Model\Admin\CategoryModel;

class CategoryPageController extends AdminController {

    public function __construct (
        public CategoryModel $model
    ) {
        parent::__construct();
    }

    public function list(HttpRequest $request) {

        $filter = $request->getParameter("filter");

        if ( $this->isJSON($filter) ) {
            $filter = json_decode($filter, true);
        } else {
            $filter = [];
        }

        return $this->response(
            $this->model->table($filter)
        );
    }
}