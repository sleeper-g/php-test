<?php

declare(strict_types=1);

trait AppUserAuthentication
{
    private string $appLogin = 'app_user';
    private string $appPassword = 'app_pass';

    public function authenticate(string $login, string $password): string|false
    {
        return ($login === $this->appLogin && $password === $this->appPassword)
            ? 'Пользователь авторизован как пользователь приложения.'
            : false;
    }
}

trait MobileUserAuthentication
{
    private string $mobileLogin = 'mobile_user';
    private string $mobilePassword = 'mobile_pass';

    public function authenticate(string $login, string $password): string|false
    {
        return ($login === $this->mobileLogin && $password === $this->mobilePassword)
            ? 'Пользователь авторизован как пользователь мобильного приложения.'
            : false;
    }
}

class UserAuthChecker
{
    use AppUserAuthentication, MobileUserAuthentication {
        AppUserAuthentication::authenticate insteadof MobileUserAuthentication;
        MobileUserAuthentication::authenticate as authenticateMobile;
        AppUserAuthentication::authenticate as authenticateApp;
    }

    public function authenticate(string $login, string $password): string
    {
        if ($appResult = $this->authenticateApp($login, $password)) {
            return $appResult;
        }

        if ($mobileResult = $this->authenticateMobile($login, $password)) {
            return $mobileResult;
        }

        return 'Ошибка: неверный логин или пароль.';
    }
}

function runAuthTests(): void
{
    $checker = new UserAuthChecker();

    echo $checker->authenticate('app_user', 'app_pass') . PHP_EOL;
    echo $checker->authenticate('mobile_user', 'mobile_pass') . PHP_EOL;
    echo $checker->authenticate('wrong', 'data') . PHP_EOL;
}

runAuthTests();

