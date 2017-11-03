<?php 
	class File{
		private $_uploadPath;
		private $_extention = array();
		private $_fileType = array();
		private $_size ;
		public function __construct($path = FALSE,$exten = FALSE,$type = FALSE ,$size = FALSE){
			if($path == ''){$path = FALSE;}
			if($exten == ''){$exten = FALSE;}
			if($type == ''){$type = FALSE;}
			if($size == ''){$size = FALSE;}
			$this->_uploadPath=$path;
			$this->_extention=$exten;
			$this->_fileType=$type;
			$this->_size=$size;	
		}
		public function Reset($path = FALSE,$exten = FALSE,$type = FALSE ,$size = FALSE){
			self::__construct($path,$exten,$type,$size);
		}
		// Display File Detail Args: fileName
		public function FileDetail($objName){
			if($_FILES[$objName]['error']>0){
				echo "Error : ".$_FILES[$objName]['error']."<br>";
				return false;
			}else{
				$aryTemp =  explode('.',$_FILES[$objName]['name']);
				$fileExtension = end($aryTemp);
				echo "upload : ".$_FILES[$objName]['name']."<br>";
				echo "Type : ".$_FILES[$objName]['type']."<br>";
				echo "Size : ".$_FILES[$objName]['size']."<br>";
				echo "Extension : .".$fileExtension."<br>";
				echo "Stored in : ".$_FILES[$objName]['tmp_name']."<br>";
				return true;
			}
		}
		// ValidateFile Args: fileName return:Bool
		public function ValidateFile($objName){
			$aryTemp =  explode('.',$_FILES[$objName]['name']);
			$fileExtension = end($aryTemp);
			$fileType= $_FILES[$objName]['type'];
			if ( 
				$_FILES[$objName]['size'] < $this->_size 
				&& ((! $this->_extention) || in_array($fileExtension,$this->_extention) )
				&& ((! $this->_fileType) || in_array($fileType,$this->_fileType))
				&& (! file_exists($this->_uploadPath.$_FILES[$objName]['name']))
			){
				return true;
			}else{
				return false;	
			}
		}
		// Upload File return:file Url on success
		public function UploadFile($objName,$fileName = false){
			if($fileName){
				$aryTemp =  explode('.',$_FILES[$objName]['name']);
				if(count($aryTemp) > 1){
					$fileExtension = end($aryTemp);
					$fileName = $fileName.'.'.$fileExtension;	
				}
			}else{
				$fileName = $_FILES[$objName]['name'];
			}
			$newfilename = time().$fileName;
			move_uploaded_file($_FILES[$objName]['tmp_name'],$this->_uploadPath.$newfilename);
			$fileLoction = $this->_uploadPath.$newfilename;
			return $fileLoction;
		}
	}
?>