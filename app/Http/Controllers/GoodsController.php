<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodsRequest;
use App\Models\Goods;
use App\Models\GoodsToUsers;
use App\Services\Scraper\ScraperServices;
use Carbon\Carbon;

class GoodsController extends BaseController
{
    private ScraperServices $scrapeService;
    public function __construct(ScraperServices $scraperServices)
    {
        $this->scrapeService    = $scraperServices;
    }

    public function create(GoodsRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data   = $request->validated();

        $id     = $this->scrapeService->scrape($data);

        if(!$id){
            return redirect()->route('home')->with('error', 'Це посилання не можливо обробити, додайте інше посилання!');
        }

        $time_send = Carbon::now('Europe/Kiev')->addHours($data['time_update'])->timestamp;

        $goodsToUsers = GoodsToUsers::query()
            ->where([
                'fk_user'       => auth()->id(),
                'fk_product'    => $id
            ])
            ->exists();

        if($goodsToUsers){
            return redirect()->route('home')->with('success', 'Ви вже додали цей товар для відстежування!');
        }

        GoodsToUsers::query()
            ->create([
                'fk_user'       => auth()->id(),
                'fk_product'    => $id,
                'time_update'   => $data['time_update'],
                'time_send'     => $time_send,
            ]);

        return redirect()->route('home')->with('success', 'Товар додано на опрацювання!');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $product = Goods::query()
            ->where('id', $id)
            ->first();

        if(!$product->id){
            return redirect()->route('home')->with('error', "Такого оголошення не знаййденно!");
        }

        $product->delete();

        return redirect()->route('home')->with('success', "Оголошення відаленно!");
    }

    public function check($id, ScraperServices $scraperServices): \Illuminate\Http\RedirectResponse
    {
        $product = Goods::query()
            ->where('id', $id)
            ->first();

        if(!$product->id){
            return redirect()->route('home')->with('error', "Такого оголошення не знайденно!");
        }

        $price = $scraperServices->findPrice($product->link);

        if (!$price){
            $product->is_active = '0';
            $product->save();
            return redirect()->route('home')->with('error', "Такого оголошення не знайденно!");
        }

        if($price['price'] === $product->price){
            return redirect()->route('home')->with('success', "Цінна не змінилася!");
        }

        $product->price = $price['price'];

        $currency   = $price['currency'] === 'грн.' ? self::UAH :
            ($price['currency'] === '$' ? self::USD : self::EUR);

        $product->currency = $currency;
        $product->save();

        return redirect()->route('home')->with('success', "Цінна змінилася! Нова цінна ".$price['price'].' '.$price['currency']."!");
    }
}
