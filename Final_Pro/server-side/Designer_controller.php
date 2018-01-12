<?php
ini_set('display_errors',1);
date_default_timezone_set('America/New_York');

require_once('orm/Designer.php');

if (isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
}else{
	$path_components=null;
}


//$resource_type = $path_components[1]; // e.g. "designer"

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (count($path_components) == 0) {
		$name = $_GET['search'];
		$designer = Designer::getDesignerByName($name);
		if ($designer == null) {
				// designer not found
				header("Content-type: application/json");
				print(json_encode(array("found"=>false)));
				exit();
			}
			header("Content-type: application/json");
			print($designer->getJSON());
			exit();
	} else {
		$resource_type = $path_components[1]; // e.g. "designer"
		if ($resource_type == "designer") {

			if ((count($path_components) == 2)) {      // get all designer ids
				header("Content-type: application/json");
				print(json_encode(Designer::getIDs()));
				exit();
			} else {    // get a designer's json
				$designer_id = intval($path_components[2]);
				$designer = Designer::getDesignerByID($designer_id);
				if ($designer == null) {
					// designer not found
					header("HTTP/1.0 404 Not Found");
					exit();
				}
				header("Content-type: application/json");
				print($designer->getJSON());
				exit();
			}
		}
	}
	
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
	/* Post tickets 
	 
	if ($resource_type == "games") {
		if (count($path_components) == 3) {
			$game_id = intval($path_components[2]);
			$game = Game::getGameByID($game_id);
			if ($game == null) {
				// game not found
				header("HTTP/1.0 404 Not Found");
				exit();
			}

		}
	}
	*/
}



?>