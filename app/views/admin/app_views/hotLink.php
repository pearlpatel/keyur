<style>.form-control{width:25%}
table.sorting-table {cursor: move;}</style>
<section class="content-header">
    <h1> Link App  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active">Hot Link App</li>
    </ol>
</section>
<?php
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
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
									<h3 class="box-title">Hot Link App</h3>
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
			<div class="nav-tabs-custom ">
				<div class="box box-solid">
					<div class="box-body">
						<div class="box-group" id="accordion">
						    <div class="box-primary">
							   	<div class="box-header" style="border-bottom:1px solid #ccc;">
									<h3 class="box-title">App List</h3>
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
		    </div>
		</div>
	</section>
<script type="text/javascript">
	jQuery(document).ready(function(e) {
		setMenu('hotLinkMenu', '', '', '');
		$('#LinkTable td:last-child a:first-child').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});
		$('#LinkApp td:last-child a:first-child').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});
		
		$("#LinkApp td:last-child a:first-child .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			window.location.href='/appAdmin/index.php/admin/hotLink/unlink/'+id;
		});
		$("#LinkTable td:last-child a:first-child .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			window.location.href='/appAdmin/index.php/admin/hotLink/link/'+id;
		});
		jQuery("#LinkTable").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
		jQuery("#LinkApp").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": false,
			"bInfo": true,
			"bAutoWidth": true
		});
	});
</script>