<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 100)->nullable();
			$table->string('company', 150)->nullable();
			$table->string('billing', 250)->nullable();
			$table->string('shipping', 250)->nullable();
			$table->string('phone', 50)->nullable();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 100)->nullable();
			$table->string('company', 150)->nullable();
			$table->string('address', 250)->nullable();
			$table->string('phone', 50)->nullable();
        });
		
		Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->string('iban', 100)->nullable();
			$table->integer('stock_id')->unsigned();
			$table->string('description', 250);
			$table->string('brand', 250)->nullable();
			$table->string('unit', 25)->nullable();
			$table->double('buy', 13, 2);
			$table->double('sell', 13, 2);
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chalan_id')->unsigned();
            $table->integer('return_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('invoice_id')->unsigned();
			$table->integer('service_id')->unsigned();
			$table->integer('estimate_id')->unsigned();
			$table->integer('sale_id')->unsigned();
			$table->integer('offer_id')->unsigned();
			$table->integer('perchase_id')->unsigned();
			$table->string('brand', 250)->nullable();
			$table->string('description', 250);
			$table->double('qty', 13, 2);
			$table->double('buy', 13, 2);
			$table->double('sell', 13, 2);
			$table->string('unit', 25)->nullable();
			$table->double('discount', 13, 2);
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->double('qty', 13, 2);
			$table->double('wast', 13, 2);
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
			$table->string('date', 15);
			$table->double('vat', 13, 2);
			$table->string('traking', 150)->nullable();
			$table->double('subtotal', 13, 2);
			$table->double('total', 13, 2);
			$table->double('shipping_cost', 13, 2);
			$table->string('comments', 250)->nullable();
			$table->string('note', 250)->nullable();
			$table->string('terms', 250)->nullable();
        });
		
		Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chalan_id')->unsigned();
			$table->integer('customer_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('perchase_date', 15)->nullable();
			$table->string('perchase_no', 15)->nullable();
			$table->string('date', 15)->nullable();
			$table->double('vat', 13, 2);
			$table->string('traking', 150)->nullable();
			$table->double('subtotal', 13, 2);
			$table->double('total', 13, 2);
			$table->double('shipping_cost', 13, 2);
			$table->string('comments', 250)->nullable();
			$table->string('note', 250)->nullable();
			$table->string('terms', 250)->nullable();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('date', 15);
			$table->double('vat', 13, 2);
			$table->double('subtotal', 13, 2);
			$table->double('total', 13, 2);
			$table->string('comments', 250)->nullable();
			$table->string('note', 250)->nullable();
			$table->string('terms', 250)->nullable();
        });

        Schema::create('perchases', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('supplier_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('date', 15);
			$table->double('tax', 13, 2);
			$table->string('memo', 100)->nullable();
			$table->string('traking')->nullable();
			$table->double('subtotal', 13, 2);
			$table->double('total', 13, 2);
			$table->double('shipping_cost', 13, 2);
			$table->string('comments', 250)->nullable();
			$table->string('note', 250)->nullable();
			$table->string('terms', 250)->nullable();
        });

        Schema::create('chalans', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
			$table->string('date');
			$table->string('traking', 150)->nullable();
			$table->double('shipping_cost', 13, 2);
			$table->string('comments', 250)->nullable();
			$table->string('note', 250)->nullable();
			$table->string('terms', 250)->nullable();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 100);
			$table->string('ac', 100)->nullable();
        });

        Schema::create('returns', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->integer('supplier_id')->unsigned();
			$table->string('type', 50);
			$table->string('date', 15);
			$table->double('total', 13, 2);
			$table->string('note', 250)->nullable();
        }); 

        Schema::create('transections', function (Blueprint $table) {
            $table->increments('id');
			$table->string('date', 15);
			$table->string('type', 50);
			$table->double('amount', 13, 2);
			$table->integer('customer_id')->nullable();
			$table->integer('supplier_id')->nullable();
			$table->integer('invoice_id')->nullable();
			$table->integer('service_id')->nullable();
			$table->integer('employe_id')->nullable();
			$table->integer('wage_id')->nullable();
			$table->integer('perchase_id')->nullable();
			$table->integer('sale_id')->nullable();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('account_id')->nullable();
			$table->string('date', 15);
			$table->string('type', 50);
			$table->double('amount', 13, 2);
			$table->string('summery', 250)->nullable();
        });
		
		Schema::create('conditions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('invoice_id')->nullable();
			$table->integer('perchase_id')->nullable();
			$table->integer('offer_id')->nullable();
			$table->integer('sale_id')->nullable();
			$table->integer('service_id')->nullable();
			$table->string('description');
			$table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
        Schema::drop('suppliers');
		Schema::drop('products');
		Schema::drop('transections');
		Schema::drop('invoices');
		Schema::drop('returns');
		Schema::drop('sales');
		Schema::drop('offers');
		Schema::drop('chalans');
		Schema::drop('perchases');
		Schema::drop('stocks');
		Schema::drop('accounts');
		Schema::drop('payments');
		Schema::drop('conditions');
		Schema::drop('items');
    }
}
