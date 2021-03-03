<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class AdminController extends Controller {

    public string $layout = "admin";

    public function __construct() {

        $this
            ->addView(
                template: "partials/header_admin.tpl",
                model:
                [
                "title" => "Homepage",
                ],
                position: "partial/header"
            )
            ->addView(
                template: "partials/footer_admin.tpl",
                position:  "partial/footer",
            )
        ;
    }

}