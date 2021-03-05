<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admnistrator login page">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>
    <link href="/javascript/sticky-table/dist/css/sticky-table.min.css" rel="stylesheet" />
<?php } ?>

    <title><?=$model["title"];?></title>
    <style>
        html, body {
            height: 100%;
            width: 100%;
        }
        .sidebar {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="fluid-container" style="height:100%;">
<div class="row" style="--bs-gutter-x: 0;height: 100%;">