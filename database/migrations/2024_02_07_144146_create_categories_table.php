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
        Schema::create('categories', function (Blueprint $table) {
            $table->string('category_pk', 45)->index('categories_category_pk');
            $table->text('name');
            $table->text('colour')->nullable();
            $table->text('icon_name')->nullable();
            $table->text('emoji_icon_name')->nullable();
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->integer('order');
            $table->integer('income')->default(0);
            $table->integer('method_added')->nullable();
            $table->text('main_category_pk')->nullable();
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('categories_customer_id');
            $table->bigInteger('customer_type_id')->index('categories_customer_type_id');
            $table->primary(["category_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
