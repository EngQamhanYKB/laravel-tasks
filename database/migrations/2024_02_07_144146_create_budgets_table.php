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
        Schema::create('budgets', function (Blueprint $table) {
            $table->string('budget_pk',45)->index('budgets_budget_pk');
            $table->text('name');
            $table->double('amount');
            $table->text('colour')->nullable();
            $table->bigInteger('start_date');
            $table->bigInteger('end_date');
            $table->text('wallet_fks')->nullable();
            $table->text('category_fks')->nullable();
            $table->text('category_fks_exclude')->nullable();
            $table->integer('income')->default(0);
            $table->integer('archived')->default(0);
            $table->integer('added_transactions_only')->default(0);
            $table->integer('period_length');
            $table->integer('reoccurrence')->nullable();
            $table->bigInteger('date_created');
            $table->bigInteger('date_time_modified')->nullable()->default(1704814739);
            $table->integer('pinned')->default(0);
            $table->integer('order');
            $table->text('wallet_fk');
            $table->text('budget_transaction_filters')->nullable();
            $table->text('member_transaction_filters')->nullable();
            $table->text('shared_key')->nullable();
            $table->integer('shared_owner_member')->nullable();
            $table->integer('shared_date_updated')->nullable();
            $table->text('shared_members')->nullable();
            $table->text('shared_all_members_ever')->nullable();
            $table->integer('is_absolute_spending_limit')->default(0);
            $table->integer('synced')->nullable()->default(0);
            $table->string('customer_id', 45)->index('budgets_customer_id');
            $table->bigInteger('customer_type_id')->index('budgets_customer_type_id');
            $table->primary(["budget_pk","customer_id", "customer_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
};
