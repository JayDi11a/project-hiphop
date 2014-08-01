<?php 

class Artist extends Eloquent { 

	/**
	* Relationship method
	*/
	public function songs() {

		# Author has many books
        return $this->hasMany('Song');
        
    }
    
    /**
	* Gets the authors as a id -> name key value pair. Useful for building selects.
	*/
	public static function getIdNamePair() {

		$artists    = Array();

		$collection = Artist::all();	

		foreach($collection as $artist) {
			$artist[$artist->id] = $artist->name;
		}	

		return $artists;	
	}

  	
}