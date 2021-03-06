<?php declare(strict_types = 1);

namespace App\Controller;

use App\Abstract\DefaultController;
use App\HttpRequest;
use App\Model\ProductModel;

class ProductPageController extends DefaultController {

    public function __construct (
        private ProductModel $model
    ) {
        //parent::__construct();
    }

    public function index(HttpRequest $request): void
    {

        $this
            ->addView(
                template: "product.tpl",
                model: $this->model->getProductData(),
            )
        ;
    }

}