<?php

use Orchestra\Parser\Xml\Facade as XmlParser;

class CurrencyExchangeTest extends TestCase
{

    public function test_can_exchange_currency()
    {
        $document = XmlParser::via(simplexml_load_string(
            '<?xml version="1.0" standalone="yes"?>
            <gesmes:Envelope xmlns:gesmes="http://www.gesmes.org/xml/2002-08-01" xmlns="http://www.ecb.int/vocabulary/2002-08-01/eurofxref">
<gesmes:subject>Reference rates</gesmes:subject>
<gesmes:Sender>
<gesmes:name>European Central Bank</gesmes:name>
</gesmes:Sender>
<Cube>
<Cube time="2023-04-28">
<Cube currency="USD" rate="1.0981"/>
<Cube currency="JPY" rate="149.35"/>
<Cube currency="BGN" rate="1.9558"/>
</Cube>
</Cube>
</gesmes:Envelope>'
        ));


    }
}