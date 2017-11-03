<section class="content-header">
    <h1> App Detail</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li><a href="<?php echo ADMIN_URL.'app/'; ?>"><i class="fa fa-android" style="font-size:20px;"></i> Apps</a></li>
        <li class="active">App Detail</li>
    </ol>
</section>

<?php
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
$appId = isset($GET[1])?$GET[1]:'';
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom ">
				<ul class="nav nav-tabs nav-pills no-print">
                	<?php if($appId):?><li class="active"><a href="#tab_2" data-toggle="tab">App Information</a></li><?php endif;?>
				</ul>
				<div class="tab-content">
                    <div class="tab-pane active" id="tab_2">
                    	<aside>
                            <section class="content-header"></section>            
                            <section class="content invoice">
                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped">
										   <thead>
												<?php while($rs=mysql_fetch_array($detail)){?>
                                                <tr>	
                                                	<td width="25%" style="font-weight:700;">App Name</td><td><?php echo $rs['AppName'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Package Name</td><td><?php echo $rs['PackageName'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Developer Account</td><td><?php echo $rs['AcName'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Views</td><td><?php echo $rs['Views'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Downloads</td><td><?php echo $rs['Downloads'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Status</td><td><?php if($rs['AppStatus']==1){echo 'Enabled';}else{echo 'Disabled';}?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Short Description</td><td><?php echo $rs['ShortDiscription'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Logo</td><td><img src="<?php echo BASE_URL.$rs['Logo'];?>" height="100px" /></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Icon</td><td><img src="<?php echo BASE_URL.$rs['Icon'];?>" height="100px" /></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Promo Banner</td><td><img src="<?php echo BASE_URL.$rs['PromoBanner'];?>" height="100px" /></td>
                                                </tr>
												<?php } ?>
                                           </thead> 
                                        </table>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </section><!-- /.content -->
                         </aside>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(e) {
		setMenu('appMenu', '', '');
	});
</script>