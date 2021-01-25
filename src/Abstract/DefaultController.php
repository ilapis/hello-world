<?php declare(strict_types = 1);

namespace App\Abstract;

use App\Abstract\Controller;;

abstract class DefaultController extends Controller {

    public  $layout = "default";

    public function __construct() {

        $this->addView(
            "partials/header.tpl",
            [
                "title" => "Homepage",
            ],
            "partial/header"
        );

        $this->addView(
            "menu.tpl"
        );

        $this->addView(...[
                "template" => "partials/footer.tpl",
                "position" => "partial/footer",
            ]
        );
    }

}