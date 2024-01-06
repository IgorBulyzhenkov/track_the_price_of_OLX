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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('id_product')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('link');
            $table->enum('time_update', ['1', '5', '12', '24'])->default('24');
            $table->dateTime('time_send');
            $table->enum('is_active',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
