<?php declare(strict_types = 1);

namespace App\Controller;

use App\Abstract\DefaultController;

class ErrorPageController extends DefaultController {

    public function index(): void
    {
        $this
            ->addView("error.tpl")
        ;
    }

    public function unregisteredWebsite(): void
    {
        $this
            ->addView("error.tpl")
        ;
    }

}