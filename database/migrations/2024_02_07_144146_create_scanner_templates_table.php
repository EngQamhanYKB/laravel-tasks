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
            $table->string('scanner_template_pk',45)->index('scanner_templates_scanner_template_pk');
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->text('template_name');
            $table->text('contains');
            $table->text('title_transaction_before');
            $table->text('title_transaction_after');
            $table->text('amount_transaction_before');
            $table->text('amount_transaction_after');
            $table->text('default_category_fk');
            $table->text('wallet_fk');
            $table->integer('ignore')->default(0);
            $table->string('customer_id', 45)->index('scanner_templates_customer_id');
            $table->bigInteger('customer_type_id')->index('scanner_templates_customer_type_id');
            $table->primary(["scanner_template_pk","customer_id", "customer_type_id"]);
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
