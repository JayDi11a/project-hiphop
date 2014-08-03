<?php

class DemoController extends BaseController {


	public function csrf() {

		return View::make('demo_csrf');

	}

	public function jsVars() {

		# Bind a variable called 'foo'
		JavaScript::put(['foo' => 'bar']);

		# Bind a variable called 'bar'
		JavaScript::put(['email' => Auth::user()->email]);

		return View::make('demo_jsVars');

	}

	public function crudCreate() {

		# Instantiate the book model
		$song = new Song();

		$song->title = 'Dreams';
		$song->artist = 'Ramsey Lewis';
		$song->published = 1973;
		$song->cover = 'http://en.wikipedia.org/wiki/Funky_Serenity#mediaviewer/File:Funky_Serenity.jpg';
		
		# Magic: Eloquent
		$song->save();

		return "Added a new row";

	}


	public function crudRead() {

		# Magic: Eloquent
		$songs = Song::all();

		# Debugging
		foreach($songs as $song) {
			echo $song->title."<br>";
		}

	}


	public function crudUpdate() {

		# Get a book to update
		$song = Song::first();

		# Update the author
		$song->artist = 'Foobar';

		# Save the changes
		$song->save();

		echo "This book has been updated";

	}


	public function crudDelete() {

		# Get a book to delete
		$song = Song::first();

		# Delete the book
		$song->delete();

		echo "This book has been deleted";
	}


	public function collections() {

		$collection = Song::all();

		//echo Pre::render($collection);

		# The many faces of a Eloquent Collection object...

		# Treat it like a string:
		echo $collection;   

		# Treat it like an array:
		//foreach($collection as $book) {
		//	echo $book['title']."<br>";
		//}   

		# Treat it like an object:
		//foreach($collection as $book) {
		// echo $book->title."<br>";
		//}

	}

	public function queryWithoutConstraints() {

		$songs = Song::find(1);

		//$books = Book::first();	

		//$books = Book::all();

		Song::pretty_debug($songs);
	}


	public function queryWithConstraints() {

		$songs = Song::where('published','>',1960)->first();

		//$books = Book::where('published','>',1960)->get();

		//$books = Book::where('published','>',1960)->orWhere('title', 'LIKE', '%gatsby')->get();

		//$books = Book::whereRaw('title LIKE "%gatsby" OR title LIKE "%bell%"')->get();

		Song::pretty_debug($songs);

	}

	public function queryResponsibility() {

		# Scenario: You have a view that needs to display a table of all the books, so you run this query:
		$songs = Song::orderBy('title')->get();	

		# Then, you need to display the first book that was added to the table
		# There are two ways you can do this...

		# Query the database again
		$first_song = Song::orderBy('title')->first();	

		# Or query the existing collection 
		//$first_book = $books->first();

		echo $first_song->title;

	}

	public function queryWithOrder() {

		$songs = Song::where('published', '>', 1950)->
		orderBy('title','desc')
		->get();

		Song::pretty_debug($songs);
	}


	public function queryRelationshipsAuthor() {

		# Get the first book as an example
		$song = Song::orderBy('title')->first();

		# Get the author from this book using the "author" dynamic property
		# "author" corresponds to the the relationship method defined in the Book model
		$artist = $song->artist; 

		# Print book info
		echo $song->title." was written by ".$artist->name."<br>";

		# FYI: You could also access the author name like this:
		//$book->author->name;


	}

	public function queryRelationsipsTags() {

		# Get the first book as an example
		$song = Song::orderBy('title')->first();

		# Get the tags from this book using the "tags" dynamic property
		# "tags" corresponds to the the relationship method defined in the Book model
		$tags = $song->tags; 

		# Print results
		echo "The tags for <strong>".$song->title."</strong> are: <br>";
		foreach($tags as $tag) {
		echo $tag->name."<br>";
		}

	}

	public function queryEagerLoadingArtists() {

		# Without eager loading (4 queries)
		$songs = Song::orderBy('title')->get();

		# With eager loading (2 queries)
		//$books = Book::with('author')->orderBy('title')->get();

		foreach($songs as $song) {
			echo $song->artist->name.' composed '.$song->title.'<br>';
		}		
	}

	public function queryEagerLoadingTagsAndArtists() {


		# Without eager loading (7 Queries)
		$songs = Song::orderBy('title')->get();

		# With eager loading (3 Queries)
		//$books = Book::with('author','tags')->orderBy('title')->get();

		# Print results
		foreach($songs as $song) {
			echo $song->title.' by '.$song->artist->name.'<br>';
		foreach($song->tags as $tag) echo $tag->name.", ";
			echo "<br><br>";
		}

	}
}