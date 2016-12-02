<h3><?php echo empty($turns->idTurn) ? 'Add a new turns' : 'Edit turns ' . $turns->turn; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/turns/edit', '<i class="glyphicon glyphicon-plus"></i> Add a turns'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputturns = array(
								'id' => 'turns',
								'name' => 'turns',
								'class' => 'form-control',
								'placeholder' => 'Perfil');
								echo form_input($inputturns, set_value('turns', $turns->turn)); ?>
								<span class="glyphicon glyphicon-time form-control-feedback"></span>
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
								echo form_input($inputDescription, set_value('description', $turns->typeTurn)); ?>
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
