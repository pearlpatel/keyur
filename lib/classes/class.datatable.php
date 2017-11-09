<?php

class Datatable{
	private function _attributes_to_string($attributes){
		$html = '';
		$abortList = array('name','id','value','type','class');
		if(is_object($attributes) && count($attributes)>0):
			$attributes = (array)$attributes;
		endif;
		if(is_array($attributes) && count($attributes)):
			foreach($attributes as $key=>$value):
				if(!in_array($key,$abortList)){
					$html .= ' '.$key.'="'.$value.'"';
				}
			endforeach;
		endif;
		return $html;
	}
	public function getDatatable($ResultSet,$id='',$class='',$attributes = array(),$actionAttributes = false,$checkBox=false){
		if(count($actionAttributes)==0):
			$actionAttributes = false;
		endif;
		if(is_array($checkBox) && count($checkBox)==0):
			$checkBox = false;
		endif;
		if(gettype($ResultSet)=="resource" && $ResultSet):
			$html = '';
			$No=mysql_num_fields($ResultSet)
			or
			die(mysql_error()."<br>");
			$html = "<div class='table-responsive'><table id='".$id."' class='table ".$class."' ";
			$html .= $this->_attributes_to_string($attributes);
			$html .= " >";
			$html .= "<thead><tr>";
			$html .= $checkBox?'<th class="datatable checkbox-label">&nbsp;</th>':'';
			$chk=0;
			$appStatus=0;
			for($i=0;$i<$No;$i++):
				$FieldName=mysql_field_name($ResultSet,$i)
				or
				die(mysql_error()."<br>");
				if($FieldName=='ProfilePic' || $FieldName=='Icon' || $FieldName=='Preview' ){
					$chk=$i;
				}
				if($FieldName=='AcName'){
					$FieldName="Account Name";
				}
				if($FieldName=='AppStatus' || $FieldName=='ThemeStatus'){
					$appStatus=$i;
				}else{
					$html .= "<th><label>".$FieldName."</label></th>";
				}
			endfor;
			$html .= gettype($actionAttributes)=="array"?"<th><label>Actions</label></th>":"";
			$html .= "</tr></thead><tbody>";
			$row = FALSE;
			while($row=mysql_fetch_row($ResultSet)):
				$html .= "<tr id='".$row[0]."'>";
				if($checkBox):
					$checkBox['onclick_function'] = isset($checkBox['onclick_function'])?$checkBox['onclick_function']:NULL;
					$checkBox['id'] = isset($checkBox['id'])?$checkBox['id']:NULL;
				endif;
				$html .= $checkBox?'<td><input type="checkbox" data-triger="actioncheckbox" id="'.$checkBox['id'].'['.$row[$checkBox['value_field']].']" name="'.$checkBox['id'].'['.$row[$checkBox['value_field']].']" onclick="'.$checkBox['onclick_function'].'(this);" data-id="'.$row[$checkBox['value_field']].'" value="'.$row[$checkBox['value_field']].'"></td>':'';
				for($i=0;$i<$No;$i++):
					if($i==0){
					 	$html .= "<td id='id_".$row[0]."'>".$row[$i]."</td>";
					}
					elseif($chk==$i){
						$html .= "<td><img src='".BASE_URL.$row[$i]."' height='20px' /></td>";
					}
					elseif($appStatus==$i){
						$html .= "";
					}
					else{
						$html .= "<td>".$row[$i]."</td>";
					}
				endfor;
				if(gettype($actionAttributes)=='array'):
					$html .= '<td class="action">';
					foreach($actionAttributes as $action):
						$id = isset($row[$action['value_field']])?$row[$action['value_field']]:false;
						$name = isset($row[$action['name_field']])?$row[$action['name_field']]:false;
						$ancher_attr = '';
						if(isset($action['ancher_attr']) && is_array($action['ancher_attr'])):
							$ancher_attr = $this->_attributes_to_string($action['ancher_attr']);
						endif;
						if($action['base_url']=='javascript:'):
							$url = $url = $action['base_url'];
						else:
							$url = $action['base_url'].$id;
						endif;
						$html .= '<a data-id="'.$id.'" name="'.$name.'" href="'.$url.'" '.$ancher_attr.'>'.$action['ancher_content'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
					endforeach;
					$html .= '</td>';
				endif;
				$html .= "</tr>";
			endwhile;
			$html .= "</tbody></table></div>";
			return $html;
		else:
			return false;
		endif;
	}
	
	public function render(){
	}
}