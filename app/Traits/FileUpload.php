<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUpload
{

    static public function File($type, $file) {
        $extention = strtolower($file->getClientOriginalExtension());
        $name = time() . rand(100, 999) . '.' . $extention;
        return $file->move($type, $name);
    }

    static public function Delete($file) {
        return unlink($file);
    }

}
