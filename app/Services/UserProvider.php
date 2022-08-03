<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProvider
{
    public function GetUserOrCreateByEmail(string $email, string $nickname = null, string $name = null, string $password = null)
    {
        $name = $name ?? $nickname ?? $email;
        $user = User::updateOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        return $user;
    }

    public function login(User $user): void
    {
        Auth::login($user);
    }
}
