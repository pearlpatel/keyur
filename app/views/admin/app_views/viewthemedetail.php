<section class="content-header">
    <h1> ThemeDetail</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
        <li><a href="<?php echo ADMIN_URL.'theme/'; ?>"><i class="fa fa-android" style="font-size:20px;"></i> Themes</a></li>
        <li class="active">Theme Detail</li>
    </ol>
</section>

<?php
$url = $this->Url->getUrlSegment();
$GET = explode('/',$url);
$themeId = isset($GET[1])?$GET[1]:'';
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom ">
				<ul class="nav nav-tabs nav-pills no-print">
                	<?php if($themeId):?><li class="active"><a href="#tab_2" data-toggle="tab">Theme Information</a></li><?php endif;?>
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
						<?php while($rs=mysql_fetch_array($theme_detail)){?>
                                                <tr>	
                                                	<td width="25%" style="font-weight:700;">Theme Name</td><td><?php echo $rs['Name'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Category Name</td><td><?php echo $rs['CategoryName'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Theme Description</td><td><?php echo $rs['Description'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Views</td><td><?php echo $rs['Views'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Total View</td><td><?php echo $rs['Views'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Total Like</td><td><?php echo $rs['Like'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Total Photo</td><td><?php echo $rs['NoOfPhoto'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Total Video</td><td><?php echo $rs['NoOfVideo'];?></td>
												</tr>
												<tr>
                                                    <td style="font-weight:700;">Total Text</td><td><?php echo $rs['NoOfText'];?></td>
												</tr>
						<?php 
							if($rs['Preview']!=''){ ?>
												<tr>
                                                    <td style="font-weight:700;">Main Preview Image</td><td><img src="<?php echo BASE_URL.$rs['Preview'];?>" height="100px" /></td>
												</tr>
							<?php }
							if($rs['Images']!=''){ ?>
												<tr>
                                                    <td style="font-weight:700;">Sub-Preview Images</td><td>
                                                    <?php
                                                    	$images=split(';',$rs['Images']);
                                                    	for($i=0;$i<count($images);$i++){ ?>
                                                    		<img src="<?php echo BASE_URL.$images[$i];?>" height="110px" style="padding-bottom:10px;"/></br>
                                                    	<?php }
                                                    ?>
                                                    </td>
												</tr>
						<?php }
							if($rs['Video']!=''){ ?>
												<tr>
                                                    <td style="font-weight:700;">Preview Video</td><td><embed src="<?php echo BASE_URL.$rs['Video'];?>" autostart="true" height="110" width="144" /></td>
                                                </tr>
												<?php }} ?>
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
		setMenu('themeMenu', '', '');
	});
</script>