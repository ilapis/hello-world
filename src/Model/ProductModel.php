<?php declare(strict_types = 1);

namespace App\Model;

use App\Abstract\DefaultModel;

class ProductModel extends DefaultModel {

    public function getProductData(): array
    {

        return $this->get(
            table: "products",
            collumns: ["sku", "code", "title"],
            where: ["sku" => "200_1"],
        );
    }

}