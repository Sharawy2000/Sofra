<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('payment_id')->unsigned();
			$table->integer('quantity')->unsigned();
			$table->string('product_name');
			$table->string('currency');
			$table->string('payer_name');
			$table->string('payer_email');
			$table->string('payment_status');
			$table->string('payment_method');
			$table->decimal('amount');
			// $table->tinyInteger('status');
			// $table->timestamp('transaction_date');
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}