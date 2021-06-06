<?php declare(strict_types = 1);

namespace App\Form;

use App\Input\TextInput;
use App\Input\HiddenInput;
use App\Input\CheckboxInput;

class DefaultPageForm {

    public static function delete(array $model = []): array
    {
        return [
            HiddenInput::id($model['id'] ?? ""),
            CheckboxInput::enabled($model['enabled'] ?? "", "Ištrinti įrašą?"),
            [
                "script" => "ql_button",
                "template" => '<button id="delete_record" type="submit" class="btn btn-primary float-end invisible" >Submit</button>',
                "linkFrom" => "#delete_record",
                "linkTo" => "#default_save"
            ]
        ];
    }
}