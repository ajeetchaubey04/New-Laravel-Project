<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    /**
     * Uploads File.
     *
     * Returns file path
     *
     * @param string $path
     * @param File $message
     * @param string $status_code
     * @return string
     */

    public function uploadFile($path, $file, $old)
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        if ($old) {
            file_exists($old) && is_file($old) ? @unlink($old) : false;
        }

        $filename = uniqid('file-') . '-' . time() . '.' . $file->getClientOriginalExtension();

        //Move Uploaded File
        $file->move($path, $filename);

        return $path . '' . $filename;
    }
}
