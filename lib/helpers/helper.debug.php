<?php

/**
 *	File : helper.debug.php
 *	Description : helper function for debuger
 */

if(! function_exists('display')){
	function display($object){
		if(gettype($object)=="resource" && $object)
		{
			$No=mysql_num_fields($object)
			or
			die(mysql_error()."<br>");
			echo "<table class='table table-bordered' style='width:100%;text-align:center;' >";
			echo "<tr>";
			for($i=0;$i<$No;$i++)
			{
				$FieldName=mysql_field_name($object,$i)
				or
				die(mysql_error()."<br>");
				echo "<th><label>".$FieldName."</label></th>";
			}
			echo "</tr>";
			while($row=mysql_fetch_row($object))
			{
				echo "<tr>";
				for($i=0;$i<$No;$i++)
				{
					 echo "<td>".$row[$i]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			
		}else{
			echo '<pre style="max-height:256px;overflow:auto;">';
				if(is_object($object) || is_array($object)){
					print_r($object); 
				}else{
					echo $object; 
				}
			echo '</pre>';	
		}
		return true;
	}
}
if(! function_exists('DisplayTable')):
	function DisplayTable($ResultSet){
		if(gettype($ResultSet)=="resource" && $ResultSet)
		{
			$No=mysql_num_fields($ResultSet)
			or
			die(mysql_error()."<br>");
			echo "<table class='table table-bordered' >";
			echo "<tr>";
			for($i=0;$i<$No;$i++)
			{
				$FieldName=mysql_field_name($ResultSet,$i)
				or
				die(mysql_error()."<br>");
				echo "<th><label>".$FieldName."</label></th>";
			}
			echo "</tr>";
			while($row=mysql_fetch_row($ResultSet))
			{
				echo "<tr>";
				for($i=0;$i<$No;$i++)
				{
					 echo "<td>".$row[$i]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			return true;
		}
		else
		{
			return false;
		}
	}
endif;

if(!function_exists('alert')):
	function alert($object){
		//echo implode(" ",$object);
		$alert = '<script type="text/javascript">alert("'.$object.'");</script>';
		echo $alert;
	}
	
endif;
?>
