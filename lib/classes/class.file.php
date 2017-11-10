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
		public function resizeFile($objName,$fileName = false){
			switch(strtolower($_FILES[$objName]['type']))
			{
				case 'image/jpeg':
					$image = imagecreatefromjpeg($_FILES[$objName]['tmp_name']);
					break;
				case 'image/png':
					$image = imagecreatefrompng($_FILES[$objName]['tmp_name']);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($_FILES[$objName]['tmp_name']);
					break;
				default:
					exit('Unsupported type: '.$_FILES[$objName]['type']);
			}
			// Target dimensions
			list($image_width, $image_height) = getimagesize($_FILES[$objName]["tmp_name"]);
			$new_width=floor(($image_width*20)/100);
			$new_height=floor(($image_height/$image_width)*$new_width);
			// Get current dimensions
			$old_width  = imagesx($image);
			$old_height = imagesy($image);
			
			// Create new empty image
			$new = imagecreatetruecolor($new_width, $new_height);
			
			// Resize old image into new
			imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
			$new_name=time().$_FILES[$objName]['name'];
			// Catch the imagedata
			ob_start();
			imagejpeg($new, 'uploads/greed_preview/'.$new_name, 90);
			// Destroy resources
			imagedestroy($image);
			imagedestroy($new);
			return $new_name;
		}
		public function UploadFile($objName,$newfilename,$fileName = false){
			move_uploaded_file($_FILES[$objName]['tmp_name'],$this->_uploadPath.$newfilename);
			$fileLoction = $this->_uploadPath.$newfilename;
			
			return $fileLoction;
		}		
	}
?>