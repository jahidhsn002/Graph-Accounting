<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Service extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('date');
            $table->string('jobno');
            $table->string('estimate');
            $table->string('status');
            $table->double('vat', 13, 2);
            $table->string('reg')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('engine')->nullable();
            $table->string('milage')->nullable();
            $table->double('subtotal', 13, 2);
            $table->double('total', 13, 2);
            $table->string('comments')->nullable();
            $table->string('note')->nullable();
            $table->string('terms')->nullable();
        });

        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('date');
            $table->string('estimate');
            $table->string('jobno');
            $table->string('status');
            $table->double('vat', 13, 2);
            $table->string('reg')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('engine')->nullable();
            $table->string('milage')->nullable();
            $table->double('subtotal', 13, 2);
            $table->double('total', 13, 2);
            $table->string('comments')->nullable();
            $table->string('note')->nullable();
            $table->string('terms')->nullable();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable();
            $table->string('description');
            $table->double('value', 13, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
        Schema::drop('estimates');
        Schema::drop('jobs');
    }
}
