<?php if(!isset($_SESSION['user'])):
	//$this->Url->redirect(ADMIN_URL.'login/');
 endif;
 require_once('head.php');?>
<body class="skin-black">
<header class="header">
            <a href="" class="logo">App Admin</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <ul class="nav navbar-nav">
                        <li >
                            <a data-toggle="" class="" href="#"> <i class="glyphicon glyphicon-user"></i>&nbsp; <span style="text-transform:uppercase"><b>Admin</b></span> </a>
                        </li>
						<li>
							<a data-toggle="" class="e" href="<?php echo ADMIN_URL.'logout/'?>"> <i class="fa fa-power-off"></i>&nbsp; <span><b>Sign Out</b></span> </a>
                        </li>
                    </ul>
                    </ul>
                </div>
            </nav>
</header>
<div class="clear"></div>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
<?php require_once('left-navigation.php'); ?>
	<aside id="right-side" class="right-side"> 