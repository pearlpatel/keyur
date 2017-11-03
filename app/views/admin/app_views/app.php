<style>.form-control{width:50%}</style>
 <section class="content-header">
    <h1> Apps  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active"><a href="<?php echo ADMIN_URL.'app/'; ?>">App List</a></li>
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
									<h3 class="box-title">App List</h3>
								   	<h3 class="box-title pull-right">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary" style="color:#fff">Add New </a>
								  	</h3>
							   	</div>
							  	<div id="collapseTwo" class="panel-collapse collapse" style="border-bottom:1px solid #ccc;">
									<?php
									   echo $this->Form->Open($this->Url->getBaseUrl().($updateId?'app/update/'.$updateId:'app/add/'),'frmItem',array('enctype'=>'multipart/form-data'));
									   echo $this->Form->DropDown('drpDevAppId',$updateId?$app_detail['DAId']:'','','Developer Account',array(),array(),$developer_ac);
									   echo $this->Form->Input('','txtAppName',$updateId?$app_detail['AppName']:'','adminForm','App Name',array('placeholder'=>'App Name','autocomplete'=>'off'),array(),array());
									   echo $this->Form->Input('','txtPacName',$updateId?$app_detail['PackageName']:'','adminForm','Package Name',array('placeholder'=>'Package Name','autocomplete'=>'off'),array(),array());
									   echo $this->Form->Textarea('txtDesc',$updateId?$app_detail['ShortDiscription']:'','','Short Description',array('placeholder'=>'','autocomplete'=>'off'),array(),array());
									   if($updateId){
									   		echo '<label class="control-label" for="fileImage">App Logo</label><br>';
									   		echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$app_detail['Logo'].'" height="45px" /></div>';
											echo '<input name="logo" type="hidden" value="'.$app_detail['Logo'].'" />';
											echo $this->Form->Input('file','fileImage','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
											echo '<br><label class="control-label" for="fileImage">App Icon</label><br>';
											echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$app_detail['Icon'].'" height="45px" /></div>';
											echo '<input name="icon" type="hidden" value="'.$app_detail['Icon'].'" />';
											echo $this->Form->Input('file','iconImage','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
											 echo '<br><label class="control-label" for="fileImage">Promo Banner</label><br>';
											 echo '<div style="height:55px;width:55px;float:left;"><img src="'.BASE_URL.$app_detail['PromoBanner'].'" height="45px" /></div>';
											echo '<input name="banner" type="hidden" value="'.$app_detail['PromoBanner'].'" />';
											echo $this->Form->Input('file','bannerFile','','fileformcontrol','',array('style'=>'padding:0 !important; float:left; width:90%; margin:12px;'),array(),array());
									   }else{
									   	echo $this->Form->Input('file','fileImage','','fileformcontrol','App Logo',array('style'=>'padding:0 !important;'),array(),array());
									   	echo $this->Form->Input('file','iconImage','','fileformcontrol','App Icon',array('style'=>'padding:0 !important;'),array(),array());
									   	echo $this->Form->Input('file','bannerFile','','fileformcontrol','Promo Banner',array('style'=>'padding:0 !important;'),array(),array());
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

								  <div class="box-body" style="border-bottom:1px solid #ccc;">
								  	<?php								  	
									   echo $this->Form->Open('','frmDev','');
									   echo $this->Form->DropDown('drpDevId',$dId!=0?$dId:'','','Developer Account',array(),array(),$developer_acc);										   		
									  // echo $this->Form->Button('button','btnAllApp','View All App','btn btn-primary', array('style'=>'float:right;'));   
									    echo $this->Form->Close();
									    echo '<div class="clear"></div>';?>
								</div>
								<div class="box-body">	
								<?php	  
									  $actionField = array(
											array(
													'base_url' =>$this->Url->getBaseUrl().'developer/status/',
													'value_field'=>0,
													'name_field'=>6,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Chnage Status'											
													)
												),					
											 array(
												'base_url' =>$this->Url->getBaseUrl().'viewappdetail/',
												'value_field'=>0,
												'ancher_content' =>'<i class="fa fa-eye"></i>',
												'ancher_attr' => array(
													'title' => 'View Detail'							
												)
											 ), array(
												'base_url' =>$this->Url->getBaseUrl().'app/update/',
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
								  echo $this->Datatable->getDatatable($apps_detail,'AppList','datatable table-responsive table-condensed table-hover',array(),$actionField);
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
		setMenu('AppList', '');
		$("#collapseTwo").addClass("<?php echo $formStatus;?>");
		$("#btnCancel").click(function(){$("#collapseTwo").removeClass("in");$("#drpDevAppId").val("");});
		$('[data-tab="section-tab"] > li > a:first').tab('show');		
		$("#btnCancel").click(function(){ 
			 window.location.href='http://rapidllc.online/appAdmin/index.php/admin/app';
		});
		$('#AppList td:last-child a:first-child').each(function(){
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
		jQuery("#AppList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
		$(".iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			 window.location.href='/appAdmin/index.php/admin/app/status/'+id;
		});
		$('#AppList td:last-child a:last-child').each(function(){
			var id = $(this).attr('name');
			$(this).find('.fa-times').attr('id', id);
		});
		$(".fa-times").click(function(){
			if (confirm("Are you sure you want to delete selected app?") == true) {
				var id=$(this).attr('id');
			 	window.location.href='/appAdmin/index.php/admin/app/delete/'+id;
			} else {}			
		});
		$("#drpDevId").change(function(){
			 window.location.href='/appAdmin/index.php/admin/app/'+$(this).val();
		});
	});
</script>