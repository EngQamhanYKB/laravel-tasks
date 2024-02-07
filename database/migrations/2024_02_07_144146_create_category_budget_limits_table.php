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
        Schema::create('category_budget_limits', function (Blueprint $table) {
            $table->string('category_limit_pk',45)->primary();
            $table->text('category_fk');
            $table->text('budget_fk');
            $table->double('amount');
            $table->integer('date_time_modified')->nullable()->default(1704814739);
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
        Schema::dropIfExists('category_budget_limits');
    }
};
