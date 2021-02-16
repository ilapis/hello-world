<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class AdminController extends Controller {

    public string $layout = "admin";

    public function __construct() {

        $this->addView(
            "partials/header_admin.tpl",
            [
                "title" => "Homepage",
            ],
            "partial/header"
        );

        $this->addView(...[
                "template" => "partials/footer_admin.tpl",
                "position" => "partial/footer",
            ]
        );
    }

}