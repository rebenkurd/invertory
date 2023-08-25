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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('invertory_id');
            $table->string('sale_date');
            $table->string('invoice_no')->unique();
            $table->enum('currency',['iqd','usd'])->default('iqd');
            $table->string('attach_file')->nullable();
            $table->string('amount');
            $table->enum('pay_status',['paid', 'partial', 'unpaid'])->nullable();
            $table->string('pay_due')->nullable();
            $table->tinyInteger('return_status')->default(0)->nullable();
            $table->string('return_date')->nullable();
            $table->string('notes')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invertory_id')->references('id')->on('invertories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sales');
    }
};
