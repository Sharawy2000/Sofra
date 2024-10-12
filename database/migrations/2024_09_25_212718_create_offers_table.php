<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 30);
			$table->string('description');
			$table->string('image');
			$table->date('date_begin');
			$table->date('date_end');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('discount')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}