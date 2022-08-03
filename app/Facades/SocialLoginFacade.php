<?php

namespace App\Facades;

use App\Services\Compressor\RarCompressor;
use App\Services\Compressor\ZipCompressor;
use App\Services\SocialLogin;
use Illuminate\Support\Facades\Facade;

/**
 * @method compress(string $file)
 */
class SocialLoginFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'SocialLogin';
    }

}
