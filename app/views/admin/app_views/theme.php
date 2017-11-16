<style>.form-control{width:50%}</style> 
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
$dId = isset($GET[1]) && is_numeric($GET[1]) ? $GET[1]:'';
$updateId = isset($GET[2]) && is_numeric($GET[2]) ? $GET[2]:'';
if($updateId) {$formStatus="in";}else{$formStatus="";}
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
									   echo $this->Form->Open($this->Url->getBaseUrl().($updateId?'theme/update/'.$updateId:'theme/add/'),'frmItem',array('novalidate'=>'novalidate','enctype'=>'multipart/form-data'));
									   echo $this->Form->DropDown('drpCatId',$updateId?$theme_detail['CId']:'','','Category',array(),array(),$category);
									   echo $this->Form->Input('','txtThemeName',$updateId?$theme_detail['Name']:'','adminForm','Theme Name',array('placeholder'=>'Theme Name','autocomplete'=>'off'),array(),array());
									   echo $this->Form->Textarea('txtDesc',$updateId?$theme_detail['Description']:'','','Short Description',array('placeholder'=>'','autocomplete'=>'off'),array(),array());
									   if($updateId){
									   		echo '<label class="control-label" for="fileImage">Preview</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Preview'].'" height="45px" /></div>';
											echo '<input name="imagepreview" type="hidden" value="'.$theme_detail['Preview'].'" />';
											echo $this->Form->Input('file','imagePreview','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
									   		echo '<label class="control-label" for="fileImage">Images</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Images'].'" height="45px" /></div>';
											echo '<input name="imagepreview2" type="hidden" value="'.$theme_detail['Images'].'" />';
											echo $this->Form->Input('file','imagePreview2[]','','fileformcontrol','',array('multiple'=>'multiple','style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
									   		echo '<label class="control-label" for="videofile">Video</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$theme_detail['Video'].'" height="45px" /></div>';
											echo '<input name="video" type="hidden" value="'.$theme_detail['Video'].'" />';
											echo $this->Form->Input('file','Video','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());																			
									   }else{
									   	echo $this->Form->Input('file','imagePreview','','fileformcontrol','Preview',array('style'=>'padding:0 !important;'),array(),array());
									   	echo $this->Form->Input('file','imagePreview2[]','','fileformcontrol','Images',array('multiple'=>'multiple','style'=>'padding:0 !important;'),array(),array());
										echo $this->Form->Input('file','Video','','fileformcontrol','Video',array('required'=>'','style'=>'padding:0 !important; '),array(),array());																			
									   }
									   echo $this->Form->Input('','txtNoOfPhoto',$updateId?$theme_detail['NoOfPhoto']:'','adminForm','No. Of Photos',array('autocomplete'=>'off'),array(),array());
									   echo $this->Form->Input('','txtNoOfVideo',$updateId?$theme_detail['NoOfVideo']:'','adminForm','No. Of Videos',array('autocomplete'=>'off'),array(),array());
									   echo $this->Form->Input('','txtNoOfText',$updateId?$theme_detail['NoOfText']:'','adminForm','No. Of Textes',array('autocomplete'=>'off'),array(),array());
									   if($updateId){
										  echo $this->Form->Button('submit','btnSubmit','Update','btn btn-primary', array('style'=>'margin-right: 20px;'));
									   }else {
										  echo $this->Form->Button('submit','btnSubmit','Save','btn btn-primary', array('style'=>'margin-right: 20px;')); 
									   }
									    echo $this->Form->Button('button','btnCancel','Cancel','btn btn-primary');
									    echo $this->Form->Close();
									    echo '<div class="clear"></div>';
									    ?>
								  </div>
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
		//$('input[name=Video]').removeAttr('required');?????
		// $('input[name="tipo_de_producto_que_fabrica[]"]').attr('required',true);
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
		$(".iCheck-helper").click(function(){ 
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
			} else {}			
		});
		$("#drpChangeThemeId").change(function(){
			 window.location.href='/keyurWork/index.php/admin/theme/'+$(this).val();
		});
	});
</script>