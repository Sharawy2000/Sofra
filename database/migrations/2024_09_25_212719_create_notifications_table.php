<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('notifiable_id');
			$table->string('notifiable_type');
			$table->boolean('is_seen');
			$table->string('title');
			$table->string('body');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}