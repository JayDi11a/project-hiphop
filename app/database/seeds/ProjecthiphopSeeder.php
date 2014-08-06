<?php

class ProjecthiphopSeeder extends Seeder {


	public function run() {

		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE songs');
		DB::statement('TRUNCATE artists');
		DB::statement('TRUNCATE tags');
		DB::statement('TRUNCATE song_tag');
		DB::statement('TRUNCATE users');

		# Artists
		$lewis = new Artist;
		$lewis->name = 'Ramsey Lewis';
		$lewis->save();

		$brethren = new Artist;
		$brethren->name = 'Brethren';
		$brethren->save();

		$foster = new Artist;
		$foster->name = 'Ronnie Foster';
		$foster->save();


		$blackmilk = new Artist;
		$blackmilk->name = 'Black Milk';
		$blackmilk->save();

		$dasracist = new Artist;
		$dasracist->name = 'Das Racist';
		$dasracist->save();

		$joe = new Artist;
		$joe->name = 'Joe';
		$joe->save();

		$lucypearl = new Artist;
		$lucypearl->name = 'Lucy Pearl';
		$lucypearl->save();

		$erick = new Artist;
		$erick->name = 'Erick Sermon';
		$erick->save();



		# Tags (Created using the Model Create shortcut method)
		# Note: Tags model must have `protected $fillable = array('name');` in order for this to work
		$soul         = Tag::create(array('name' => 'soul'));
		$funk         = Tag::create(array('name' => 'funk'));
		$disco        = Tag::create(array('name' => 'disco'));
		$jazz         = Tag::create(array('name' => 'jazz'));
		$blues        = Tag::create(array('name' => 'blues'));
		$hiphop       = Tag::create(array('name' => 'hip hop'));
		$alternative  = Tag::create(array('name' => 'alternative hip hop'));
		$randb        = Tag::create(array('name' => 'r & b'));
		$neosoul      = Tag::create(array('name' => 'neo soul'));
		$funk         = Tag::create(array('name' => 'funk'));
		$original     = Tag::create(array('name' => 'original'));
		$inspired     = Tag::create(array('name' => 'inspired'));
		

		# Songs		
		$dreams = new Song;
		$dreams->title = 'Dreams';
		$dreams->published = 1973;
		$dreams->cover = 'http://upload.wikimedia.org/wikipedia/en/7/72/Funky_Serenity.jpg';
		
		# Associate has to be called *before* the book is created (save()) 
		$dreams->artist()->associate($lewis); # Equivalent of $gatsby->author_id = $fitzgerald->id
		$dreams->save();

		# Attach has to be called *after* the book is created (save()), 
		# since resulting `book_id` is needed in the book_tag pivot table
		$dreams->tags()->attach($soul); 
		$dreams->tags()->attach($funk); 
		$dreams->tags()->attach($disco); 
		$dreams->tags()->attach($original); 

		$outsidelove = new Song;
		$outsidelove->title = 'Outside Love';
		$outsidelove->published = 1970;
		$outsidelove->cover = 'http://www.geocities.jp/hideki_wtnb/brethren1st-4.jpg';
		$outsidelove->artist()->associate($brethren);
		$outsidelove->save();

		$outsidelove->tags()->attach($soul); 	
		$outsidelove->tags()->attach($funk); 
		$outsidelove->tags()->attach($disco); 
		$outsidelove->tags()->attach($original); 

		$mysticbrew = new Song;
		$mysticbrew->title = 'Mystic Brew';
		$mysticbrew->published = 1972;
		$mysticbrew->cover = 'http://userserve-ak.last.fm/serve/_/88446831/The+Two+Headed+Freap++Cover.jpg';
		$mysticbrew->artist()->associate($foster);
		$mysticbrew->save();
		$mysticbrew->tags()->attach($soul); 
		$mysticbrew->tags()->attach($funk); 
		$mysticbrew->tags()->attach($disco); 
		$mysticbrew->tags()->attach($original);


		$warning = new Song;
		$warning->title = 'Warning (Keep Bouncing)';
		$warning->published = 2010;
		$warning->cover = 'http://upload.wikimedia.org/wikipedia/en/8/80/BlackMilkAlbumoftheYear.jpg';
		$warning->artist()->associate($blackmilk);
		$warning->save();
		$warning->tags()->attach($hiphop); 
		$warning->tags()->attach($inspired); 
		
		$shortysaid = new Song;
		$shortysaid->title = 'Shorty Said';
		$shortysaid->published = 2010;
		$shortysaid->cover = 'http://upload.wikimedia.org/wikipedia/en/8/81/Das-racist-shut-up-dude-front-nahright-450x450.jpg';
		$shortysaid->artist()->associate($dasracist);
		$shortysaid->save();
		$shortysaid->tags()->attach($alternative); 
		$shortysaid->tags()->attach($inspired); 
		

		$justrelax = new Song;
		$justrelax->title = 'Just Relax';
		$justrelax->published = 2007;
		$justrelax->cover = 'http://img1.wikia.nocookie.net/__cb20120327203448/lyricwiki/images/0/04/Joe_-_Ain%27t_Nothin%27_Like_Me.jpg';
		$justrelax->artist()->associate($joe);
		$justrelax->save();
		$justrelax->tags()->attach($randb); 
		$justrelax->tags()->attach($inspired); 
		

		$pearlsway = new Song;
		$pearlsway->title = 'Lucy Pearls Way';
		$pearlsway->published = 2000;
		$pearlsway->cover = 'http://upload.wikimedia.org/wikipedia/en/a/af/Lucy_Pearl_album.jpg';
		$pearlsway->artist()->associate($lucypearl);
		$pearlsway->save();
		$pearlsway->tags()->attach($randb);
		$pearlsway->tags()->attach($neosoul);
		$pearlsway->tags()->attach($hiphop);
		$pearlsway->tags()->attach($funk);
		$pearlsway->tags()->attach($inspired); 
		
		$geniusedub = new Song;
		$geniusedub->title = 'Genius E Dub';
		$geniusedub->published = 2001;
		$geniusedub->cover = 'http://upload.wikimedia.org/wikipedia/en/3/3f/Erick_Sermon_-_Music.jpg';
		$geniusedub->artist()->associate($erick);
		$geniusedub->save();
		$geniusedub->tags()->attach($hiphop); 
		$geniusedub->tags()->attach($inspired); 
		

		$user = new User;
		$user->email = 'gerald@gerald.com';
		$user->password = Hash::make('gerald');
		$user->save();


	}

}