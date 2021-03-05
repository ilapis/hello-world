<?php declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Abstract\AdminController;
#use App\Model\ArticleModel;

class ArticlePageController extends AdminController {
/*
    public function __construct (
        private LoginModel $model
    ) {
        parent::__construct();
    }
*/
    public function index(): void
    {
        $this
            ->addView(
            "admin/article/index.tpl",
        )
            ->output()
        ;
    }
}