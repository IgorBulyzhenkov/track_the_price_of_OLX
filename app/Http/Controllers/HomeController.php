<?php

namespace App\Http\Controllers;

use App\Console\Commands\SendEmailCron;
use App\Models\Goods;

class HomeController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->getGoods();

        return view('home.index',[
            'data'  => $data
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

                $link       = '<a href="'.$product->link.'">'.$product->name.'</a>';

                $currency   = $product->currency === self::UAH ? 'грн' :
                                ($product->currency === self::USD ? '$' : '€');

                $data->push(collect([
                    $product->id_product,
                    $link,
                    $product->price.' '.$currency,
                ]));
            }
        }

        return $data;
    }
}
