<h3><?php echo empty($user->idUsers) ? 'Add a new user' : 'Edit user ' . $user->userName; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/user/edit', '<i class="fa fa-plus"></i> Add a user'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputUserName = array(
								'id' => 'userName',
								'name' => 'userName',
								'class' => 'form-control',
								'placeholder' => 'Nombre usuario');
								echo form_input($inputUserName, set_value('userName', $user->userName)); ?>
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
								echo form_input($inputEmail, set_value('email', $user->email)); ?>
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
								if(count($profiles)) {
									foreach($profiles as $profile) {
										$options[$profile->idProfile] = $profile->profile;
									}
								}

								$inputProfile = array(
								'id' => 'profile',
								'class' => 'form-control');
								echo form_dropdown('profile', $options, set_value('profile',$user->idProfile), $inputProfile); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array(
									'Seleccionar' => 'Seleccione un estado',
							        '0'         => 'Inactivo',
							        '1'           => 'Activo',
							        '2'         => 'Suspendido',
								);
								$inputProfile = array(
								'id' => 'status',
								'class' => 'form-control');
								echo form_dropdown('status', $options, set_value('status',$user->status), $inputProfile); ?>
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
				</section>
              </div><!-- /.box-body -->
              <div class="box-footer primary">
              	<div class="row">
                    <section class="col-md-4 pull-right">
                    	<div class="form-group has-feedback" style="margin-left:50px;">
                    		<?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>
                    		<?php echo form_submit('submit', 'Cancelar', 'class="btn btn-default"'); ?>
                    	</div>
                    </section>
                </div>
              </div>
     		</div><!-- /.box -->
     		<?php echo form_close();?>
		</div>
	</div>
