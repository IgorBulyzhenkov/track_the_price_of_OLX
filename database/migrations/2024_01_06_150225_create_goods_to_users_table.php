<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('goods_to_users', function (Blueprint $table) {
            $table->foreignId('fk_user')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('fk_product')->constrained('goods','id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_to_users');
    }
};
