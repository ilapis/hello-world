<?php declare(strict_types = 1);

namespace App\Form\Admin\Settings;

use App\Input\TextInput;
use App\Input\HiddenInput;
use App\Input\CheckboxInput;

class AdministratorsPageForm {

    public static function get(array $model = []): array
    {
        return [
            HiddenInput::id($model['id'] ?? ""),
            TextInput::username($model['username'] ?? ""),
            TextInput::password($model['password'] ?? ""),
            TextInput::email($model['email'] ?? ""),
            CheckboxInput::enabled($model['enabled'] ?? ""),
            [
                "script" => "ql_button",
                "template" => '<button id="save_administrator" type="submit" class="btn btn-primary float-end invisible" >Submit</button>',
                "linkFrom" => "#save_administrator",
                "linkTo" => "#default_save"
            ]
        ];
    }
}