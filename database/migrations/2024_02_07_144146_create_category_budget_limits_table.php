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
            $table->string('category_limit_pk',45)->index('category_budget_limits_category_limit_pk');
            $table->text('category_fk');
            $table->text('budget_fk');
            $table->double('amount');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->text('wallet_fk');
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('category_budget_limits_customer_id');
            $table->bigInteger('customer_type_id')->index('category_budget_limits_customer_type_id');
            $table->primary(["category_limit_pk","customer_id", "customer_type_id"]);
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
