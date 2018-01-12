<?php
date_default_timezone_set('America/New_York');

class Brand
{
	private $About;
	private $D_id;
	private $B_id;
	private $logo_path;
	private $Name;
	private $Origin;
	private $Picture;
	private $Website;
	private $Year;


	public static function connect() {
		return new mysqli("classroom.cs.unc.edu",
											"jessiee",
											"Jessie$20151104",
											"jessieedb"
											);
	}

	public static function getIDs() {
		$mysqli = Brand::connect();

		$res = $mysqli->query("select B_id from Brands");
		

		$id_array = array();

		if ($res) {
			while ($next_row = $res->fetch_array()) {
				$id_array[] = intval($next_row['B_id']);
			}
		}
		
		return $id_array;
	}

	public static function getBrandByName($name) {
		$mysqli = Brand::connect();

    	$result = $mysqli->query('select * from Brands where Name like "%'.$name.'%"');
    	if ($result) {
    	if ($result->num_rows == 0) {
    		return null;
    	}

    	$brand_info = $result->fetch_array();
    	//
    	$About = $brand_info['About'];
    	$B_id = $brand_info['B_id'];
    	$D_id = $brand_info['D_id'];
    	$logo_path = $brand_info['logo_path'];
    	$Name = $brand_info['Name'];
    	$Origin = $brand_info['Origin'];
    	$Picture = $brand_info['Picture'];
    	$Website = $brand_info['Website'];
    	$Year = $brand_info['Year'];

    	return new Brand($About,$B_id,$D_id,$logo_path,$Name,$Origin,$Picture,$Website,$Year);
    	}
	}

	public static function getBrandByID($id) {
		$mysqli = Brand::connect();

    	$result = $mysqli->query("select * from Brands where B_id = ".$id);
    if ($result) {
    	if ($result->num_rows == 0) {
    		return null;
    	}

    	$brand_info = $result->fetch_array();
    	//
    	$About = $brand_info['About'];
    	$B_id = $brand_info['B_id'];
    	$D_id = $brand_info['D_id'];
    	$logo_path = $brand_info['logo_path'];
    	$Name = $brand_info['Name'];
    	$Origin = $brand_info['Origin'];
    	$Picture = $brand_info['Picture'];
    	$Website = $brand_info['Website'];
    	$Year = $brand_info['Year'];

    	return new Brand($About,$B_id,$D_id,$logo_path,$Name,$Origin,$Picture,$Website,$Year);
    	}
	}
	
	public function getJSON() {
		$json = array(
			  "found"=>true,
				"About"=>$this->About,
				"B_id"=>$this->B_id,
				"D_id"=>$this->D_id,
				"logo_path"=>$this->logo_path,
				"Name"=>$this->Name,
		    	"Origin"=>$this->Origin,
		    	"Picture"=>$this->Picture,
		    	"Website"=>$this->Website,
		    	"Year"=>$this->Year
			);
		 return json_encode($json);
	}

	private function __construct
	($About,$B_id,$D_id,$logo_path,$Name,$Origin,$Picture,$Website,$Year) 
	{
		$this->About= $About;
		$this->B_id= $B_id;
		$this->D_id= $D_id;
		$this->logo_path= $logo_path;
		$this->Name= $Name;
    	$this->Origin= $Origin;
    	$this->Picture= $Picture;
    	$this->Website= $Website;
    	$this->Year= $Year;	

	}

}
?>