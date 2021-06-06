<?php declare(strict_types = 1);

namespace App;

class PrepareResponse {

    public static function get(array $overwrite):array {

        $response = [
            "status"    => "ok",
            "message"   => "Record obtained",
        ];

        return array_replace_recursive($response, $overwrite);
    }

    public static function redirect(string $status = "ok", ?string $redirect = null, array $overwrite = []): array {

        $response = [
            "status"    => $status,
            "action"    => "redirect",
            "redirect"  => $redirect,
        ];

        return array_replace_recursive($response, $overwrite);
    }

    public static function redirectModal(array $overwrite): array {

        $redirect = null;

        if (  str_contains( $_GET['url'], "/edit/" ) ) {
            $redirect = explode("/edit/", $_GET['url'])[0];
        }
        if (  str_contains( $_GET['url'], "/save" ) ) {
            $redirect = explode("/save", $_GET['url'])[0];
        }
        if (  str_contains($_GET['url'], "/update/") ) {
            $redirect = explode("/update/", $_GET['url'])[0];
        }
        if (  str_contains( $_GET['url'] , "/delete/") ) {
            $redirect = explode("/delete/", $_GET['url'])[0];
        }

        $response = [
            "status"    => "ok",
            "action"    => "modal-redirect",
            "modal"     => "modal-inserted",
            "redirect"  => $redirect,
            "message"   => null,
            "timeout"   => 1000,
            "data"      => null,
        ];

        return array_replace_recursive($response, $overwrite);
    }

    public static function alertModal(array $overwrite): array {

        $response = [
            "status"    => "ok",
            "action"    => "modal",
            "modal"     => "modal-alert",
            "message"   => null,
            "timeout"   => null,
            "data"      => null,
        ];

        return array_replace_recursive($response, $overwrite);
    }

    public static function table(array $data): array {

        return $data;
    }

}