<style>textarea.form-control {
    height: 65px !important;}
</style>
<section class="content-header"> 
    <h1>Top Themes  </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li class="active"><a href="<?php echo ADMIN_URL.'top/'; ?>">Top Theme List</a></li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom ">
				<div class="box box-solid">                                  
					 <div class="box-body">
						<div class="box-group" id="accordion">
						    <div class="box-primary">
							   	<div class="box-header" style="border-bottom:1px solid #ccc;">
									<h3 class="box-title">Top Theme List</h3>
							   	</div>
								<div class="box-body">	
								<?php
									  $actionField = array(
											array(
													'base_url' =>$this->Url->getBaseUrl().'top/remove/',
													'value_field'=>0,
													'name_field'=>0,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
														'title' => 'Remove'											
													)
												)
									  );
								  echo $this->Datatable->getDatatable($top_theme_detail,'TopThemeList','datatable table-responsive table-condensed table-hover',array(),$actionField);
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
									<h3 class="box-title">Theme List</h3>
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
														'title' => 'Add'											
													)
												)
											 );
								  echo $this->Datatable->getDatatable($theme_detail,'ThemeTable','datatable table-responsive table-condensed table-hover',array(),$actionField);
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
		setMenu('topMenu', '');
		$('#TopThemeList td:last-child a').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});
		$('#ThemeTable td:last-child a').each(function(){
			var id = $(this).attr('data-id');
			$(this).find('.iCheck-helper').attr('id', id);
		});
		$("#TopThemeList td:last-child a .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			window.location.href='/keyurWork/index.php/admin/top/remove/'+id;
		});
		$("#ThemeTable td:last-child a .iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			window.location.href='/keyurWork/index.php/admin/top/add/'+id;
		});
		jQuery("#TopThemeList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
		jQuery("#ThemeTable").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": false,
			"bInfo": true,
			"bAutoWidth": true
		});
	});

</script>