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
        Schema::create('delete_logs', function (Blueprint $table) {
            $table->string('delete_log_pk',45)->index('delete_logs_delete_log_pk');
            $table->text('entry_pk');
            $table->integer('type');
            $table->bigInteger('date_time_modified')->default(1704814739);
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('delete_logs_customer_id');
            $table->bigInteger('customer_type_id')->index('delete_logs_customer_type_id');
            $table->primary(["delete_log_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delete_logs');
    }
};
