<!DOCTYPE html>

<html>

<?php require_once('templates/head.php');?>

    <body class="bg-black">

        <div class="form-box" id="login-box">

            <div class="header">Sign In</div>

			<?php 

			echo $this->Form->Open();

				echo '<div class="body bg-gray">';

					echo isset($error)?'<p class="text-danger">'.$error.'</p>':'';

                       echo $this->Form->Input('','txtUserName','','','',array('placeholder'=>'User Name','autocomplete'=>'off'),array(),array());

					   echo $this->Form->Input('password','txtPassword','','','',array('placeholder'=>'Password','autocomplete'=>'off'),array(),array());

                echo '</div>';

				echo '<div class="footer">';    

					echo $this->Form->Button('Submit','submit','Sign me in','btn bg-olive btn-block','',array('placeholder'=>'User Name','autocomplete'=>'off'),array(),array());

                echo '</div>';

			echo $this->Form->Close();

			?>

        </div>

    </body>

</html>