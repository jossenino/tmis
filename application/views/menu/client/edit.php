<h3><?php echo empty($client->id) ? 'Add a new client' : 'Edit client ' . $client->clientName; ?></h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/client/edit', '<i class="fa fa-plus"></i> Add a client'); ?></h3>
              </div>
              <div class="box-body">
				<section>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputclientName = array(
								'id' => 'clientName',
								'name' => 'clientName',
								'class' => 'form-control',
								'placeholder' => 'Nombre cliente');
								echo form_input($inputclientName, set_value('clientName', $client->clientName)); ?>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
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
								echo form_dropdown('idUsers', $options, set_value('idUsers',$client->idUsers), $inputTurn); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputclass = array(
								'id' => 'class',
								'name' => 'class',
								'class' => 'form-control',
								'placeholder' => 'Tipo cliente');
								echo form_input($inputclass, set_value('class', $client->class)); ?>
								<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$options = array(
							        'CI'         => 'C.I.',
							        'RIF.'           => 'R.I.F',
							        'RUT'         => 'R.U.N',
							        'RUN'        => 'R.U.T',
								);
								$inputtypeDocument = array(
								'id' => 'typeDocument',
								'name' => 'typeDocument',
								'class' => 'form-control',
								'placeholder' => 'Tipo de documento');
								echo form_dropdown('typeDocument', $options, 'CI', $inputtypeDocument, set_value('typeDocument', $client->class)); ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputnumberDocument = array(
								'id' => 'numberDocument',
								'name' => 'numberDocument',
								'class' => 'form-control',
								'placeholder' => 'Nro. documento');
								echo form_input($inputnumberDocument, set_value('class', $client->numberDocument)); ?>
								<span class="fa fa-newspaper-o form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputphone = array(
								'id' => 'phone',
								'name' => 'phone',
								'class' => 'form-control',
								'placeholder' => 'Teléfono');
								echo form_input($inputphone, set_value('phone', $client->phone)); ?>
								<span class="fa fa-phone form-control-feedback"></span>
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
								echo form_input($inputEmail, set_value('email', $client->email)); ?>
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array();
								if(count($countrys)) {
									$options[""] = "Seleccione un país";
									foreach($countrys as $country) {
										$options[$country->id] = $country->country;
									}
								}

								$inputTurn = array(
								'id' => 'country',
								'name' => 'country',
								'class' => 'form-control');
								echo form_dropdown('country', $options, set_value('country',$client->country), $inputTurn); ?>
						</div>
					</div>			
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<select id="state" name="state" class="form-control">
					            <option value="">Seleccione una Región</option>
					        </select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<select id="city" name="city" class="form-control">
					            <option value="">Seleccione una comuna</option>
					        </select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group has-feedback">
							<?php 
								$inputdirection = array(
								'id' => 'direction',
								'name' => 'direction',
								'class' => 'form-control',
								'placeholder' => 'Dirección');
								echo form_input($inputdirection, set_value('email', $client->direction)); ?>
								<span class="fa fa-map form-control-feedback"></span>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<?php 
								$options = array();
								if(count($users)) {
									$options['all'] = 'Seleccione su abogado';
									foreach($users as $user) {
										$options[$user->idUsers] = $user->userName;
									}
								}

								$inputTurn = array(
								'id' => 'lawyer',
								'name' => 'lawyer',
								'class' => 'form-control');
								echo form_dropdown('lawyer', $options, set_value('lawyer',$client->lawyer), $inputTurn); ?>
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
								echo form_dropdown('status', $options, set_value('status',$client->status), $inputStatus); ?>
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
	
	<script type="text/javascript">
		$('#country').change(function(){
		    var country_id = $('#country').val();
		    var url = "<?php echo base_url('index.php/menu/client/getRegion//') ?>";
		    if (country_id != ""){
		        var post_url = url + "/" + country_id;
		        $.ajax({
		            type: "POST",
		            url: post_url,
		            success: function(result) //we're calling the response json array 'cities'
		            {
		               var html = jQuery.parseJSON(result);
			           $("#state").html(html.access);
		            } //end success
		         }); //end AJAX
		    } else {
		        $('#state').empty();
		    }//end if
		}); //end change

		$('#state').change(function(){
		    var region_id = $('#state').val();
		    var url = "<?php echo base_url('index.php/menu/client/getComunas/') ?>";
		    if (region_id != ""){
		        var post_url = url + "/" + region_id;
		        $.ajax({
		            type: "POST",
		            url: post_url,
		            success: function(result) //we're calling the response json array 'cities'
		            {
		               var html = jQuery.parseJSON(result);
			           $("#city").html(html.access);
		            } //end success
		         }); //end AJAX
		    } else {
		        $('#city').empty();
		    }//end if
		}); //end change
	</script>
