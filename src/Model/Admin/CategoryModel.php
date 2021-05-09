<?php declare(strict_types = 1);

namespace App\Model\Admin;

use App\Abstract\DefaultModel;

class CategoryModel extends DefaultModel {

    public function list(): array
    {
        return $this->get("category", ["id", "title", "enabled"]);;
    }

    public function save(array $data): array
    {
        $data["translation_key"] = $data["translation_key"] ?? $data["title"];
        $data["parent_id"] = $data["parent_id"] ?? 0;
        $data["order"] = $data["order"] ?? 0;

        return $this->saveRecord("category", $data);
    }

    public function edit(int $id): array
    {

        return $this->get(
            table: "category",
            collumns: ["id", "title", "enabled"],
            where: ["id" => $id],
        )[0];
    }

    public function update(array $data): array
    {
        $data["translation_key"] = $data["translation_key"] ?? $data["title"];
        $data["parent_id"] = $data["parent_id"] ?? 0;
        $data["order"] = $data["order"] ?? 0;

        return $this->updateRecord("category", $data);
    }

    public function delete(array $data): array
    {
        return $data;
    }
}