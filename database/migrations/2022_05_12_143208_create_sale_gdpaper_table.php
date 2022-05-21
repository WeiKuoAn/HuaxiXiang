<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleGdpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_gdpaper', function (Blueprint $table) {
            $table->id();
            $table->string('sale_id');
            $table->string('gdpaper_id');
            $table->string('gdpaper_num');
            $table->string('gdpaper_total');
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
        Schema::dropIfExists('sale_gdpaper');
    }
}
