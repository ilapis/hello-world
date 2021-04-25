<?php declare(strict_types = 1);

namespace App\Input;

class HiddenInput {

    public static function id(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "input" =>  [
                "id" => "id",
                "name" => "id",
                "type" => "hidden",
                "value" => $value,
            ]
        ];
    }
}