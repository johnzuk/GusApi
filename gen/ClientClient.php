<?php

namespace GusApi;

class ClientClient extends \Phpro\SoapClient\Client
{

    public function pobierzCaptcha(\GusApi\Type\PobierzCaptcha $PobierzCaptcha) : \GusApi\Type\PobierzCaptchaResponse
    {
        return $this->call('PobierzCaptcha', $PobierzCaptcha);
    }

    public function sprawdzCaptcha(\GusApi\Type\SprawdzCaptcha $SprawdzCaptcha) : \GusApi\Type\SprawdzCaptchaResponse
    {
        return $this->call('SprawdzCaptcha', $SprawdzCaptcha);
    }

    public function getValue(\GusApi\Type\GetValue $GetValue) : \GusApi\Type\GetValueResponse
    {
        return $this->call('GetValue', $GetValue);
    }

    public function setValue(\GusApi\Type\SetValue $SetValue) : \GusApi\Type\SetValueResponse
    {
        return $this->call('SetValue', $SetValue);
    }

    public function zaloguj(\GusApi\Type\Zaloguj $Zaloguj) : \GusApi\Type\ZalogujResponse
    {
        return $this->call('Zaloguj', $Zaloguj);
    }

    public function wyloguj(\GusApi\Type\Wyloguj $Wyloguj) : \GusApi\Type\WylogujResponse
    {
        return $this->call('Wyloguj', $Wyloguj);
    }

    public function daneSzukaj(\GusApi\Type\DaneSzukaj $DaneSzukaj) : \GusApi\Type\DaneSzukajResponse
    {
        return $this->call('DaneSzukaj', $DaneSzukaj);
    }

    public function danePobierzPelnyRaport(\GusApi\Type\DanePobierzPelnyRaport $DanePobierzPelnyRaport) : \GusApi\Type\DanePobierzPelnyRaportResponse
    {
        return $this->call('DanePobierzPelnyRaport', $DanePobierzPelnyRaport);
    }

    public function daneKomunikat(\GusApi\Type\DaneKomunikat $DaneKomunikat) : \GusApi\Type\DaneKomunikatResponse
    {
        return $this->call('DaneKomunikat', $DaneKomunikat);
    }


}

