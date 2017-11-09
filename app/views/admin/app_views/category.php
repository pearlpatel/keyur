<style>.form-control{width:50%}</style>
 <section class="content-header">
    <h1> Categories  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active"><a href="<?php echo ADMIN_URL.'app/'; ?>">Category List</a></li>
    </ol>
</section>
<?php
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
$cId = isset($GET[1]) && is_numeric($GET[1]) ? $GET[1]:'';
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
									<h3 class="box-title">Category List</h3>
								   	<h3 class="box-title pull-right">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary" style="color:#fff">Add New </a>
								  	</h3>
							   	</div>
							  	<div id="collapseTwo" class="panel-collapse collapse" style="border-bottom:1px solid #ccc;">
									<?php
									   echo $this->Form->Open($this->Url->getBaseUrl().($updateId?'category/update/'.$updateId:'category/add/'),'frmItem',array('enctype'=>'multipart/form-data'));
									   echo $this->Form->Input('','txtCatName',$updateId?$cat_detail['Name']:'','adminForm','Category Name',array('placeholder'=>'Category Name','autocomplete'=>'off'),array(),array());
									   echo $this->Form->Textarea('txtDesc',$updateId?$cat_detail['Description']:'','','Short Description',array('placeholder'=>'','autocomplete'=>'off'),array(),array());
									   if($updateId){
									   		echo '<label class="control-label" for="fileImage">Category Icon</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.PICTURE_DIR.$cat_detail['Icon'].'" height="45px" /></div>';
											echo '<input name="icon" type="hidden" value="'.$cat_detail['Icon'].'" />';
											echo $this->Form->Input('file','fileIcon','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());											
									   }else{
									   	echo $this->Form->Input('file','fileIcon','','fileformcontrol','Category Icon',array('style'=>'padding:0 !important;'),array(),array());
									   }									   
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
													'base_url' =>$this->Url->getBaseUrl().'category/status/',
													'value_field'=>0,
													'name_field'=>5,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Chnage Status'											
													)
												),
												 array(
												'base_url' =>$this->Url->getBaseUrl().'category/update/',
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
								  echo $this->Datatable->getDatatable($tab_1,'CategoryList','datatable table-responsive table-condensed table-hover',array(),$actionField);
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
		setMenu('catMenu', '');
		$("#collapseTwo").addClass("<?php echo $formStatus;?>");
		$("#btnCancel").click(function(){$("#collapseTwo").removeClass("in");});
		$('[data-tab="section-tab"] > li > a:first').tab('show');		
		$("#btnCancel").click(function(){ 
			 window.location.href='http://rapidllc.online/appAdmin/index.php/admin/app';
		});
		$('#CategoryList td:last-child a:first-child').each(function(){
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
		jQuery("#CategoryList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
		$(".iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			 window.location.href='/keyurWork/index.php/admin/category/status/'+id;
		});
		$('#AppList td:last-child a:last-child').each(function(){
			var id = $(this).attr('name');
			$(this).find('.fa-times').attr('id', id);
		});
		$(".fa-times").click(function(){
			if (confirm("Are you sure you want to delete selected app?") == true) {
				var id=$(this).attr('id');
			 	window.location.href='/keyurWork/index.php/admin/category/delete/'+id;
			} else {}			
		});
		$("#drpDevId").change(function(){
			 window.location.href='/keyurWork/index.php/admin/category/'+$(this).val();
		});
	});
</script>