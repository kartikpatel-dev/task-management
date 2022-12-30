<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait MediaTrait
{
    public static function storagePath()
    {
        return storage_path('app/public/');
    }

    public static function storageUrl()
    {
        return config('app.url') . Storage::url('app/public/');
    }

    public static function mediaUrl($attachment)
    {
        return File::exists(self::storagePath() . $attachment) ? self::storageUrl() . $attachment : NULL;
    }

    public static function mediaUpload($attachment, $file_name = '')
    {
        if (!empty($attachment)) {

            if (!empty($file_name)) {
                self::mediaDelete($file_name);
            }

            $fileName = Str::slug(pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $attachment->getClientOriginalExtension();

            $attachment->storeAs('public', $fileName);

            return $fileName;
        }

        return NULL;
    }

    public static function mediaDelete($file_name)
    {
        $file_name = substr($file_name, strrpos($file_name, '/') + 1);

        if (!empty($file_name) && File::exists(self::storagePath() . $file_name)) {
            File::delete(self::storagePath() . $file_name);
        }
    }
}
