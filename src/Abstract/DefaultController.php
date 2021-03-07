<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class DefaultController extends Controller {

    public string $layout = "default";

    public function __construct() {

        $this
            ->addView(
                template: "partials/header.tpl",
                model: [
                    "title" => "Homepage",
                ],
                position: "partial/header"
            )/*->addView(
                template: "menu.tpl"
            )*/
            ->addView(
                template: "partials/footer.tpl",
                position: "partial/footer",
            );
    }

}