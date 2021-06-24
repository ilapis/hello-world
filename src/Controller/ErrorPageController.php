<?php declare(strict_types = 1);

namespace App\Controller;

use App\Abstract\DefaultController;
use App\HttpRequest;

class ErrorPageController extends DefaultController {

    public function index(HttpRequest $request): void
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

    public function wrongRole(): void
    {
        $this
            ->addView("error.tpl")
        ;
    }

}