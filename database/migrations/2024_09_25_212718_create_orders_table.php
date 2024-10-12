<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notes')->nullable();
			$table->integer('payment_method_id')->unsigned();
			$table->decimal('total_price');
			$table->decimal('commission_amount');
			$table->tinyInteger('status');
			$table->integer('client_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}