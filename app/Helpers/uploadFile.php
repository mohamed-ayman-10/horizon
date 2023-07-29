<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($disk, $path, $file)
{
    return Storage::disk($disk)->put($path, $file);
}

function deleteFile($disk, $file)
{
    return Storage::disk($disk)->delete($file);
}
