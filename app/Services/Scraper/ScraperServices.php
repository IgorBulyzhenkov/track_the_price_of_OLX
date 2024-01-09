<?php

namespace App\Services\Scraper;

use App\Mail\ChangePriceEmail;
use App\Models\Goods;
use App\Models\GoodsToUsers;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Event\Code\Throwable;

class ScraperServices
{
    const BOOL_TRUE     = '1';
    const BOOL_FALSE    = '0';

    const USD           = 'USD';
    const UAH           = 'UAH';
    const EUR           = 'EUR';
    public function scrape($data)
    {
        $client     = new Client();

        $crawler    = $client->request('GET', $data['link']);

        if($crawler->filter('.css-12hdxwj')->count() === 0){
            return false;
        }

        $productId  = explode(' ', $crawler->filter('.css-12hdxwj')->text());

        $name       = $crawler->filter('.css-1juynto')->text();

        $price      = $this->findPrice($data['link'], $client, $crawler);

        $currency   = $price['currency'] === 'грн.' ? self::UAH :
                        ($price['currency'] === '$' ? self::USD : self::EUR);

        $dataProduct = [
            'productId'     => $productId[1],
            'name'          => $name,
            'price'         => $price['price'],
            'currency'      => $currency,
            'time_update'   => $data['time_update'],
            'link'          => $data['link']
        ];

        $id = $this->product($dataProduct);

        return $id;
    }

    private function product($data){

        $product = Goods::query()
            ->where('id_product', $data['productId'])
            ->first();

        if(empty($product['id'])) {

            $product_new = Goods::query()
                ->create([
                    'link'          => $data['link'],
                    'name'          => $data['name'],
                    'price'         => $data['price'],
                    'currency'      => $data['currency'],
                    'id_product'    => $data['productId'],
                    'is_active'     => self::BOOL_TRUE
                ]);

            return $product_new->id;
        }

        return $product['id'];
    }

    public function findPrice($url, $client = new Client(), $crawler = null): array
    {
        if(is_null($crawler)) {
            $crawler    = $client->request('GET', $url);
        }

        $text_price     = $crawler->filter('.css-12vqlj3')->text();

        $currency       = explode(' ', $text_price);

        $index          = count($currency) - 1;

        $currency       = $currency[$index];

        $price          = preg_replace("/[^0-9]/", "", str_replace(' ', '', $text_price));

        return [
            'price'     => $price,
            'currency'  => $currency
        ];
    }
}
