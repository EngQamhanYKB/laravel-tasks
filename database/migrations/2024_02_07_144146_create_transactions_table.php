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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_pk',45)->index('transactions_transaction_pk');
            $table->text('paired_transaction_fk')->nullable();
            $table->text('name')->nullable();
            $table->double('amount');
            $table->text('note')->nullable();
            $table->text('category_fk');
            $table->text('sub_category_fk')->nullable();
            $table->text('wallet_fk');
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->bigInteger('original_date_due')->nullable()->default(1704814739);
            $table->integer('income')->default(0);
            $table->integer('period_length')->nullable();
            $table->integer('reoccurrence')->nullable();
            $table->integer('end_date')->nullable();
            $table->integer('upcoming_transaction_notification')->nullable()->default(1);
            $table->integer('type')->nullable();
            $table->integer('paid')->default(0);
            $table->integer('created_another_future_transaction')->nullable()->default(0);
            $table->integer('skip_paid')->default(0);
            $table->integer('method_added')->nullable();
            $table->text('transaction_owner_email')->nullable();
            $table->text('transaction_original_owner_email')->nullable();
            $table->text('shared_key')->nullable();
            $table->text('shared_old_key')->nullable();
            $table->integer('shared_status')->nullable();
            $table->integer('shared_date_updated')->nullable();
            $table->text('shared_reference_budget_pk')->nullable();
            $table->text('objective_fk')->nullable();
            $table->text('objective_loan_fk')->nullable();
            $table->text('budget_fks_exclude')->nullable();
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('transactions_customer_id');
            $table->bigInteger('customer_type_id')->index('transactions_customer_type_id');
            $table->primary(["transaction_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
