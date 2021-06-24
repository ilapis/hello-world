<?php declare(strict_types = 1);

namespace App\Model\Admin\Builder;

use App\Abstract\DefaultModel;

class FormPageModel {

    public function __construct (
        private DefaultModel $model
    ) {}

    public function table(array $filter = []): array
    {
        return $this->model->table("builder_form", ["id", "title"], [], $filter);;
    }

    public function save(array $data): array
    {
        return $this->model->save("builder_form", $data);
    }

    public function edit(int $id): array
    {

        return $this->model->get(
            table: "builder_form",
            collumns: ["id", "title", "settings"],
            where: ["id" => $id],
        );
    }

    public function update(array $data): array
    {
        return $this->model->update("builder_form", $data);
    }

    public function delete(array $data): array
    {
        return $this->model->delete("builder_form", $data);
    }
}