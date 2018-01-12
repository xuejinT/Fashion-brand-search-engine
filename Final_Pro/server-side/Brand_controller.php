<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/New_York');

require_once('orm/Brand.php');

if (isset($_SERVER['PATH_INFO'])) {
	$path_components = explode('/', $_SERVER['PATH_INFO']);
}else{
	$path_components=null;
}





if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (count($path_components) == 0) {
		$name = $_GET['search'];
		$brand = Brand::getBrandByName($name);
		if ($brand == null) {
				// brand not found
				header("Content-type: application/json");
				print(json_encode(array("found"=>false)));
				exit();
			}
			header("Content-type: application/json");
			print($brand->getJSON());
			exit();
	} else {
		$resource_type = $path_components[1]; // e.g. "brand"
		if ($resource_type == "brand") {

		if ((count($path_components) == 2)) {      // get all brand ids
			header("Content-type: application/json");
			print(json_encode(Brand::getIDs()));
			exit();
		} else {    // get a brand's json
			$brand_id = intval($path_components[2]);
			$brand = Brand::getBrandByID($brand_id);
			if ($brand == null) {
				// brand not found
				header("HTTP/1.0 404 Not Found");
				exit();
			}
			header("Content-type: application/json");
			print($brand->getJSON());
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