<?php

declare(strict_types=1);

namespace GusApi\Tests;

use GusApi\SearchReport;
use GusApi\Type\Response\SearchResponseCompanyData;
use PHPUnit\Framework\TestCase;

class SearchReportTest extends TestCase
{
    public function testIsJsonSerializable(): void
    {
        $companyData = new SearchResponseCompanyData();
        $companyData->Regon = '02092251199990';
        $companyData->Nip = '9988660000';
        $companyData->StatusNip = 'U';
        $companyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $companyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $companyData->Powiat = 'm. Wrocław';
        $companyData->Gmina = 'Wrocław-Stare Miasto';
        $companyData->Miejscowosc = 'Wrocław';
        $companyData->KodPocztowy = '50-038';
        $companyData->Ulica = 'ul. Test-Krucza';
        $companyData->NrNieruchomosci = '33';
        $companyData->NrLokalu = '34B';
        $companyData->Typ = 'P';
        $companyData->SilosID = '6';
        $companyData->DataZakonczeniaDzialalnosci = '2029-02-22';
        $companyData->MiejscowoscPoczty = 'Płock';

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
            'silo' => 6,
            'nip' => '9988660000',
            'nipStatus' => 'U',
            'propertyNumber' => '33',
            'apartmentNumber' => '34B',
            'activityEndDate' => '2029-02-22',
            'postCity' => 'Płock',
        ], json_decode((string) json_encode(new SearchReport($companyData)), true));
    }
}
