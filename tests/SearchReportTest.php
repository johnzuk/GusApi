<?php

namespace GusApi\Tests;

use GusApi\SearchReport;
use GusApi\Type\Response\SearchResponseCompanyData;
use PHPUnit\Framework\TestCase;

class SearchReportTest extends TestCase
{
    public function testIsJsonSerializable()
    {
        $companyData = new SearchResponseCompanyData();
        $companyData->Regon = '02092251199990';
        $companyData->RegonLink = 'Link Dane';
        $companyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $companyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $companyData->Powiat = 'm. Wrocław';
        $companyData->Gmina = 'Wrocław-Stare Miasto';
        $companyData->Miejscowosc = 'Wrocław';
        $companyData->KodPocztowy = '50-038';
        $companyData->Ulica = 'ul. Test-Krucza';
        $companyData->Typ = 'P';
        $companyData->SilosID = '6';

        $this->assertEquals([
            'regon' => '02092251199990',
            'regon14' => '02092251199990',
            'name' => 'ZAKŁAD MALARSKI TEST',
            'province' => 'DOLNOŚLĄSKIE',
            'district' => 'm. Wrocław',
            'community' => 'Wrocław-Stare Miasto',
            'city' => 'Wrocław',
            'zipCode' => '50-038',
            'street' => 'ul. Test-Krucza',
            'type' => 'p',
            'silo' => '6',
        ], json_decode(json_encode(new SearchReport($companyData)), true));
    }
}
