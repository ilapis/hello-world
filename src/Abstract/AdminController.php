<?php declare(strict_types = 1);

namespace App\Abstract;

abstract class AdminController extends Controller {

    public string $layout = "admin";

    public function __construct() {

        $this
            ->addView(
                template: "partials/admin/header.tpl",
                model:
                [
                "title" => "Administrator",
                ],
                position: "partial/admin/header"
            )
            ->addView(
                template: "partials/admin/sidebar.tpl",
                model: ["links" => [
                        [
                            "text" => "Dashboard",
                            "href" => "/admin/dashboard",
                        ],
                        [
                            "text" => "Article",
                            "href" => "/admin/article",
                        ],
                        [
                            "text" => "Category",
                            "href" => "/admin/category",
                        ],
                        [
                            "text" => "Administrators",
                            "href" => "/admin/settings/administrators",
                        ]
                ]],
                position:  "sidebar",
            )
            ->addView(
                template: "partials/admin/footer.tpl",
                position:  "partial/admin/footer",
            )
        ;
    }

}