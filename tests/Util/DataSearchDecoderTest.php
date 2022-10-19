<?php

declare(strict_types=1);

namespace GusApi\Tests\Util;

use GusApi\Exception\InvalidServerResponseException;
use GusApi\Tests\GetContentTrait;
use GusApi\Type\Response\SearchDataResponse;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\Response\SearchResponseRaw;
use GusApi\Util\DataSearchDecoder;
use PHPUnit\Framework\TestCase;

class DataSearchDecoderTest extends TestCase
{
    use GetContentTrait;

    public function testDecode(): void
    {
        $content = self::getContent(__DIR__ . '/../resources/response/searchDataResponseResultSingle.xsd');
        $rawResponse = new SearchResponseRaw($content);
        $decodedResponse = DataSearchDecoder::decode($rawResponse);

        $companyData = new SearchResponseCompanyData();
        $companyData->Regon = '02092251199990';
        $companyData->Nip = '0099112233';
        $companyData->StatusNip = '';
        $companyData->Nazwa = 'ZAKŁAD MALARSKI TEST';
        $companyData->Wojewodztwo = 'DOLNOŚLĄSKIE';
        $companyData->Powiat = 'm. Wrocław';
        $companyData->Gmina = 'Wrocław-Stare Miasto';
        $companyData->Miejscowosc = 'Wrocław';
        $companyData->KodPocztowy = '50-038';
        $companyData->Ulica = 'ul. Test-Krucza';
        $companyData->NrNieruchomosci = '208';
        $companyData->NrLokalu = '';
        $companyData->Typ = 'P';
        $companyData->SilosID = '6';
        $companyData->DataZakonczeniaDzialalnosci = '';

        $expected = new SearchDataResponse([
            $companyData,
        ]);

        $this->assertEquals($expected, $decodedResponse);
    }

    public function testDecodeWithInvalidStringStructure(): void
    {
        $this->expectException(InvalidServerResponseException::class);
        $content = 'Invalid XML structure';
        $rawResponse = new SearchResponseRaw($content);
        DataSearchDecoder::decode($rawResponse);
    }

    public function testDecodeEmptyServerResponse(): void
    {
        $rawResponse = new SearchResponseRaw('');
        $decodedResponse = DataSearchDecoder::decode($rawResponse);
        $expected = new SearchDataResponse([]);

        $this->assertEquals($expected, $decodedResponse);
    }
}
