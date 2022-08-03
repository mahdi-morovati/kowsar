<?php

namespace Tests\Feature;

use App\Facades\SocialLoginFacade;
use Tests\TestCase;

class SocialLoginTest extends TestCase
{
    public function testSocialRedirectDriverNotFound()
    {
        try {
            SocialLoginFacade::redirect('googleqwq');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver is not defined!', $exception->getMessage());
        }
    }

    public function testSocialRedirectDriverClientIdNotDefine()
    {
        try {
            config(['services.google.client_id' => null]);
            SocialLoginFacade::redirect('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client ID not defined!', $exception->getMessage());
        }
    }

    public function testSocialRedirectDriverClientSecretNotDefine()
    {
        try {
            config(['services.google.client_secret' => null]);
            SocialLoginFacade::redirect('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client Secret not defined!', $exception->getMessage());
        }
    }

    public function testSocialRedirectDriverRedirectNotDefine()
    {
        try {
            config(['services.google.redirect' => null]);
            SocialLoginFacade::redirect('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client Redirect not defined!', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverNotFound()
    {
        try {
            SocialLoginFacade::redirect('googleqwq');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver is not defined!', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverClientIdNotDefine()
    {
        try {
            config(['services.google.client_id' => null]);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client ID not defined!', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverClientSecretNotDefine()
    {
        try {
            config(['services.google.client_secret' => null]);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client Secret not defined!', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverRedirectNotDefine()
    {
        try {
            config(['services.google.redirect' => null]);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('The driver Client Redirect not defined!', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverClientIdWrong()
    {
        try {
            config(['services.google.client_id' => 'asdasd']);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('Error in login with google', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverClientSecretWrong()
    {
        try {
            config(['services.google.client_secret' => 'asdasd']);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('Error in login with google', $exception->getMessage());
        }
    }

    public function testSocialCallbackDriverRedirectWrong()
    {
        try {
            config(['services.google.redirect' => 'asdasd']);
            SocialLoginFacade::callback('google');
        } catch (\Exception $exception) {
            $this->assertEquals('Error in login with google', $exception->getMessage());
        }
    }

}
