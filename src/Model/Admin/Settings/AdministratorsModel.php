<?php declare(strict_types = 1);

namespace App\Model\Admin\Settings;

use App\Abstract\DefaultModel;

class AdministratorsModel extends DefaultModel {

    public function index(): array
    {

        return $this->get(
            table: "administrators",
            collumns: ["id", "username", "enabled", "created"],
        );
    }

    public function edit(int $id): array
    {

        return $this->get(
            table: "administrators",
            collumns: ["id", "username", "email", "access", "enabled", "created"],
            where: ["id" => $id],
        )[0];
    }

}