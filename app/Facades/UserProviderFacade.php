<?php

namespace App\Facades;

use App\Models\User;
use App\Services\UserProvider;
use Illuminate\Support\Facades\Facade;

/**
 * @method GetUserOrCreateByEmail(string $email, string $name, string $password = null)
 * @method login(User $user)
 */
class UserProviderFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserProvider::class;
    }

}
