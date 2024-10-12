<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->unsigned();
			$table->integer('payment_method_id')->unsigned();
			$table->string('tranaction_id');
			$table->decimal('amount');
			$table->tinyInteger('status');
			$table->timestamp('transaction_date');
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}