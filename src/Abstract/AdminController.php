<?php declare(strict_types = 1);

namespace App\Abstract;

use App\HttpRequest;

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
                template: "partials/admin/menu_top.tpl",
                position:  "partial/admin/menu_top",
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

    public function deleteConfirmation(HttpRequest $request) {
        $this
            ->addView(
                template: "partials/admin/delete-confirmation.tpl",
                model: [
                    "id" => $request->getRouterParameter("id")
                ]
            );
    }

}