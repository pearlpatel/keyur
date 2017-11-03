<?php

$url = $this->Url->getUrlSegment();

$GET = explode('/',$url);

$tabList = array('','update');

$tabClass = array();

$tabClass[0] = isset($GET[1]) && $GET[1]==$tabList[0] ? ' ':'active';
$tabClass[1] = isset($GET[1]) && $GET[1]==$tabList[1] ? ' active':'';

$developerId = isset($GET[2])?$GET[2]:'';
if(isset($developerId) && $developerId!='') {$tabClass[0]="";}//else{$formStatus="";}
?>

 <section class="content-header">

 <?php if(isset($message)){?>

 	<div class="alert alert-success alert-dismissable">

        <i class="fa fa-check"></i>

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <b>Alert!</b> <?php echo $message;?>

    </div>

    <?php } ?>

    <h1> Developer Account List </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home </a></li>

        <li class="active">Developer</li>

    </ol>

</section>

<section class="content">

	<div class="row">

		<div class="col-md-12">

        	<div class="nav-tabs-custom ">

				<ul class="nav nav-tabs nav-pills">

					<li id="list" class="<?php echo $tabClass[0]; ?>"><a href="#tab_1" data-toggle="tab">Developer Accounts</a></li>

                    <li id="add" class="<?php echo $tabClass[1]; ?>"><a href="#tab_3" data-toggle="tab">Add Developer Account</a></li>

				</ul>

				<div class="tab-content">

					<div class="tab-pane <?php echo $tabClass[0]; ?>" id="tab_1">
						<?php
						$actionField = array(
												array(
													'base_url' =>$this->Url->getBaseUrl().'developer/status/',
													'value_field'=>0,
													'name_field'=>3,
													'ancher_content' =>'<input type="checkbox" />',
													'ancher_attr' => array(
															'title' => 'Chnage Status'															
														)
												),
												array(
													'base_url' =>$this->Url->getBaseUrl().'developer/update/',
													'value_field'=>0,
													'ancher_content' =>'<i class="fa fa-edit"></i>',
													'ancher_attr' => array(
															'title' => 'Update'
														)
												),
						);
					echo $this->Datatable->getDatatable($tab_1,'DeveloperList','datatable table-condensed table-hover',array(),$actionField);
                        ?>
                     </div>
                   	 <div class="tab-pane <?php echo $tabClass[1]; ?>" id="tab_3" >
                   		<?php 
						echo $this->Form->Open($this->Url->getBaseUrl().($developerId?'developer/update/'.$developerId:'developer/add/'),'frmItem',array('enctype'=>'multipart/form-data'));
						echo isset($error)?'<p class="text-danger">'.$error.'</p>':'';
						echo $this->Form->Input('','txtName',$developerId?$tab_3['AcName']:'','adminForm','AccountName',array('placeholder'=>'Account Name','autocomplete'=>'off'),array(),array());
						echo $this->Form->Input('','txtEmail',$developerId?$tab_3['EmailId']:'','adminForm','EmailId',array('placeholder'=>'Email','autocomplete'=>'off'),array(),array());
						echo $this->Form->Button('submit','btnSubmitUser',$developerId?'Update':'Submit','btn btn-primary');
						echo $this->Form->Button('button','btnCancel','Cancel','btn btn-primary');
					echo $this->Form->Close();
					echo '</div><div class="clear"></div>';
						?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function(e) {
		setMenu('developerMenu', '', '');
		$('[data-tab="section-tab"] > li > a:first').tab('show') // Select first tab
		jQuery("#DeveloperList").dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true	
		});
		$('#DeveloperList td:last-child a:first-child').each(function(){
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
		$(".iCheck-helper").click(function(){ 
			var id=$(this).attr('id');
			 window.location.href='/appAdmin/index.php/admin/developer/status/'+id;
		});
	});
</script>