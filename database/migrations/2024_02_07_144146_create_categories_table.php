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
            $table->string('category_pk', 45)->primary();
            $table->text('name');
            $table->text('colour')->nullable();
            $table->text('icon_name')->nullable();
            $table->text('emoji_icon_name')->nullable();
            $table->integer('date_created');
            $table->integer('date_time_modified')->nullable()->default(1704814739);
            $table->integer('order');
            $table->integer('income')->default(0);
            $table->integer('method_added')->nullable();
            $table->text('main_category_pk')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
