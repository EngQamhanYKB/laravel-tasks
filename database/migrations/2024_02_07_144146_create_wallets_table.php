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
        Schema::create('wallets', function (Blueprint $table) {
            $table->string('wallet_pk',45)->index('wallets_wallet_pk');
            $table->text('name');
            $table->text('colour')->nullable();
            $table->text('icon_name')->nullable();
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->integer('order');
            $table->text('currency')->nullable();
            $table->text('currency_format')->nullable();
            $table->integer('decimals')->default(2);
            $table->text('home_page_widget_display')->nullable();
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('wallets_customer_id');
            $table->bigInteger('customer_type_id')->index('wallets_customer_type_id');
            $table->primary(["wallet_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
