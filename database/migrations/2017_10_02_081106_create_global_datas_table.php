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
            $table->string('name');
            $table->string('symbol');
            $table->string('rank');
            $table->float('price_usd');
            $table->float('price_btc');
            $table->float('24h_volume_usd');
            $table->float('market_cap_usd');
            $table->float('available_supply');
            $table->float('total_supply');
            $table->float('available_supply');
            $table->float('percent_change_1h');
            $table->float('percent_change_24h');
            $table->float('percent_change_7d');
            $table->timestamp('last_updated');
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
        Schema::dropIfExists('global_datas');
    }
}
