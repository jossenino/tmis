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
	<?php echo form_open('register/registerNewUserSave','class="form-register"'); ?>
	<div class="row">
		<!--<hr class="style-three">-->
	    <h3 class="form-signin-heading">Registrando nuevo usuario</h3>
	    <div class="col-sm-6 col-md-6">
			<div class="form-group has-feedback">
				<?php 
					$inputUserName = array(
					'id' => 'userName',
					'name' => 'userName',
					'class' => 'form-control',
					'placeholder' => 'Nombre usuario');
					echo form_input($inputUserName); ?>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group has-feedback">
				<?php 
					$inputEmail = array(
					'id' => 'email',
					'name' => 'email',
					'class' => 'form-control',
					'placeholder' => 'Correo electrónico');
					echo form_input($inputEmail); ?>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group has-feedback">
				<?php 
					$inputPassword = array(
					'id' => 'password',
					'name' => 'password',
					'class' => 'form-control',
					'placeholder' => 'Nueva contraseña');
					echo form_password($inputPassword); ?>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group has-feedback">
			<?php 
				$inputpassword_confirm = array(
				'id' => 'password_confirm',
				'name' => 'password_confirm',
				'class' => 'form-control',
				'placeholder' => 'Repita nueva contraseña');
				echo form_password($inputpassword_confirm); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
		</div>
		<div class="col-sm-6 col-md-6">
			<div class="form-group">
				<?php 
					$options = array();
					if(count($companys)) {
						foreach($companys as $company) {
							$options[$company->id] = $company->companyName;
						}
					}

					$inputCompany = array(
					'id' => 'company',
					'readonly' => '',
					'class' => 'form-control');
					echo form_dropdown('company', $options, set_value('company',$user->idCompany), $inputCompany); ?>
			</div>
		</div>
	</div>
	<section>
		<div class="row ">
			<div class="col-xs-6">
				<?php echo form_submit('submit', 'Registrar', 'class="btn btn-primary col-sm-12"'); ?>
			</div>
			<div class="col-xs-6">
				<button type="submit" class="btn btn-default col-sm-12" onclick="onclick="<?php echo base_url('index.php/login') ?>"" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</section>
	<?php echo form_close(); ?>