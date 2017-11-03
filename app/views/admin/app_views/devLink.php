<style>.form-control{width:25%}
table.sorting-table {cursor: move;}</style>
<section class="content-header">
    <h1> Link App  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active">Link App</li>
    </ol>
</section>
<?php
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
$aId = isset($GET[2]) && is_numeric($GET[2]) ? $GET[2]:0;
$dId = isset($GET[4]) && is_numeric($GET[4]) ? $GET[4]:0;
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
									<h3 class="box-title">Link App List</h3>
							   	</div>
							  	<div class="" style="border-bottom:1px solid #ccc;">
									<?php
									   echo $this->Form->Open('','frmItem','');					   
									  echo $this->Form->DropDown('drpAppId',$aId!=0?$aId:'','','App Name',array('style'=>'width:35% !important;'),array(),$all_app_info);
									  echo $this->Form->DropDown('drpDevAppId',$dId!=0?$dId:'','','Developer Account',array('style'=>'width:35% !important;'),array(),$developer_ac);
									   echo $this->Form->Close();
									    echo '<div class="clear"></div>';
									    ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if($aId){ ?>
			<div class="nav-tabs-custom ">
				<div class="box box-solid">
					<div class="box-body">
						<div class="box-group" id="accordion">
						    <div class="box-primary">
							   	<div class="box-header" style="border-bottom:1px solid #ccc;">
									<h3 class="box-title">Link App</h3>
										<h3 class="box-title pull-right">
										<button id="unlinkApp" class="btn btn-primary" style="color:#fff">Unlink App</button>
								  	</h3>
							   	</div>
							  	<div class="" style="border-bottom:1px solid #ccc; padding-top: 10px;">
								  <?php
								  	$actionField = array(
											array(
													'base_url' =>'#',
													'value_field'=>0,
													'name_field'=>0,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Unlink'									
													)
												),
												array(
													'base_url' =>'#',
													'value_field'=>0,
													'name_field'=>4,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Banner On'									
													)
												)
											 );
								  echo $this->Datatable->getDatatable($app_link_detail,'LinkApp','datatable table-responsive table-condensed table-hover',array(),$actionField);
								  ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			}
			if($dId){
			?>			
			<div class="nav-tabs-custom ">
				<div class="box box-solid">
					<div class="box-body">
						<div class="box-group" id="accordion">
						    <div class="box-primary">
							   	<div class="box-header" style="border-bottom:1px solid #ccc;">
									<h3 class="box-title">App List</h3>
										<h3 class="box-title pull-right">
										<button id="linkApp" class="btn btn-primary" style="color:#fff">Link App</button>
								  	</h3>
							   	</div>
							  	<div class="" style="border-bottom:1px solid #ccc; padding-top: 10px;">								 
								<?php
									  $actionField = array(
											array(
													'base_url' =>'#',
													'value_field'=>0,
													'name_field'=>0,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Link'											
													)
												)
											 );
								  echo $this->Datatable->getDatatable($apps_info,'LinkTable','datatable table-responsive table-condensed table-hover',array(),$actionField);
								  ?>		
								  </div>
							   </div>
						    </div>                                       
						</div>
					 </div>
				  </div>
			   </div>
			 <?php } ?>
		    </div>
		</div>
	</section>
<script type="text/javascript">
	RowSorter("#LinkApp");
</script>
<script type="text/javascript">
	jQuery(document).ready(function(e) {
		setMenu('devLinkMenu', '', '', '');	
		$("#drpAppId").change(function(){
			 window.location.href='/appAdmin/index.php/admin/devLink/app/'+$(this).val()+'/dev/'+<?php echo $dId;?>;
		});
		$("#drpDevAppId").change(function(){
			 window.location.href='/appAdmin/index.php/admin/devLink/app/'+<?php echo $aId;?>+'/dev/'+$(this).val();
		});
		$('#LinkTable td:last-child a:first-child').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});		
		$('#LinkApp td:last-child a:nth-child(2)').each(function(){
			var status = $(this).attr('name');
			var id = $(this).attr('data-id');
			if(status==1){
				$(this).attr("title","Banner Off");
				$(this).find('.icheckbox_minimal').addClass('checked');
				$(this).find('.icheckbox_minimal').attr('aria-checked', true);				
			}else{
				$(this).attr("title","Banner On");
			}
			$(this).find('.iCheck-helper').attr('id', id);
			$(this).find('.iCheck-helper').attr('status', status);
		});		
		$('#LinkApp td:last-child a:first-child').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});
		$("#LinkApp td:last-child a:nth-child(2) .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			window.location.href='/appAdmin/index.php/admin/devLink/app/'+<?php echo $aId;?>+'/dev/'+<?php echo $dId;?>+'/banner/'+id;
		});
		jQuery("#LinkApp").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": false,
			"bInfo": true,
			"bAutoWidth": true
		});
		$("#linkApp").click(function(){
			var appid=[];
			$('#LinkTable td:last-child a:first-child .icheckbox_minimal').each(function(){
				if($(this).hasClass("checked")){
					appid.push($(this).find('.iCheck-helper').attr('id'));
				}				
			});
			$.ajax({
				url: "/appAdmin/index.php/api/linkdevapp",
				type: "post",
				data: {
					aId: <?php echo $aId;?>,
					lId: JSON.stringify(appid)
				},
				beforeSend: function (jqXHR, settings) {
					$(".box-body *").attr("disabled", "disabled");
					if (jqXHR && jqXHR.overrideMimeType) {
						jqXHR.overrideMimeType("application/j-son;charset=UTF-8");
					}
				},
				success: function (result)
				{
					window.location.href='/appAdmin/index.php/admin/devLink/app/'+<?php echo $aId;?>+'/dev/'+<?php echo $dId;?>;
				},
				error: function (jqXHR, textStatus, errorThrown) {
				},
				complete: function (jqXHR, textStatus) {
					$(".box-body *").removeAttr("disabled");
				}
			});
		});
		$("#unlinkApp").click(function(){
			var appid=[];
			$('#LinkApp td:last-child a:first-child .icheckbox_minimal').each(function(){
				if($(this).hasClass("checked")){
					appid.push($(this).find('.iCheck-helper').attr('id'));
				}				
			});
			$.ajax({
				url: "/appAdmin/index.php/api/unlinkdevapp",
				type: "post",
				data: {
					aId: <?php echo $aId;?>,
					lId: JSON.stringify(appid)
				},
				beforeSend: function (jqXHR, settings) {
					$(".box-body *").attr("disabled", "disabled");
					if (jqXHR && jqXHR.overrideMimeType) {
						jqXHR.overrideMimeType("application/j-son;charset=UTF-8");
					}
				},
				success: function (result)
				{
					window.location.href='/appAdmin/index.php/admin/devLink/app/'+<?php echo $aId;?>+'/dev/'+<?php echo $dId;?>;
				},
				error: function (jqXHR, textStatus, errorThrown) {
				},
				complete: function (jqXHR, textStatus) {
					$(".box-body *").removeAttr("disabled");
				}
			});
		});
	});
</script>