<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - TMIS</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- SingIn CSS -->
    <link href="<?php echo base_url('bootstrap/css/signin.css'); ?>" rel="stylesheet">
     <!-- Bootstrap 3.3.5 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>

	<div class="container">
		<?php if($this->session->flashdata('error')){ ?>
			<div class="alert alert-danger">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    	<strong>Ups!</strong> <?php echo $this->session->flashdata('error'); ?>
		    </div>
	    <?php }?>
	    <?php if (validation_errors()){?>
	    <div class="alert alert-danger">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo validation_errors(); ?>
		    </div>
		 <?php } ?>
		 <div class="login-logo">
	       	<a href="../../index2.html"> <img id="login-img" src="<?php echo base_url('img/tmis_logo.jpg'); ?>" width="40%"> <!--<b>T-MIS</b>--></a>
	     </div><!-- /.login-logo -->
    	<?php echo form_open('','class="form-signin"'); ?>
	        <!--<hr class="style-three">-->
	        <h3 class="form-signin-heading">Inicia sesión</h3>
	        <div class="form-group has-feedback">
	            <input type="email" class="form-control" placeholder="Email" name="email">
	            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	        </div>
	          <div class="form-group has-feedback">
	            <input type="password" class="form-control" placeholder="Password" name="password">
	            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	          </div>
	        <div class="checkbox">
	          <label>
	            <input type="checkbox" value="remember-me"> Remember me
	          </label>
	        </div>
	        <?php echo form_submit('submit', 'Entrar', 'class="btn btn-primary btn-block btn-flat"'); ?>
	        <br><a onclick="recoverPassword()">Recuperar contraseña</a><br>
	        <div class="row ">
	        	<div class="col-xs-6">
		        	<br><a href="<?php echo base_url('index.php/register/registerNewClient/') ?>">Cliente nuevo?</a><br>
		        </div>
		        <div class="col-xs-6">
		        	<br><a href="<?php echo base_url('index.php/register/registerNewUser/') ?>">Usuario nuevo?</a><br>
		        </div>
	        </div>
	    <?php echo form_close(); ?>
    </div>

    <!--ventana modal para recuperar contraseña-->
	<div class="modal fade" id="recoverPassword-modal">
	    <div class="modal-dialog">
		    <div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">Recuperación de contraseña</h4>
		        </div>
			    <div class="modal-body" style="height: 100px">
			        <?php echo form_open('admin/user/recoverPassword'); ?>
			        	<div class="col-xs-8">
				        	<div class="form-group has-feedback">
					            <input type="email" class="form-control" placeholder="Por favor introduzca su correo electrónico" name="email">
					            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					        </div>
				        </div>
				        <div class="col-xs-4">
							<?php echo form_submit('submit', 'Registrar', 'class="btn btn-primary col-sm-12"'); ?>
						</div>
			        <?php echo form_close(); ?>
			    </div>
		        <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		    </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  </body>
  <script type="text/javascript">
  		function recoverPassword(){
  			$('#recoverPassword-modal').modal('show'); 
  		}
  </script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
</html>