<?php declare(strict_types = 1);

namespace App\Model\Admin;

use App\Abstract\DefaultModel;

class CategoryModel {

    public function __construct (
        private DefaultModel $model
    ) {}

    public function table(array $filter = []): array
    {
        if ( $filter["orderBy"] == "") {
            $filter["orderBy"] = "ORDER BY `id` DESC";
        }
        return $this->model->table("category", ["id", "title", "enabled"], [], $filter);;
    }

    public function save(array $data): array
    {
        $data["translation_key"] = $data["translation_key"] ?? $data["title"];
        $data["parent_id"] = $data["parent_id"] ?? 0;
        $data["order"] = $data["order"] ?? 0;

        return $this->model->save("category", $data);
    }

    public function edit(int $id): array
    {

        return $this->model->get(
            table: "category",
            collumns: ["id", "title", "enabled"],
            where: ["id" => $id],
        );
    }

    public function update(array $data): array
    {
        $data["translation_key"] = $data["translation_key"] ?? $data["title"];
        $data["parent_id"] = $data["parent_id"] ?? 0;
        $data["order"] = $data["order"] ?? 0;

        return $this->model->update("category", $data);
    }

    public function delete(array $data): array
    {
        return $data;
    }
}