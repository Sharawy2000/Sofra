<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 50);
			$table->string('email', 30);
			$table->integer('neighborhood_id')->unsigned();
			$table->string('password');
			$table->decimal('minimum_order');
			$table->decimal('delivery_fees');
			$table->string('phone', 30);
			$table->string('contact_phone', 30);
			$table->string('contact_whatsapp', 30);
			$table->string('image');
			$table->tinyInteger('overall_rate')->nullable();
			$table->boolean('is_active');
			$table->string('reset_code')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}