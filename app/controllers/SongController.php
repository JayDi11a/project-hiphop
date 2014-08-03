<?php

class SongController extends BaseController {


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();		

		# Only logged in users should have access to this controller
		$this->beforeFilter('auth');

	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getSearch() {

		return View::make('song_search');

	}


	/*-------------------------------------------------------------------------------------------------
	http://localhost/book/search
	Demonstrate of Ajax
	-------------------------------------------------------------------------------------------------*/
	public function postSearch() {

		if(Request::ajax()) {

			$query  = Input::get('query');

			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');

			# Do the actual query
	        $songs  = Song::search($query);

	        # If the request is for JSON, just send the books back as JSON
	        if($format == 'json') {
		        return Response::json($books);
	        }
	        # Otherwise, loop through the results building the HTML View we'll return
	        elseif($format == 'html') {


		        $results = '';	        
				foreach($songs as $song) {
					# Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
					# For each book, we'll add a new stub to the results
					$results .= View::make('song_search_result')->with('song', $song)->render();   
				}

				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getIndex() {

		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$query  = Input::get('query');

		$songs = Song::search($query);

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('song_index')
				->with('songs', $songs)
				->with('query', $query);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($songs);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}


	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getEdit($id) {

		$song = Song::with('artist')->findOrFail($id);

		$artists = Artist::getIdNamePair();

		return View::make('song_edit')
			->with('song', $song)
			->with('artists', $artists);

	}


	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function postEdit($id) {

		$song = Song::findOrFail($id);
		$song->fill(Input::all());
		$song->save();

		return Redirect::action('SongController@getIndex')->with('flash_message','Your changes have been saved.');

	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getCreate() {

		$artists = Artist::getIdNamePair();

		return View::make('song_create')->with('artists', $artists);
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function postCreate() {

		# Instantiate the book model
		$song = new Song();

		$song->fill(Input::all());
		$song->save();

		# Magic: Eloquent
		$song->save();

		return Redirect::action('SongController@getIndex')->with('flash_message','Your song has been added.');

	}

}