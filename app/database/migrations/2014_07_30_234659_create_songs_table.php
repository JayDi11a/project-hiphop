<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('songs', function($table) {

        	// Increments method will make a Primary, Auto-Incrementing field.
        	// Most tables start off this way
        	$table->increments('id');

        	// The rest of the fields...
        	$table->string('title');
        	$table->string('artist');
        	$table->integer('published');
        	$table->string('cover');
        	$table->string('purchase_link');

        	// This generates two columns: `created_at` and `updated_at` to
        	// keep track of changes to a row
        	$table->timestamps();

    	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('songs');
	}

}
