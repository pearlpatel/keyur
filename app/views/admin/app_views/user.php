<section class="content-header">
    <h1> User Account List </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home </a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
        	<div class="nav-tabs-custom ">
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<?php	
					echo $this->Datatable->getDatatable($userList,'UserList','datatable table-condensed table-hover',array());
                        ?>
                     </div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function(e) {
		setMenu('userMenu', '', '');
		jQuery("#UserList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true	
		});
	});
</script>