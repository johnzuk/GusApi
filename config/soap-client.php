<?php

use Phpro\SoapClient\CodeGenerator\Assembler;
use Phpro\SoapClient\CodeGenerator\Rules;
use Phpro\SoapClient\CodeGenerator\Config\Config;

return Config::create()
    ->setWsdl('https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd')
    ->setTypeDestination('gen/Type')
    ->setTypeNamespace('GusApi\Type')
    ->setClientDestination('gen')
    ->setClientName('ClientClient')
    ->setClientNamespace('GusApi')
    ->setClassMapDestination('gen')
    ->setClassMapName('ClientClassmap')
    ->setClassMapNamespace('GusApi')
    ->addRule(new Rules\AssembleRule(new Assembler\GetterAssembler(new Assembler\GetterAssemblerOptions())))
    ->addRule(new Rules\AssembleRule(new Assembler\ImmutableSetterAssembler()))
;
