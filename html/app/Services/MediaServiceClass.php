<?php

namespace App\Services;

class MediaServiceClass 
{
    public function __construct() {

    }

    public function storeImage() {
        $url = 'http://example.com/image.php';
        $img = '/my/folder/flower.gif';
        file_put_contents($img, file_get_contents($url));
    }
}