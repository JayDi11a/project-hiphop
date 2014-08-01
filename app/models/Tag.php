<?php 

class Tag extends Eloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

	# Relationship method...
    public function songs() {
        
	    # Tags belongs to many Books
	    return $this->belongsToMany('Song');
    }
    
	# Model events...
	# http://laravel.com/docs/eloquent#model-events
	public static function boot() {
        
        parent::boot();

        static::deleting(function($tag) {
            DB::statement('DELETE FROM song_tag WHERE tag_id = ?', array($tag->id));	 
        });

	}
    
}