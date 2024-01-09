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
            $table->id();
            $table->foreignId('fk_user')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('fk_product')->constrained('goods','id')->cascadeOnDelete();
            $table->enum('time_update', ['1', '5', '12', '24'])->default('24');
            $table->string('time_send')->nullable();
            $table->timestamps();
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
