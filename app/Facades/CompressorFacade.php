<?php

namespace App\Facades;

use App\Services\Compressor\RarCompressor;
use App\Services\Compressor\ZipCompressor;
use Illuminate\Support\Facades\Facade;

/**
 * @method compress(string $file)
 */
class CompressorFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        $types = ['zip' => ZipCompressor::class, 'rar' => RarCompressor::class];

        $compressType = config('compressor.type');
        if (isset($types[$compressType])) {
            return $types[$compressType];
        }

        return ZipCompressor::class;
    }

}
