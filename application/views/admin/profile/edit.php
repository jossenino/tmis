<h3><?php echo empty($profile->idprofile) ? 'Add a new profile' : 'Edit profile ' . $profile->profile; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/profile/edit', '<i class="glyphicon glyphicon-plus"></i> Add a profile'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputprofile = array(
								'id' => 'profile',
								'name' => 'profile',
								'class' => 'form-control',
								'placeholder' => 'Perfil');
								echo form_input($inputprofile, set_value('profile', $profile->profile)); ?>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputDescription = array(
								'id' => 'description',
								'name' => 'description',
								'class' => 'form-control',
								'placeholder' => 'Descripción');
								echo form_input($inputDescription, set_value('description', $profile->description)); ?>
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
