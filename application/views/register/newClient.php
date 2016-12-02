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
	<?php echo form_open('register/registerNewClientSave','class="form-register"'); ?>
	<div class="row">
		<!--<hr class="style-three">-->
	    <h3 class="form-signin-heading">Registrando nuevo cliente</h3>
	    <div class="col-sm-6" >
			<div class="form-group has-feedback">
	        	<input type="text" class="form-control" placeholder="Nombre Cliente" name="clientName">
	        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
	    	</div>
	    </div>
	    <div class="col-sm-6" >
			<div class="form-group has-feedback">
	        	<input type="text" class="form-control" placeholder="Tipo Cliente" name="class">
	        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
	    	</div>
	    </div>
	    <div class="col-sm-6" >
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
		<div class="col-sm-6" >
			<div class="form-group has-feedback">
            	<input type="text" class="form-control" placeholder="Número documento" name="numberDocument">
            	<span class="glyphicon glyphicon-list form-control-feedback"></span>
        	</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group has-feedback">
            	<input type="text" class="form-control" placeholder="Teléfono" name="phone">
            	<span class="glyphicon glyphicon-phone form-control-feedback"></span>
        	</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group has-feedback">
            	<input type="email" class="form-control" placeholder="Email" name="email">
            	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        	</div>
		</div>
		<div class="col-sm-6" >
			<div class="form-group">
				<?php 
					$options = array();
					if(count($countrys)) {
						foreach($countrys as $country) {
							$options[$country->country] = $country->country;
						}
					}

					$inputTurn = array(
					'id' => 'country',
					'name' => 'country',
					'class' => 'form-control');
					echo form_dropdown('country', $options, set_value('country',$client->country), $inputTurn); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<?php 
					$options = array();
					if(count($states)) {
						foreach($states as $state) {
							$options[$state->state] = $state->state;
						}
					}

					$inputState = array(
					'id' => 'state',
					'name' => 'state',
					'class' => 'form-control');
					echo form_dropdown('state', $options, set_value('state',$client->state), $inputState); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<?php 
					$options = array();
					if(count($citys)) {
						foreach($citys as $city) {
							$options[$city->city] = $city->city;
						}
					}

					$inputCity = array(
					'id' => 'city',
					'name' => 'city',
					'class' => 'form-control');
					echo form_dropdown('city', $options, set_value('city',$client->city), $inputCity); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group has-feedback">
				<?php 
					$inputdirection = array(
					'id' => 'direction',
					'name' => 'direction',
					'class' => 'form-control',
					'placeholder' => 'Dirección');
					echo form_input($inputdirection, set_value('email', $client->direction)); ?>
			</div>
		</div>
		<div class="col-sm-6">
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
	</div>
	<section>
		<div class="row ">
			<div class="col-xs-6">
				<?php echo form_submit('submit', 'Registrar', 'class="btn btn-primary col-sm-12"'); ?>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-default col-sm-12" onclick="<?php echo base_url('index.php/login') ?>" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</section>
	<?php echo form_close(); ?>