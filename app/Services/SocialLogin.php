<?php

namespace App\Services;

use App\Facades\UserProviderFacade;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin
{
    public function redirect($driver)
    {
        $this->validateDriver($driver);

        $driverKeys = config('services')[$driver];
        $driverKeys = $this->validateDriverClientId($driverKeys);
        $driverKeys = $this->validateDriverClientSecret($driverKeys);
        $this->validateDriverRedirect($driverKeys);

        return Socialite::driver($driver)
            ->with(['state' => $driver])
            ->stateless()
            ->redirect();
    }

    public function callback($driver): void
    {
        $this->validateDriver($driver);

        $driverKeys = config('services')[$driver];
        $driverKeys = $this->validateDriverClientId($driverKeys);
        $driverKeys = $this->validateDriverClientSecret($driverKeys);
        $this->validateDriverRedirect($driverKeys);

        try {
            $socialUser = Socialite::driver($driver)->stateless()->user();

            $user = UserProviderFacade::GetUserOrCreateByEmail($socialUser->getEmail(), $socialUser->getNickName(), $socialUser->getName());

            UserProviderFacade::login($user);
        } catch (\Exception $exception) {
            throw new \Exception("Error in login with {$driver}");
        }
    }

    public function validateDriver($driver): void
    {
        if (!isset(config('services')[$driver])) {
            throw new \Exception('The driver is not defined!');
        }
    }

    public function validateDriverClientId(mixed $driverKeys): mixed
    {
        if (!isset($driverKeys['client_id'])) {
            throw new \Exception('The driver Client ID not defined!');
        }
        return $driverKeys;
    }

    public function validateDriverClientSecret(mixed $driverKeys): mixed
    {
        if (!isset($driverKeys['client_secret'])) {
            throw new \Exception('The driver Client Secret not defined!');
        }
        return $driverKeys;
    }

    public function validateDriverRedirect(mixed $driverKeys): void
    {
        if (!isset($driverKeys['redirect'])) {
            throw new \Exception('The driver Client Redirect not defined!');
        }
    }
}
