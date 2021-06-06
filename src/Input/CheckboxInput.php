<?php declare(strict_types = 1);

namespace App\Input;

class CheckboxInput {

    public static function enabled(string $value = "", string $labelText = "Enabled"): array
    {
        return [
            "script" => "ql_checkbox",
            "inline" => true,
            "checked" => $value,
            "label" => [
                "text" => $labelText
            ],
            "input" => [
                "id" => 'enabled',
                "name" => 'enabled'
            ]
        ];
    }
}