<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodsRequest;
use App\Models\GoodsToUsers;
use App\Services\Scraper\ScraperServices;
use Carbon\Carbon;

class GoodsController extends Controller
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
}
