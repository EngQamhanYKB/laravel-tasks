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
        Schema::create('associated_titles', function (Blueprint $table) {
            $table->string('associated_title_pk',45)->primary();
            $table->text('category_fk');
            $table->text('title');
            $table->integer('date_created');
            $table->integer('date_time_modified')->nullable()->default(1704814739);
            $table->integer('order');
            $table->integer('is_exact_match')->default(0);
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
        Schema::dropIfExists('associated_titles');
    }
};
