<h3><?php echo empty($workdays->idTurn) ? 'Add a new workdays' : 'Edit workdays ' . $workdays->turn; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/workday/edit', '<i class="glyphicon glyphicon-plus"></i> Add a workdays'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputworkdays = array(
								'id' => 'workday',
								'name' => 'workday',
								'class' => 'form-control',
								'placeholder' => 'Jornada');
								echo form_input($inputworkdays, set_value('workday', $workdays->workday)); ?>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$options = array(
									'Seleccionar' => 'Seleccione un tipo de jornada',
							        'Semanal'         => 'Semanal',
							        'Mensual'           => 'Mensual',
							        'Intermedia'         => 'Intermedia',
								);
								$inputTypeWorkday = array(
								'id' => 'typeWorkday',
								'name' => 'typeWorkday',
								'class' => 'form-control');
								echo form_dropdown('typeWorkday', $options, set_value('typeWorkday',$workdays->typeWorkday), $inputTypeWorkday); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array();
								if(count($turns)) {
									foreach($turns as $turn) {
										$options[$turn->idTurn] = $turn->turn;
									}
								}

								$inputTurn = array(
								'id' => 'idTurn',
								'name' => 'idTurn',
								'class' => 'form-control');
								echo form_dropdown('idTurn', $options, set_value('idTurn',$workdays->idTurn), $inputTurn); ?>
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
								$inputStatus = array(
								'id' => 'status',
								'name' => 'status',
								'class' => 'form-control');
								echo form_dropdown('status', $options, set_value('status',$workdays->status), $inputStatus); ?>
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
