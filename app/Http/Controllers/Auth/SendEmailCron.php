<?php

namespace App\Console\Commands;

use App\Mail\ChangePriceEmail;
use App\Models\Goods;
use App\Models\GoodsToUsers;
use App\Models\User;
use App\Services\Scraper\ScraperServices;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCron extends Command
{
    const USD           = 'USD';
    const UAH           = 'UAH';
    const EUR           = 'EUR';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailSend:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $products = GoodsToUsers::all();

        foreach ($products as $product) {
            $timeNow = Carbon::now('Europe/Kiev')->timestamp;

            if ( $timeNow > (int) $product->time_send) {

                $data = Goods::query()
                    ->where('id', $product->fk_product)
                    ->first();

                $currentPrice = $this->getCurrentPrice($data['link']);

                if(!$currentPrice){
                    $data->is_active = '0';
                }else{
                    $data->is_active = '1';
                }
                $data->save();

                if ((int) $currentPrice['price'] !== (int) $data['price']) {
                    $this->updateProductPrice($product, $currentPrice);
                    $this->notifyUser($product, $data);
                }
            }
        }
    }

    private function getCurrentPrice($url): array|string|null
    {
        $scraperService = new ScraperServices();

        return $scraperService->findPrice($url);
    }

    private function notifyUser($product, $data): void
    {
        $user = User::query()
            ->where('id', $product->fk_user)
            ->first();

        Mail::to($user['email'])
            ->send(new ChangePriceEmail($user, $data));

    }

    private function updateProductPrice($product, $newPrice): void
    {
        $time_send = Carbon::now('Europe/Kiev')->addHours($product->time_update)->timestamp;

        $currency   = $newPrice['currency'] === 'грн.' ? self::UAH :
            ($newPrice['currency'] === '$' ? self::USD : self::EUR);

        Goods::query()
            ->where('id', $product->fk_product)
            ->update([
                'price'     => $newPrice['price'],
                'currency'  => $currency
            ]);

        $product->time_send = $time_send;
        $product->save();
    }
}
