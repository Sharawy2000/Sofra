<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 30);
			$table->string('description');
			$table->string('image');
			$table->decimal('price');
			$table->decimal('price_in_offer')->nullable();
			$table->string('order_duration', 30);
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}