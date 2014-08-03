<?php

class Library {

	# Properties...
	public $path;  # String
	public $songs; # Array	

	# Methods...

	# This __construct method gets called by default whenever an Object is instantiated from this Class
	public function __construct($path) {
		$this->set_path($path);
	}

	public function get_path() {	
		return $this->path;
	}

	public function set_path($new_path) {
		$this->path = $new_path;
	}

	public function get_songs($refresh = false) {

		# If we've already fetched the books, don't do it again
		if($this->songs && !$refresh) {
			return $this->songs;
		}

		# Load the json file
		$songs = File::get($this->path);

		# Convert the string of JSON into object
		$songs = json_decode($songs,true);

		# Set the class param
		$this->songs = $songs;

		return $songs;

	}


	/**
	* @param String $query
	* @return Array $results
	*/
	public function search($query) {

		# Get the books
		$songs = $this->get_songs();

		# If any books match our query, they'll get stored in this array
		$results = Array();

		# Loop through the books looking for matches
		foreach($songs as $title => $song) {

			# First compare the query against the title
			if(stristr($title,$query)) {

				# There's a match - add this book the the $results array
				$results[$title] = $song;
			}
			# Then compare the query against all the attributes of the book (author, tags, etc.)
			else {

				if(self::search_song_attributes($song,$query)) {
					# There's a match - add this book the the $results array
					$results[$title] = $song;
				}
			}
		}

		return $results;

	}

	/**
	* Recursively search through a song's attributes looking for a query match
	* @param Array $attributes
	* @param String $query
	* @return Boolean Whether query was found in the attribute
	*/
	private function search_song_attributes($attributes,$query) { 

	    foreach($attributes as $k => $value) { 

	      	# Dig deeper
	        if (is_array($value)) {
	        	return self::search_song_attributes($value,$query);
	        }

	   		if(stristr($value,$query)) {
	   			return true;
	   		}             
	    } 

		return false;

	 }

} # eoc