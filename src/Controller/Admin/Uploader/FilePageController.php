<?php

namespace App\Controller\Admin\Uploader;

use App\Abstract\AdminController;
use App\HttpRequest;
use App\Model\Admin\Uploader\UploaderModel;

class FilePageController extends AdminController {

    public function __construct (
        public UploaderModel $model
    ) {}

    public function save(HttpRequest $request)
    {
        $body = json_decode($request->getBody(), true);
        $data = explode(",", $body["base64"]);

        $content= base64_decode($data[1]);
        $file = fopen('stuff.png', 'w');
        fwrite($file, $content);
        fclose($file);

        $this->response($body);
    }
}