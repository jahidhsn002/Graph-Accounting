<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Accounting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
        });

        Schema::create('assetaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('expenseaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('loanaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assetaccount_id');
            $table->string('date');
            $table->string('type');
            $table->string('note');
            $table->double('amount', 13, 2);
        });

        Schema::create('capitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_id');
            $table->string('date');
            $table->string('type');
            $table->string('note');
            $table->double('amount', 13, 2);
        });

        Schema::create('drawings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_id');
            $table->string('date');
            $table->string('type');
            $table->string('note');
            $table->double('amount', 13, 2);
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expenseaccount_id');
            $table->string('date');
            $table->string('type');
            $table->string('note');
            $table->double('amount', 13, 2);
        });

        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loanaccount_id');
            $table->string('date');
            $table->string('type');
            $table->string('note');
            $table->double('amount', 13, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('owners');
        Schema::drop('assetaccounts');
        Schema::drop('expenseaccounts');
        Schema::drop('loanaccounts');
        Schema::drop('assets');
        Schema::drop('capitals');
        Schema::drop('drawings');
        Schema::drop('expenses');
        Schema::drop('loans');
    }
}
