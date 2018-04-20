<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 20.04.18
 * Time: 14:42
 */

namespace GusApi\Util;

use GusApi\Type\SearchDataResponse;
use GusApi\Type\SearchResponseCompanyData;
use GusApi\Type\SearchResponseRaw;
use PHPUnit\Framework\TestCase;

class DataSearchDecoderTest extends TestCase
{
    public function testDecode()
    {
        $content = file_get_contents(__DIR__ . '/../resources/response/searchDataResponseResult.xsd');
        $rawResponse = new SearchResponseRaw($content);
        $decodedResponse = DataSearchDecoder::decode($rawResponse);

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

        $expected = new SearchDataResponse([
            $companyData
        ]);

        $this->assertEquals($expected, $decodedResponse);
    }

    public function testDecodeWithInvalidStringStructure()
    {
        $content = 'Invalid XML structure';
        $rawResponse = new SearchResponseRaw($content);
        $decodedResponse = DataSearchDecoder::decode($rawResponse);
        $expected = new SearchDataResponse([]);

        $this->assertEquals($expected, $decodedResponse);
    }
}
