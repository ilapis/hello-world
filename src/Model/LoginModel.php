<?php declare(strict_types = 1);

namespace App\Model;

use App\Abstract\DefaultModel;

class LoginModel extends DefaultModel {

    public function getAdministrator(string $username): array
    {

        return $this->get(
            table: "administrators",
            collumns: ["password_hash", "access"],
            where: ["username" => $username, "enabled" => true],
        )[0];
    }

}