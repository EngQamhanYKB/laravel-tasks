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
            $table->string('associated_title_pk',45)->index('associated_titles_associated_title_pk');
            $table->text('category_fk');
            $table->text('title');
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->integer('order');
            $table->integer('is_exact_match')->default(0);
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('associated_titles_customer_id');
            $table->bigInteger('customer_type_id')->index('associated_titles_customer_type_id');
            $table->primary(["associated_title_pk","customer_id", "customer_type_id"]);

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
