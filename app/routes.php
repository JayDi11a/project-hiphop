<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('_master');
});


Route::get('/new', function() {

    $view  = '<form method="POST">';
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;

});

Route::post('/new', function() {

    $input =  Input::all();
    print_r($input);

});

Route::get('/practice', function() {

    $fruit = Array('Apples', 'Oranges', 'Pears');

    echo Pre::render($fruit,'Fruit');

});


Route::get('/profile/{user_id}', function($user_id) {

    $user = User::get($user_id);

    return View::make('welcome')
        ->with('user', $user);

});


Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);
});


Route::get('/practice-creating', function() {

    # Instantiate a new Book model class
    $song = new Song();

    # Set 
    $song->title = 'Dreams';
    $song->artist = 'Ramsey Lewis';
    $song->published = 1973;
    $song->cover = 'http://en.wikipedia.org/wiki/Funky_Serenity#mediaviewer/File:Funky_Serenity.jpg';
    
    # This is where the Eloquent ORM magic happens
    $song->save();

    return 'A new book has been added! Check your database to see...';

});


