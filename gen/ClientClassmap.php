<?php

namespace GusApi;

use GusApi\Type;
use Phpro\SoapClient\Soap\ClassMap\ClassMapCollection;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;

class ClientClassmap
{

    public static function getCollection() : \Phpro\SoapClient\Soap\ClassMap\ClassMapCollection
    {
        return new ClassMapCollection([
            new ClassMap('PobierzCaptcha', Type\PobierzCaptcha::class),
            new ClassMap('PobierzCaptchaResponse', Type\PobierzCaptchaResponse::class),
            new ClassMap('SprawdzCaptcha', Type\SprawdzCaptcha::class),
            new ClassMap('SprawdzCaptchaResponse', Type\SprawdzCaptchaResponse::class),
            new ClassMap('GetValue', Type\GetValue::class),
            new ClassMap('GetValueResponse', Type\GetValueResponse::class),
            new ClassMap('SetValue', Type\SetValue::class),
            new ClassMap('SetValueResponse', Type\SetValueResponse::class),
            new ClassMap('ParametryWyszukiwania', Type\ParametryWyszukiwania::class),
            new ClassMap('Zaloguj', Type\Zaloguj::class),
            new ClassMap('ZalogujResponse', Type\ZalogujResponse::class),
            new ClassMap('Wyloguj', Type\Wyloguj::class),
            new ClassMap('WylogujResponse', Type\WylogujResponse::class),
            new ClassMap('DaneSzukaj', Type\DaneSzukaj::class),
            new ClassMap('DaneSzukajResponse', Type\DaneSzukajResponse::class),
            new ClassMap('DanePobierzPelnyRaport', Type\DanePobierzPelnyRaport::class),
            new ClassMap('DanePobierzPelnyRaportResponse', Type\DanePobierzPelnyRaportResponse::class),
            new ClassMap('DaneKomunikat', Type\DaneKomunikat::class),
            new ClassMap('DaneKomunikatResponse', Type\DaneKomunikatResponse::class),
        ]);
    }


}

