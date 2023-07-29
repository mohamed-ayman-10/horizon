<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUpload
{

    static public function File($type, $file) {
        $file_name = $type . '-' . now() . '-' . $file->getClientOriginalName();
        return $file->storeAs('images', $file_name, 'uploadFile');
    }

    static public function Delete($file) {
        return Storage::disk('uploadFile')->delete($file);
    }

}
