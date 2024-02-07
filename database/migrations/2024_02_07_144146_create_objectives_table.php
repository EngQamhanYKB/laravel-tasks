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
            $table->string('objective_pk',45)->primary();

            $table->integer('type')->default(0);
            $table->text('name');
            $table->double('amount');
            $table->integer('order');
            $table->text('colour')->nullable();
            $table->integer('date_created');
            $table->integer('end_date')->nullable();
            $table->integer('date_time_modified')->nullable()->default(1704814739);
            $table->text('icon_name')->nullable();
            $table->text('emoji_icon_name')->nullable();
            $table->integer('income')->default(0);
            $table->integer('pinned')->default(1);
            $table->integer('archived')->default(0);
            $table->text('wallet_fk');
            $table->integer('synced')->nullable()->default(0);
            $table->string('party_id', 45)->nullable()->index('budgets_party_id');
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
