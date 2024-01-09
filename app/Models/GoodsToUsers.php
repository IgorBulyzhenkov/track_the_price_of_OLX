<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsToUsers extends Model
{
    use HasFactory;

    public $fillable = [
        'fk_user',
        'fk_product',
        'time_update',
        'time_send',
    ];

    public function fkUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'fk_user');
    }

    public function fkGoods(){
        return $this->belongsTo(Goods::class, 'id');
    }
}
