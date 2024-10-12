<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->unsigned();
			$table->double('amount_paid');
			$table->date('payment_date');
			$table->text('notes');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}