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
        Schema::create('objectives', function (Blueprint $table) {
            $table->string('objective_pk',45)->index('objectives_objective_pk');

            $table->integer('type')->default(0);
            $table->text('name');
            $table->double('amount');
            $table->integer('order');
            $table->text('colour')->nullable();
            $table->bigInteger('date_created');
            $table->bigInteger('end_date')->nullable();
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->text('icon_name')->nullable();
            $table->text('emoji_icon_name')->nullable();
            $table->integer('income')->default(0);
            $table->integer('pinned')->default(1);
            $table->integer('archived')->default(0);
            $table->text('wallet_fk');
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('objectives_customer_id');
            $table->bigInteger('customer_type_id')->index('objectives_customer_type_id');
            $table->primary(["objective_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objectives');
    }
};
