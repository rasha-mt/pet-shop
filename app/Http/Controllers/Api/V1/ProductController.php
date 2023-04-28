<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyExchangeRequest;
use Petshop\CurrencyExchange\CurrencyExchange;

class ProductController extends Controller
{
    public function exchangeToCurrency(Product $product, CurrencyExchangeRequest $request)
    {
        try {
            $priceInCurrency = CurrencyExchange::convert($request->currency, $product->price);
            return $this->success(data: [
                'price'    => $priceInCurrency,
                'currency' => $request->currency
            ]);
        } catch (Exception $e) {
            return $this->failed(error: 'not supplied');
        }

    }

}