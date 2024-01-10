<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'id_product',
        'price',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'created_at'        => 'date',
        'updated_at'        => 'date',
    ];

    public function goodsToUsers(){
        return $this->hasMany(GoodsToUsers::class, 'fk_product');
    }
}
