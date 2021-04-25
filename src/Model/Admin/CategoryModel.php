<?php declare(strict_types = 1);

namespace App\Model\Admin;

use App\Abstract\DefaultModel;

class CategoryModel extends DefaultModel {

    public function list(): array
    {
        return [
            ["id" => 1, "title" => "test"],
            ["id" => 2, "title" => "test2"]
        ];
    }

    public function save(array $data): array
    {
        return $data;
    }

    public function update(array $data): array
    {
        return $data;
    }

    public function delete(array $data): array
    {
        return $data;
    }
}