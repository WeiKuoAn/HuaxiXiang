<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_data', function (Blueprint $table) {
            $table->id();
            $table->string('sale_on');
            $table->string('user_id');
            $table->date('sale_date');
            $table->string('customer_id');
            $table->string('pet_name');
            $table->string('type');
            $table->string('plan_id');
            $table->string('plan_price');
            $table->string('after_prom_id');
            $table->string('after_prom_price');
            $table->string('pay_id');
            $table->string('pay_price');
            $table->string('total');
            $table->text('comm');
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
        Schema::dropIfExists('sale_data');
    }
}
