<?php

function view(array $views, string $position) {
    foreach ( $views[$position] as $view ) {
        $model = $view["model"];
        include __DIR__ . "/../templates/" . $view["template"];
    }
}

$views = [];

$views["partial/header"][] = [
    "template" => "partials/header.tpl",
    "model" => [
        "title" => "Homepage",
    ],
];

$views["center"][] = [
    "template" => "menu.tpl",
    "model" => [],
];

$views["center"][] = [
    "template" => "message.tpl",
    "model" => [
        "text" => "Hello world",
    ],
];

$views["partial/footer"][] = [
    "template" => "partials/footer.tpl",
    "model" => [],
];

include __DIR__ . "/../layouts/default/homepage.php";
