<?php declare(strict_types = 1);

namespace App\Controller;

use App\Abstract\DefaultController;

class HomePageController extends DefaultController {

    function index() {

        $this->addView(
            "message.tpl",
            [
                "text" => "Hello world",
            ],
        );

        $this->output();
    }

}