<?php

namespace App\Http\Controllers;

use App\Models\Goods;

class HomeController extends BaseController
{
    public function index()
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

                $link       = '<a class="link_product" href="'.$product->link.'" target="_blade">'.$product->name.'</a>';

                $active    = $product->is_active === '1' ? '<i class="fa-solid fa-circle-check" style="color: green">1</i>' :
                    '<i class="fa-solid fa-circle-exclamation" style="color:red">0</i>';

                $currency   = $product->currency === self::UAH ? 'грн' :
                                ($product->currency === self::USD ? '$' : '€');

                $action = '<form action="'. route('check.price',['id' => $product->id]).'" method="POST">
                                <input value="'.csrf_token().'" type="hidden" name="_token" autocomplete="off">
                                <button type="submit" class="btn btn-info btn_check">Перевірити</button>
                            </form>
                            <form action="'. route('delete.product',['id' => $product->id]).'" method="POST">
                                <input value="'.csrf_token().'" type="hidden" name="_token" autocomplete="off">
                                <input value="DELETE" type="hidden" name="_method" autocomplete="off">
                                <button type="submit" class="btn btn-danger btn_delete" >Видалити</button>
                            </form>';

                $data->push(collect([
                    $product->id_product,
                    $link,
                    $product->price.' '.$currency,
                    $active,
                    $action
                ]));
            }
        }

        return $data;
    }
}
