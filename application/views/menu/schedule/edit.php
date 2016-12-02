<h3><?php echo empty($schedules->id) ? 'Add a new schedules' : 'Edit schedules ' . $schedules->clientName; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/schedule/edit', '<i class="fa fa-plus"></i> Add a schedules'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$options = array();
								if(count($clients)) {
									foreach($clients as $client) {
										$options[$client->id] = $client->clientName;
									}
								}

								$inputidClient = array(
								'id' => 'idClient',
								'name' => 'idClient',
								'class' => 'form-control');
								echo form_dropdown('idClient', $options, set_value('idClient',$this->session->userdata('idUsers')), $inputidClient); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array();
								if(count($users)) {
									foreach($users as $user) {
										$options[$user->idUsers] = $user->userName;
									}
								}

								$inputTurn = array(
								'id' => 'idUsers',
								'name' => 'idUsers',
								'readonly' => '',
								'class' => 'form-control');
								echo form_dropdown('idUsers', $options, set_value('idUsers',$schedules->idUsers), $inputTurn); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputstartDate = array(
								'id' => 'startDate',
								'name' => 'startDate',
								'class' => 'form-control',
								'placeholder' => 'Fecha inicio');
								echo form_input($inputstartDate, set_value('startDate', $schedules->startDate)); ?>
								<span class="fa fa-clock-o form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputendDate = array(
								'id' => 'endDate',
								'name' => 'endDate',
								'class' => 'form-control',
								'placeholder' => 'Fecha culminación');
								echo form_input($inputendDate, set_value('endDate', $schedules->endDate)); ?>
								<span class="fa fa-clock-o form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputday = array(
								'id' => 'day',
								'name' => 'day',
								'class' => 'form-control',
								'placeholder' => 'Días trabajados');
								echo form_input($inputday, set_value('day', $schedules->day)); ?>
								<span class="fa fa-calendar form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputhourValue = array(
								'id' => 'hourValue',
								'name' => 'hourValue',
								'class' => 'form-control',
								'placeholder' => 'Horas trabajadas por días');
								echo form_input($inputhourValue, set_value('hourValue', $schedules->hourValue)); ?>
								<span class="fa fa-calendar form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputpay = array(
								'id' => 'pay',
								'name' => 'pay',
								'class' => 'form-control',
								'placeholder' => 'Valor de cada hora');
								echo form_input($inputpay, set_value('pay', $schedules->pay)); ?>
								<span class="fa fa-dollar  form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputpay = array(
								'id' => 'documento',
								'name' => 'documento',
								'class' => 'form-control',
								'placeholder' => 'Documento');
								echo form_input($inputpay, set_value('documento', $schedules->documento)); ?>
								<span class="fa fa-file-word-o form-control-feedback"></span>
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
