<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('app_title');
			$table->string('about_app');
			$table->string('android_link');
			$table->string('ios_link');
			$table->string('order_text');
			$table->text('offer_text');
			$table->text('who_are_us');
			$table->text('commission_text');
			$table->string('commission_rate');
			$table->string('bank_account_FN');
			$table->string('bank_account_SN');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}