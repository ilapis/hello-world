<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admnistrator login page">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<?php if ( App\Security\Access::PUBLIC !== App\Security\Authorization::getAccess() ) { ?>
    <link href="/css/sticky-table.min.css" rel="stylesheet" />
<?php } ?>

    <title><?=$model["title"];?></title>
    <style>
        html, body {
            height: 100%;
            width: 100%;
        }
        .sidebar {
            height: 100%;
            background: #0d6efd;
        }
        .container {
            height: 100%;
        }
        label {
            line-height: 2.375rem;
        }
        form {
            padding: 1rem 1rem 1.5rem 1rem;
        }
        .sidebar div a {
            display: block;
            width: 100%;
            height: 100%;
            padding: 0.5rem 1rem;
            color: #fff;
            background: #0d6efd;
            text-decoration: none;
        }
        .sidebar div {
            line-height: 2rem;
            font-size: 1rem;
            border-bottom: 1px solid #CCCCCC;
            background: #0d6efd;
            color: #fff;
        }
        .sidebar div.selected {
            line-height: 2rem;
            font-size: 1rem;
            border-bottom: 1px solid #CCCCCC;
            width: calc(100% + 1px);
            border-right: 1px solid #FFF;
            background: #fff;
            color: #0d6efd;
        }
        .sidebar div.selected a {
            background: #fff;
            color: #0d6efd;
        }
        table {
                 width: 100%;
                 height: 100%;
                 overflow:auto;
                 border-collapse: collapse;
             }
        table tr {
            height: 3rem;
            padding: 0 1rem;
        }
        table tr td {
            padding: 0 1rem;
        }
        a {
            text-indent: 0;
        }
    </style>
</head>
<body>
<div class="fluid-container" style="height:100%;">
<div class="row" style="--bs-gutter-x: 0;height: 100%;">