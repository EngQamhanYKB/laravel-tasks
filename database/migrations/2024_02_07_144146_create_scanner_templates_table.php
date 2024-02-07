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
        Schema::create('scanner_templates', function (Blueprint $table) {
            $table->string('scanner_template_pk',45)->primary();
            $table->integer('date_created');
            $table->integer('date_time_modified')->nullable()->default(1704814739);
            $table->text('template_name');
            $table->text('contains');
            $table->text('title_transaction_before');
            $table->text('title_transaction_after');
            $table->text('amount_transaction_before');
            $table->text('amount_transaction_after');
            $table->text('default_category_fk');
            $table->text('wallet_fk');
            $table->integer('ignore')->default(0);
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
        Schema::dropIfExists('scanner_templates');
    }
};
