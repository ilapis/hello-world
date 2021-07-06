<?php declare(strict_types = 1);

namespace App\Abstract;

use App\HttpRequest;

abstract class AdminController extends Controller {

    public string $layout = "admin";

    public function __defaultTemplates(): void {

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
                    "icon" => "<i class='bi bi-clipboard''></i>",
                    "text" => "Dashboard",
                    "href" => "/admin/dashboard",
                ],
                [
                    "icon" => "<i class='bi bi-file-text'></i>",
                    "text" => "Article",
                    "href" => "/admin/article",
                ],
                [
                    "icon" => "<i class='bi bi-card-list'></i>",
                    "text" => "Category",
                    "href" => "/admin/category",
                ],
                [
                    "icon" => "<i class='bi bi-person-circle'></i>",
                    "text" => "Administrators",
                    "href" => "/admin/settings/administrators",
                ],
                [
                    "text" => "Builder | Form",
                    "href" => "/admin/builder/form",
                ],
                [
                    "text" => "Uploader | Files",
                    "href" => "/admin/uploader/file",
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

    public function list(HttpRequest $request) {

        $filter = $request->getParameter("filter");

        if ( $this->isJSON($filter) ) {
            $filter = json_decode($filter, true);
        } else {
            $filter = [];
        }

        return $this->response(
            $this->model->table($filter)
        );
    }

    public function deleteConfirmation(HttpRequest $request): void {
        $this
            ->addView(
                template: "partials/admin/delete-confirmation.tpl",
                model: [
                    "id" => $request->getRouterParameter("id")
                ]
            );
    }

}