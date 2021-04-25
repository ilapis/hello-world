<?php declare(strict_types = 1);

namespace App\Form\Admin;

use App\Input\TextInput;
use App\Input\HiddenInput;
use App\Input\CheckboxInput;

class CategoryPageForm {

    public static function get(array $model = []): array
    {
        return [
            HiddenInput::id($model['id'] ?? ""),
            TextInput::title($model['title'] ?? ""),
            CheckboxInput::enabled($model['enabled'] ?? ""),
            [
                "script" => "ql_button",
                "template" => '<button id="save_category" type="submit" class="btn btn-primary float-end invisible" >Submit</button>',
                "linkFrom" => "#save_category",
                "linkTo" => "#default_save"
            ]
        ];
    }
}