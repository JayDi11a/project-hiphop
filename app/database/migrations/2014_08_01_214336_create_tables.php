<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		# Create the authors table
		Schema::create('artists', function($table) {

			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# General data...
			$table->string('name');

			# Define foreign keys...
			# none needed

		});

		# Create the books table
		Schema::create('songs', function($table) {

			# AI, PK
			$table->increments('id');


			# General data...
			$table->string('title');
			$table->integer('artist_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			$table->integer('published');
			$table->string('cover');

			# Define foreign keys...
			$table->foreign('artist_id')
				->references('id')
				->on('artists');

			# created_at, updated_at columns
			$table->timestamps();

		});


		# Create the tags table
		Schema::create('tags', function($table) {

			# AI, PK
			$table->increments('id');

			# General data....
			$table->string('name', 64);

			# created_at, updated_at columns
			$table->timestamps();

			# Define foreign keys...
			# none needed

		});

		# Create pivot table connecting `books` and `tags`
		Schema::create('song_tag', function($table) {

			# AI, PK
			# none needed

			# General data...
			$table->integer('song_id')->unsigned();
			$table->integer('tag_id')->unsigned();

			# Define foreign keys...
			$table->foreign('song_id')->references('id')->on('songs');
			$table->foreign('tag_id')->references('id')->on('tags');

		});



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('songs', function($table) {
			$table->dropForeign('songs_artist_id_foreign'); # table_fields_foreign
		});

		Schema::table('song_tag', function($table) {
			$table->dropForeign('song_tag_song_id_foreign'); # table_fields_foreign
			$table->dropForeign('song_tag_tag_id_foreign');  # table_fields_foreign
		});


		Schema::drop('artists');
		Schema::drop('songs');
		Schema::drop('tags');
		Schema::drop('song_tag');
	}
}	