<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pr_code');
            $table->string('pr_name');
            $table->string('pr_image')->nullable();
            $table->string('stock')->default(0);
            $table->string('price');
            $table->string('qty')->default(0);
            $table->string('x_margin')->nullable();
            $table->string('selling_price');
            $table->enum('currency',['iqd','usd'])->default('iqd');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
