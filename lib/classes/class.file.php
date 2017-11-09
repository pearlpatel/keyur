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
		public function resizeFile($objName,$newfilename,$fileName = false){
			if($fileName){
				$aryTemp =  explode('.',$_FILES[$objName]['name']);
				if(count($aryTemp) > 1){
					$fileExtension = end($aryTemp);
					$fileName = $fileName.'.'.$fileExtension;	
				}
			}else{
				$fileName = $_FILES[$objName]['name'];
			}
			//$newfilename = time().$fileName;
			if($_FILES[$objName]["type"] == "image/jpeg" || $_FILES[$objName]["type"] == "image/pjpeg"){	
				$image_source = imagecreatefromjpeg($_FILES[$objName]["tmp_name"]);
			}		
			if($_FILES[$objName]["type"] == "image/gif"){	
				$image_source = imagecreatefromgif($_FILES[$objName]["tmp_name"]);
			}	
			if($_FILES[$objName]["type"] == "image/bmp"){	
				$image_source = imagecreatefromwbmp($_FILES[$objName]["tmp_name"]);
			}			
			if($_FILES[$objName]["type"] == "image/x-png"){
				$image_source = imagecreatefrompng($_FILES[$objName]["tmp_name"]);
			}
			
			echo $remote_file = 'uploads/greed_preview/'.$_FILES[$objName]["name"];
			imagejpeg($image_source,$remote_file,100);
			chmod($remote_file,0644);
			
			list($image_width, $image_height) = getimagesize($_FILES[$objName]["tmp_name"]);
			$new_width=floor(($image_width*20)/100);
			$new_height=floor(($image_height/$image_width)*$new_width);
		
			$new_image = imagecreatetruecolor($new_width , $new_height);
			$image_source = imagecreatefromjpeg($remote_file);
			
			imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image,$newfilename,100);
			unlink($remote_file);
		}
		public function UploadFile($objName,$newfilename,$fileName = false){
			move_uploaded_file($_FILES[$objName]['tmp_name'],$this->_uploadPath.$newfilename);
			$fileLoction = $this->_uploadPath.$newfilename;
			
			return $fileLoction;
		}		
	}
?>