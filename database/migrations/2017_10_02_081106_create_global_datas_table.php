<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_datas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->default(null);
            $table->string('symbol')->default(null);
            $table->double('rank')->default(null);
            $table->double('price_usd')->default(null);
            $table->double('price_btc')->default(null);
            $table->double('volume_usd_24h')->default(null);
            $table->double('market_cap_usd')->default(null);
            $table->double('available_supply')->default(null);
            $table->double('total_supply')->default(null);
            $table->double('percent_change_1h')->default(null);
            $table->double('percent_change_24h')->default(null);
            $table->double('percent_change_7d')->default(null);
            $table->integer('last_updated')->default(null);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_datas');
    }
}
