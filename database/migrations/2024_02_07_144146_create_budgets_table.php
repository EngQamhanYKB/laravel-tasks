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
            $table->string('budget_pk',45)->primary();
            $table->text('name');
            $table->double('amount');
            $table->text('colour')->nullable();
            $table->integer('start_date');
            $table->integer('end_date');
            $table->text('wallet_fks')->nullable();
            $table->text('category_fks')->nullable();
            $table->text('category_fks_exclude')->nullable();
            $table->integer('income')->default(0);
            $table->integer('archived')->default(0);
            $table->integer('added_transactions_only')->default(0);
            $table->integer('period_length');
            $table->integer('reoccurrence')->nullable();
            $table->integer('date_created');
            $table->integer('date_time_modified')->nullable()->default(1704814739);
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
        Schema::dropIfExists('budgets');
    }
};
