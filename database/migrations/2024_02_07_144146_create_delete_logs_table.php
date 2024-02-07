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
            $table->string('delete_log_pk',45)->primary();
            $table->text('entry_pk');
            $table->integer('type');
            $table->integer('date_time_modified')->default(1704814739);
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
        Schema::dropIfExists('delete_logs');
    }
};
