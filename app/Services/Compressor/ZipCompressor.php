<?php

namespace App\Services\Compressor;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipCompressor implements CompressorInterface
{
    public function compress(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new \Exception('The file does not exists!');
        }
        if (File::size($filePath) > config('compressor.size')) {
            throw new \Exception('The file is over than the limit!');
        }

        $zipFileName = File::name($filePath) . '.' . config('compressor.type');
        $path = Storage::disk('public')->path("upload/{$zipFileName}");

        $zip = new ZipArchive;
        if ($zip->open($path, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($filePath, Carbon::now());
            $zip->close();
        } else {
            throw new \Exception('Some error in compress file!');
        }
        return $path;

    }
}
