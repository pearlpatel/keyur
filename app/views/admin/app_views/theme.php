<section class="content-header"> 
    <h1> Themes  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active"><a href="<?php echo ADMIN_URL.'theme/'; ?>">Theme List</a></li>
    </ol>
</section>
<?php 
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
$updateId = isset($GET[2]) && is_numeric($GET[2]) ? $GET[2]:'';
if($updateId) {
	$formStatus="in";
	$slidder=$theme_detail['Theme']['Slidder'];
	$top=$theme_detail['Theme']['Top'];?>
	<style>.form-control{width:70%}
	.form-group {
		margin-bottom: 15px;
		width: 31% !important;
		float: left !important;
	}
	.form-group .icheckbox_minimal{margin-left:10px;}</style> 
<?php
}else{
	$formStatus="";
	$slidder=0;
	$updateId=0;
	$top=0; ?>
	<style>.form-control{width:70%}
	.form-group {
		margin-bottom: 15px;
		width: 33% !important;
		float: left !important;
	}
	.form-group .icheckbox_minimal{margin-left:10px;}</style> 	
	<?php
}
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom ">
				<div class="box box-solid">                                  
					 <div class="box-body">
						<div class="box-group" id="accordion">
						    <div class="box-primary">
							   	<div class="box-header" style="border-bottom:1px solid #ccc;">
									<h3 class="box-title">Theme List</h3>
								   	<h3 class="box-title pull-right">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary" style="color:#fff">Add New </a>
								  	</h3>
							   	</div>
							  	<div id="collapseTwo" class="panel-collapse collapse" style="border-bottom:1px solid #ccc;">
									<?php
									   echo $this->Form->Open($this->Url->getBaseUrl().($updateId?'theme/update/'.$updateId:'theme/add/'),'frmTheme',array('novalidate'=>'novalidate','enctype'=>'multipart/form-data'));
									   echo $this->Form->DropDown('drpCatId',$updateId!=0?$theme_detail['Theme']['CId']:'','','Category',array(),array(),$category);
									   echo $this->Form->Input('','txtNoOfPhoto',$updateId!=0?$theme_detail['Theme']['NoOfPhoto']:'','adminForm','No. Of Photos',array('autocomplete'=>'off'),array(),array());
									   if($updateId!=0){
									   		echo '<label class="control-label" for="fileImage">Preview</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Theme']['Preview'].'" height="45px" /></div>';
											echo '<input name="imagepreview" type="hidden" value="'.$theme_detail['Theme']['Preview'].'" />';
											echo $this->Form->Input('file','imagePreview','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
									  }else{
									   	echo $this->Form->Input('file','imagePreview','','fileformcontrol','Preview',array('style'=>'padding:0 !important;'),array(),array());
									  }
									  echo $this->Form->Input('','txtThemeName',$updateId!=0?$theme_detail['Theme']['Name']:'','adminForm','Theme Name',array('placeholder'=>'Theme Name','autocomplete'=>'off'),array(),array());
									  echo $this->Form->Input('','txtNoOfVideo',$updateId!=0?$theme_detail['Theme']['NoOfVideo']:'','adminForm','No. Of Videos',array('autocomplete'=>'off'),array(),array());
									  if($updateId!=0){
									   		echo '<label class="control-label" for="fileImage">Images</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Theme']['Images'].'" height="45px" /></div>';
											echo '<input name="imagepreview2" type="hidden" value="'.$theme_detail['Theme']['Images'].'" />';
											echo $this->Form->Input('file','imagePreview2[]','','fileformcontrol','',array('multiple'=>'multiple','style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
									 }else{
									   	echo $this->Form->Input('file','imagePreview2[]','','fileformcontrol','Images',array('multiple'=>'multiple','style'=>'padding:0 !important;'),array(),array());
									 }
									 echo $this->Form->Textarea('txtDesc',$updateId!=0?$theme_detail['Theme']['Description']:'','','Short Description',array('placeholder'=>'','autocomplete'=>'off'),array(),array());
									echo $this->Form->Input('','txtNoOfText',$updateId!=0?$theme_detail['Theme']['NoOfText']:'','adminForm','No. Of Textes',array('autocomplete'=>'off','onfocusout'=>'addRow(labelTable)'),array(),array());  
									if($updateId!=0){
									   		echo '<label class="control-label" for="videofile">Video</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Theme']['Video'].'" height="45px" /></div>';
											echo '<input name="video" type="hidden" value="'.$theme_detail['Theme']['Video'].'" />';
											echo $this->Form->Input('file','Video','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());																			
									   }else{
										echo $this->Form->Input('file','Video','','fileformcontrol','Video',array('required'=>'','style'=>'padding:0 !important;'),array(),array());																			
									   }
									   echo $this->Form->Input('checkbox','slidder1','','adminForm','Slidder',array('style'=>'padding-left:10px;'),array(),array());
									   echo $this->Form->Input('checkbox','top1','','adminForm','Top',array('style'=>'padding-left:10px;'),array(),array());	
									   echo '<input type="hidden" name="slidder" id="slidder" value="'.$slidder.'" />';
									   echo '<input type="hidden" name="top" id="top" value="'.$top.'" />';
										?>
									   <div class="form-group" id="labelTable" style="width: 100% !important;min-height: 25px;" >
											<table id="textTable" text="<?php echo $updateId!=0?$theme_detail['Theme']['NoOfText']:'0';?>" style="border:1px solid #ccc;width:100%"><thead><tr><td><label class="control-label">Text Label</label></td></tr></thead><tbody><tr><td id="textTd">				
											<?php
											if($updateId!=0){
												?>
												<?php
													foreach ($theme_detail['LabelList'] as $Labels) {
														echo '<input type="text" class="form-control" value="'.$Labels['Label'].'" style="width:30%;margin:0 10px 10px 0;float:left;" name="label[]" />';
													}
												}
										?></tr></td></tbody></table>									
									   </div>
										<?php 			
									   if($updateId!=0){
										  echo $this->Form->Button('submit','btnSubmit','Update','btn btn-primary', array('style'=>'margin-right: 20px;'));
									   }else {
										  echo $this->Form->Button('submit','btnSubmit','Save','btn btn-primary', array('style'=>'margin-right: 20px;')); 
									   }
									    echo $this->Form->Button('button','btnCancel','Cancel','btn btn-primary');										
										 echo $this->Form->Close();
									    ?></div>
								  <div class="clear"></div>
								<div class="box-body">	
								<?php
									  $actionField = array(
											array(
													'base_url' =>$this->Url->getBaseUrl().'theme/status/',
													'value_field'=>0,
													'name_field'=>5,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Chnage Status'											
													)
												),
												 array(
												'base_url' =>$this->Url->getBaseUrl().'theme/update/',
												'value_field'=>0,
												'ancher_content' =>'<i class="fa fa-edit"></i>',
												'ancher_attr' => array(
													'title' => 'Update'										
												)
											 ),
											 array(
												'base_url' =>"#",
												'name_field'=>0,
												'ancher_content' =>'<i class="fa fa-times"></i>',
												'ancher_attr' => array(
															'title' => 'Delete',
														)
											 )
									  );
									  
								  echo $this->Datatable->getDatatable($theme_detail1,'ThemeList','datatable table-responsive table-condensed table-hover',array(),$actionField);
								  ?>
								  </div>
							   </div>
						    </div>                                       
						</div>
					 </div>
				  </div>
			   </div>
		    </div>
		</div>
	</section>
<?php if($updateId){?>
		<script>$(".fileformcontrol").removeAttr("required");</script>
<?php }?>
<script type="text/javascript">
	jQuery(document).ready(function(e) {
		setMenu('themeMenu', '');
		$("#collapseTwo").addClass("<?php echo $formStatus;?>");
		$("#btnCancel").click(function(){$("#collapseTwo").removeClass("in");$("#drpCatId").val("");});
		$('[data-tab="section-tab"] > li > a:first').tab('show');		
		$("#btnCancel").click(function(){ 
			 window.location.href='http://localhost/keyurWork/index.php/admin/theme';
		});
		$('#ThemeList td:last-child a:first-child').each(function(){
			var status = $(this).attr('name');
			var id = $(this).attr('data-id');
			if(status==1){
				$(this).attr("title","Disable");
				$(this).find('.icheckbox_minimal').addClass('checked');
				$(this).find('.icheckbox_minimal').attr('aria-checked', true);				
			}else{
				$(this).attr("title","Enable");
			}
			$(this).find('.iCheck-helper').attr('id', id);
			$(this).find('.iCheck-helper').attr('status', status);
		});
		jQuery("#ThemeList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
		$("#ThemeList .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			 window.location.href='/keyurWork/index.php/admin/theme/status/'+id;
		});
		$('#ThemeList td:last-child a:last-child').each(function(){
			var id = $(this).attr('name');
			$(this).find('.fa-times').attr('id', id);
		});
		$(".fa-times").click(function(){
			if (confirm("Are you sure you want to delete selected Theme?") == true) {
				var id=$(this).attr('id');
			 	window.location.href='/keyurWork/index.php/admin/theme/delete/'+id;
			}
		});
		$("#drpChangeThemeId").change(function(){
			 window.location.href='/keyurWork/index.php/admin/theme/'+$(this).val();
		});
		var updateId=<?php echo $updateId; ?>;
		if(updateId !=''){
			if(<?php echo $slidder;?> == 1){
				$('#frmTheme .icheckbox_minimal').first().addClass("checked");
				$('#frmTheme .icheckbox_minimal').first().attr("aria-checked", true);	
			}
			if(<?php echo $top;?> == 1){
				$('#frmTheme .icheckbox_minimal:nth-child(2)').addClass("checked");
				$('#frmTheme .icheckbox_minimal:nth-child(2)').attr("aria-checked", true);	
			}
		}
		$('#frmTheme .icheckbox_minimal').click(function(){
		   alert($(this).data("target")); 
		});
		$('.loader:first-child').click();
		/*$('#slidder1').click(function(){
			alert(1);
		});*/

	});
function addRow(tableID) {
	var no=$('input[name=txtNoOfText]').val();
	var text=$("#textTable").attr("text");
	var tmphtml='';
	if(text==0 && no>=1){
		for(j=0;j<no;j++){
			tmphtml += '<input type="text" class="form-control" style="width:30%;margin:0 10px 10px 0;float:left;" name="label[]" />';
		}
		$('#textTd').html(tmphtml);
	}
	else if(no>text){
		newno=no-text;
		for(j=0;j<newno;j++){
			tmphtml += '<input type="text" class="form-control" style="width:30%;margin:0 10px 10px 0;float:left;" name="label[]" />';
		}
		$('#textTd').append(tmphtml);
	}
	else if(no<text){
		newno=text-no;
		for(j=0;j<newno;j++){
			$('#textTd input:last').remove();
		}		
	}
	$("#textTable").attr("text",no);
}
</script>