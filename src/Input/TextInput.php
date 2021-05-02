<?php declare(strict_types = 1);

namespace App\Input;

class TextInput {

    public static function username(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "inline" =>true,
            "label" => [
                "text" => "* Username",
            ],
            "input" =>  [
                "id" => "username",
                "name" => "username",
                "type" => "text",
                "value" => $value,
            ],
            "validator" => [
                "required" => true,
            ],
            "messages" => [
                "valid_feedback" => "",
                "invalid_feedback" => "Required",
            ]
        ];
    }

    public static function title(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "inline" =>true,
            "label" => [
                "text" => "* Title",
            ],
            "input" =>  [
                "id" => "title",
                "name" => "title",
                "type" => "text",
                "value" => $value,
            ],
            "validator" => [
                "required" => true,
            ],
            "messages" => [
                "valid_feedback" => "",
                "invalid_feedback" => "Required",
            ]
        ];
    }

    public static function password(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "inline" => true,
            "label" => [
                "text" => "* Password"
            ],
            "input" => [
                "id" => "password",
                "name" => "password",
                "type" => "password",
                "value" => $value,
                "autocomplete" => "new-password",
            ],
            "validator" => [
                "required" => true
            ],
            "messages" => [
                "valid_feedback" => "",
                "invalid_feedback" => "Required"
            ]
        ];
    }

    public static function email(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "inline" =>true,
            "label" => [
                "text" => " Email"
            ],
            "input" => [
                "id" => 'email',
                "name" => 'email',
                "type" => 'email',
                "value" => $value,
            ],
            "validator" => [
                "required" => true
            ],
            "messages" => [
                "valid_feedback" => '',
                "invalid_feedback" => 'Required'
            ]
        ];
    }

    public static function name(string $value = ""): array
    {
        return [
            "script" => "ql_input",
            "inline" =>true,
            "label" => [
                "text" => "* Name",
            ],
            "input" =>  [
                "id" => "name",
                "name" => "name",
                "type" => "text",
                "value" => $value,
            ],
            "validator" => [
                "required" => true,
            ],
            "messages" => [
                "valid_feedback" => "",
                "invalid_feedback" => "Required",
            ]
        ];
    }
}