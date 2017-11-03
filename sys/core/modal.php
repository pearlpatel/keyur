<?php
class Modal {
	// Instans of database
	protected $Database;
	public function __construct($con = false ){
		if(! $con || ( $con instanceof DatabaseAccess) ){ // check if this is object of DatabaseAccess Class 
			//	if Not than load default database
			$this->Database = new DatabaseAccess(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		}else{
			// if yes then load requested  database
			$this->Database = $con;
		}
		$this->Database->Open();
	}
	protected function set_db($con){
		self::__construct($con);
	}
	
	public function ResourceToArray($resource){
		if(gettype($resource)=="resource" && $resource){
			$array = array();
			while($row = mysql_fetch_assoc($resource)){
				$array[] = $row;
			}
			return $array;
		}else{
			return false;	
		}
	}
	
	public function custom($query){
		return $this->Database->ExecuteQuery($query);
	}
	
	public function customNone($query){
		return $this->Database->ExecuteNoneQuery($query);
	}
	
	public function __destruct(){
		//$this->Database->Close();	
	}
}