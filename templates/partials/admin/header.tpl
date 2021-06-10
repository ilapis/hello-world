<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admnistrator login page">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="http://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
    <link href="/css/admin/default.css" rel="stylesheet">

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>
    <link href="/css/sticky-table.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<?php } ?>

    <title><?=$model["title"];?></title>
    <style>

    </style>
</head>
<body>
<div class="fluid-container" style="height:100%;">
<div class="row" style="--bs-gutter-x: 0;height: 100%;">