<?php declare(strict_types = 1);

namespace App\Model;

use App\Abstract\DefaultModel;

class LoginModel extends DefaultModel {

    public function getHash(string $email): array
    {

        return $this->get(
            table: "administrators",
            collumns: ["password_hash"],
            where: ["email" => $email, "enabled" => true],
        )[0];
    }

}