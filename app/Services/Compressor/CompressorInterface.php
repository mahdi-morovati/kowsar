<?php

namespace App\Services\Compressor;

interface CompressorInterface
{
    public function compress(string $filePath);

}
