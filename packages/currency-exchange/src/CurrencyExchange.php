<?php

namespace Petshop\CurrencyExchange;

use Exception;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class CurrencyExchange
{
    public static function convert(string $toCurr, float $amount = 1)
    {
        try {
            $xml = XmlParser::remote('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

            $currency_array = $xml->parse([
                'currency' => ['uses' => 'Cube.Cube.Cube[::currency>curr,::rate>rate]'],
            ]);

            $currency_collection = collect($currency_array['currency']);

            $currency_rate = $currency_collection->firstWhere('curr', Str::upper($toCurr));
            $rate = (float) $currency_rate['rate'];
            return round($amount / $rate, 2);

        } catch (Exception $e) {
            return $e;
        }

    }

}