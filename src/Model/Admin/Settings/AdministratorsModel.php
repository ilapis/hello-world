<?php declare(strict_types = 1);

namespace App\Model\Admin\Settings;

use App\Abstract\DefaultModel;

class AdministratorsModel extends DefaultModel {

    public function geAdministratorsDataForIndex(): array
    {

        return $this->get(
            table: "administrators",
            collumns: ["id", "username", "enabled", "created"],
        );
    }

}