<?php
date_default_timezone_set('America/New_York');

class Designer
{
	private $About;
	private $D_id;
	private $Birthday;
	private $Birthplace;
	private $Name;
	private $profile_path;
	private $Website;
	private $preview;

	public static function connect() {
		return new mysqli("classroom.cs.unc.edu",
											"jessiee",
											"Jessie$20151104",
											"jessieedb"
											);
	}

	public static function getIDs() {
		$mysqli = Designer::connect();

		$res = $mysqli->query("select D_id from Designers");
		

		$id_array = array();

		if ($res) {
			while ($next_row = $res->fetch_array()) {
				$id_array[] = intval($next_row['D_id']);
			}
		}
		
		return $id_array;
	}

	public static function getDesignerByName($name) {
		$mysqli = Designer::connect();

    	$result = $mysqli->query('select * from Designers where Name like "%'.$name.'%"');
    	if ($result) {
    	if ($result->num_rows == 0) {
    		return null;
    	}

		$designer_info = $result->fetch_array();
    	
    	$About = $designer_info['About'];
    	$D_id = $designer_info['D_id'];
    	$Birthday = $designer_info['Birthday'];
    	$Birthplace = $designer_info['Birthplace'];
    	$Name = $designer_info['Name'];
    	$profile_path = $designer_info['profile_path'];
    	$Website = $designer_info['Website'];
    	$preview= $designer_info['preview'];

    	return new Designer($About,$D_id,$Birthday,$Birthplace,$Name,$profile_path,$Website,$preview);
    	}
	}

	public static function getDesignerByID($id) {
		$mysqli = Designer::connect();

    	$result = $mysqli->query("select * from Designers where D_id = " . $id);
    if ($result) {
    	if ($result->num_rows == 0) {
    		return null;
    		
    	}

    	$designer_info = $result->fetch_array();
    	
    	$About = $designer_info['About'];
    	$D_id = $designer_info['D_id'];
    	$Birthday = $designer_info['Birthday'];
    	$Birthplace = $designer_info['Birthplace'];
    	$Name = $designer_info['Name'];
    	$profile_path = $designer_info['profile_path'];
    	$Website = $designer_info['Website'];
    	$preview= $designer_info['preview'];
 
    	return new Designer($About,$D_id,$Birthday,$Birthplace,$Name,$profile_path,$Website,$preview);
    	}
	}
	
	public function getJSON() {
		$json = array(
			  "found"=>true,
				"About"=>$this->About,
				"D_id"=>$this->D_id,
				"Birthday"=>$this->Birthday,
				"Birthplace"=>$this->Birthplace, 
				"Name"=>$this->Name,
		    	"profile_path"=>$this->profile_path,
		    	"Website"=>$this->Website,
		    	"preview"=>$this->preview
			);
		 return json_encode($json);
	}

	private function __construct
	($About,$D_id,$Birthday,$Birthplace,$Name,$profile_path,$Website,$preview) 
	{
		$this->About = $About;
		$this->D_id = $D_id;
		$this->Birthday = $Birthday;
		$this->Birthplace = $Birthplace;
		$this->Name = $Name;
    	$this->profile_path = $profile_path;
    	$this->Website = $Website;
    	$this->preview=$preview;
	}

}
?>