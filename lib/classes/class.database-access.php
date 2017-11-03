<?php
/**
 *	Class Name : DatabaseAccess
 *	Use 		 : To Access Database
 *	Counstruct : 	@param 1 = Server Name
 *				@param 2 = User Name
 *				@param 3 = Password
 *				@param 4 = Database Name
 *
 *
 */
class DatabaseAccess
{
		private $_serverName;
		private $_userName;
		private $_databaseName;
		private $_password;
		private $_connection;
		
		//	Construct
		public function __construct($Sname,$Uname,$Pass,$DBname){
			$this->_serverName = $Sname;
			$this->_userName = $Uname;
			$this->_password = $Pass;
			$this->_databaseName = $DBname;
			$this->Open();
		}
		
		//	Connection Open
		public function Open(){
			$this->_connection = mysql_connect($this->_serverName,$this->_userName,$this->_password)
			or
			die($this->getError());
			
			mysql_select_db($this->_databaseName,$this->_connection);
		}
		
		//	Connnection Close
		public function Close(){
			mysql_close($this->_connection);
		}
		
		//	Connnection Error
		public function getError(){
			return mysql_error($this->_connection);
		}
		
		//	Re Connect Connnection
		public function Reconnect(){
			$this->Close();
			$this->Open();
		}
		
		//	Execute None Query 
		public function ExecuteNoneQuery($query){
			mysql_query($query,$this->_connection)
			or
			die($this->getError());;
			
			$affectedRow = mysql_affected_rows();

			return $affectedRow;
		}
		
		//	Execute Query
		public function ExecuteQuery($query){
			$resultSet = mysql_query($query,$this->_connection)
			or
			die($this->getError());
			
			
			return $resultSet;
		}
		
		//	Get First Value From Query or  Result Set
		public function getFirstValue($resource){
			if(!(gettype($resource)=="resource" && $resource)){
				$ResultSet = $this->ExecuteQuery($resource);
			}else{
				$ResultSet = $resource;	
			}
			if(gettype($ResultSet)=="resource" && $ResultSet){
				$row=mysql_fetch_array($ResultSet);
				return $row[0];	
			}
			return false;
		}
		
		//	Name : getRow 
		//	Use : Get The No. of row form Query or Result Set
		//	@param 1 : Resource [ query_string || result_set ]
		//	@param 2 : No [ No. of Row ] 
		public function getRow($resource ,$No = 0){
			if(!(gettype($resource)=="resource" && $resource)){
				
				$ResultSet = $this->ExecuteQuery($resource);
				
			}else{
				$ResultSet = $resource;	
			}
			
			if(gettype($ResultSet)=="resource" && $ResultSet){
				
				for ($i=0; $i <= $No; $i++){
					$row = mysql_fetch_assoc($ResultSet);
					if($i == $No){ return $row; }
				}
			}
			
			return false;
		}
		
		public function beginTransaction(){
			return $this->ExecuteNoneQuery('START TRANSACTION');
		}
		//	get last Affected Row
		public function getLastAffectedRow(){
			return mysql_affected_rows();	
		}
		
		// Set Auto Commit
		public function setAutoComit($flag =true){
			if($flag){
				return $this->ExecuteNoneQuery('SET AUTOCOMMIT=1');	
			}else{
				return $this->ExecuteNoneQuery('SET AUTOCOMMIT=0');
			}
		}
		
		//COMMIT
		public function Commit(){
			return $this->ExecuteNoneQuery('COMMIT');	
		}
		
		//ROLLBACK
		public function Rollback(){
			return $this->ExecuteNoneQuery('ROLLBACK');	
		}
} 