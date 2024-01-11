<?php

namespace App\Services\Scraper;

use App\Models\Goods;
use Mockery\Exception;
use Symfony\Component\DomCrawler\Crawler;

class ScraperServices
{
    const BOOL_TRUE     = '1';
    const USD           = 'USD';
    const UAH           = 'UAH';
    const EUR           = 'EUR';

    public function scrape($data)
    {
        try{
            $dataLink = $data['link'];
            $content = file_get_contents($dataLink);

            if ($content === false) {
                return false;
            }

            $crawler = new Crawler($content);

            if($crawler->filter('.css-12hdxwj')->count() === 0){
                return false;
            }

            $productId  = explode(' ', $crawler->filter('.css-12hdxwj')->text());

            if($id = $this->findId($productId[1])){
                return $id;
            }

            $name       = $crawler->filter('.css-1juynto')->text();

            $price      = $this->findPrice($data['link'], $crawler);

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

            return $this->product($dataProduct);
        }catch(\Exception $e){
            return false;
        }

    }

    private function product($data)
    {
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

    private function findId($id)
    {
        $product = Goods::query()
            ->where('id_product', $id)
            ->first();

        return is_null($product) ? $product : $product['id'];
    }

    public function findPrice($url, $crawler = null, $id = null)
    {
        try {
            if(is_null($crawler)) {
                $content = file_get_contents($url);

                if ($content === false) {
                    return false;
                }

                $crawler = new Crawler($content);
            }

            if($crawler->filter('.css-12vqlj3')->count() === 0){
                return false;
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
        }catch (Exception $e){
            return false;
        }
    }
}
