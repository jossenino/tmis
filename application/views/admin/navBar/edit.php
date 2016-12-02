<h3><?php echo empty($navBar->id) ? 'Add a new navBar' : 'Edit navBar ' . $navBar->nombreNavBar; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/navBar/edit', '<i class="fa fa-plus"></i> Add a navBar'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<span class="fa fa-page form-control-feedback"></span>
								<?php echo form_dropdown('idMenuSubMenu', $pages_no_parents, $this->input->post('idMenuSubMenu') ? $this->input->post('idMenuSubMenu') : $navBar->idMenuSubMenu); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<span class="fa fa-external-link form-control-feedback"></span>
							<?php 
								$inputUrl = array(
								'id' => 'url',
								'name' => 'url',
								'class' => 'form-control',
								'placeholder' => 'Ruta');
								echo form_input($inputUrl, set_value('url', $navBar->url)); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<span class="fa fa-pencil form-control-feedback"></span>
							<?php 
								$inputnombreNavBar = array(
								'id' => 'nombreNavBar',
								'name' => 'nombreNavBar',
								'class' => 'form-control',
								'placeholder' => 'Nombre opción');
								echo form_input($inputnombreNavBar, set_value('nombreNavBar', $navBar->nombreNavBar)); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<span class="fa fa-dot-circle-o form-control-feedback"></span>
							<?php 
								$inputiconClass = array(
								'id' => 'iconClass',
								'name' => 'iconClass',
								'class' => 'form-control',
								'placeholder' => 'Clase css de la opción');
								echo form_input($inputiconClass, set_value('iconClass', $navBar->iconClass)); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<span class="fa fa-sort-numeric-asc form-control-feedback"></span>
							<?php 
								$inputorder = array(
								'id' => 'order',
								'name' => 'order',
								'class' => 'form-control',
								'placeholder' => 'Nro de orden');
								echo form_input($inputorder, set_value('order', $navBar->order)); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array(
									'Seleccionar' => 'Seleccione una opción',
							        '1'         => 'Si',
							        '0'           => 'No',
								);
								$inputDropdown = array(
								'id' => 'dropdown',
								'class' => 'form-control');
								echo form_dropdown('dropdown', $options, set_value('dropdown',$navBar->dropdown), $inputDropdown); ?>
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
								echo form_dropdown('status', $options, set_value('status',$navBar->status), $inputProfile); ?>
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
                 <div class="row">
                  	
                 </div><!-- /.row -->
              </div>
     		</div><!-- /.box -->
     		<?php echo form_close();?>
     		
		</div>
	</div>
