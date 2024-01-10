<?php

namespace App\Http\Controllers;

use App\Console\Commands\SendEmailCron;
use App\Models\Goods;
use App\Services\Scraper\ScraperServices;
use Carbon\Carbon;

class HomeController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->getGoods();

        return view('home.index',[
            'data'  => $data,
            'date'  => $this->date
        ]);
    }

    private function getGoods(): \Illuminate\Support\Collection
    {
        $data           = collect([]);

        $goodsToUser    = auth()->user()->goods;

        $idProduct      = [];

        foreach ($goodsToUser as $el){
            $idProduct[] = $el['fk_product'];
        }

        $goods = Goods::query()
            ->whereIn('id', $idProduct)
            ->get();

        if($goods){
            foreach ($goods as $product) {

                $link       = '<a class="link_product" href="'.$product->link.'" target="_blade">'.$product->name.'</a>';

                $active    = $product->is_active === '1' ? '<i class="fa-solid fa-circle-check" style="color: green">1</i>' :
                    '<i class="fa-solid fa-circle-exclamation" style="color:red">0</i>';

                $currency   = $product->currency === self::UAH ? 'грн' :
                                ($product->currency === self::USD ? '$' : '€');

                $data->push(collect([
                    $product->id_product,
                    $link,
                    $product->price.' '.$currency,
                    $active
                ]));
            }
        }

        return $data;
    }
}
