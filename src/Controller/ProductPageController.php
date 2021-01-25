<?php declare(strict_types = 1);

namespace App\Controller;

use App\Abstract\DefaultController;;
use App\Model\ProductModel;;

class ProductPageController extends DefaultController {

    public function __construct (
        private ProductModel $model
    ) {
        parent::__construct();
    }

    function index() {

        $this->addView(
            "product.tpl",
            $this->model->getProductData()
        );

        $this->output();
    }

}