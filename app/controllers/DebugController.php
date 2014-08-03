<?php

class DebugController extends BaseController {


	/*-------------------------------------------------------------------------------------------------
	GET http://localhost/debug/index
	-------------------------------------------------------------------------------------------------*/
	public function getIndex() {

		echo '<pre>';

		echo '<h1>environment.php</h1>';
		$path   = base_path().'/environment.php';

		try {
			$contents = 'Contents: '.File::getRequire($path);
			$exists = 'Yes';
		}
		catch (Exception $e) {
			$exists = 'No. Defaulting to `production`';
			$contents = '';
		}

		echo "Checking for: ".$path.'<br>';
		echo 'Exists: '.$exists.'<br>';
		echo $contents;
		echo '<br>';

		echo '<h1>Environment</h1>';
		echo App::environment().'</h1>';

		echo '<h1>Debugging?</h1>';
		if(Config::get('app.debug')) echo "Yes"; else echo "No";

		echo '<h1>Database Config</h1>';
		print_r(Config::get('database.connections.mysql'));

		echo '<h1>Test Database Connection</h1>';
		try {
			$results = DB::select('SHOW DATABASES;');
			echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
			echo "<br><br>Your Databases:<br><br>";
			print_r($results);
		} 
		catch (Exception $e) {
			echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
		}

		echo '</pre>';

	}





	/*-------------------------------------------------------------------------------------------------
	GET: http://localhost/debug/trigger-error
	-------------------------------------------------------------------------------------------------*/
	public function getTriggerError() {

		$foo = new Foobar;

	}





	/*-------------------------------------------------------------------------------------------------
	GET http://localhost/debug/routes
	-------------------------------------------------------------------------------------------------*/
	public function getRoutes() {

		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $value) {
	    	echo "<a href='/".$value->getPath()."' target='_blank'>".$value->getPath()."</a><br>";
		}

	}





	/*-------------------------------------------------------------------------------------------------
	GET http://localhost/debug/books-json
	-------------------------------------------------------------------------------------------------*/
	public function getSongsJson() {

		# Instantiating an object of the Library class
		$library = new Library(app_path().'/database/books.json'); 

		# Get the books
		$songs = $library->get_songs();

		# Debug
		return Pre::render($songs, 'Songs');
	}

}