<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hrm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('empid')->nullable();
            $table->string('joining')->nullable();
            $table->string('designation')->nullable();
            $table->double('salary', 13, 2);
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('note')->nullable();
        });

        Schema::create('wages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->double('total', 13, 2);
            $table->string('note')->nullable();
        });
        
        Schema::create('dbwages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_id')->nullable();
            $table->integer('employe_id')->nullable();
            $table->string('date');
            $table->double('basic', 13, 2);
            $table->integer('absent');
            $table->integer('late');
            $table->double('charge', 13, 2);
            $table->double('tada', 13, 2);
            $table->double('bonus', 13, 2);
            $table->double('advance', 13, 2);
            $table->double('paid', 13, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employes');
        Schema::drop('wages');
        Schema::drop('dbwages');
    }
}
