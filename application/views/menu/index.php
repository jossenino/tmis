<div class="col-md-9 col-sm-6 col-xs-12">
	<h4>
		<span class="username">
		  <a href="#">Bienvenido <?php echo $this->session->userdata('userName'); ?></a>
		</span>
	<h4>
</div>
<div class="col-md-9 col-sm-6 col-xs-12">
	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Actividades pendientes</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive" style="display: block;">
        	<div class="table-responsive mailbox-messages">
	        	<table id="events" class="table table-striped">
					<thead>
						<tr>
							<th>Evento</th>
							<th>Fecha inicio</th>
							<th>Fecha termino</th>
							<th> Ver </th>
						</tr>
					</thead>
					<tbody>
						<?php if($events != 'vacio'): foreach($events as $event): ?>	
					<tr>
						<td> <?php echo $event->title; ?> </td>
						<td> <?php echo $event->date; ?> </td>
						<td> <?php echo $event->endDate; ?> </td>
						<td> <?php echo anchor('dashboard/viewModelEvent/' . $event->id, "Ver"); ?> </td>
					</tr>
						<?php endforeach; ?>
						<?php else: ?>
								<tr>
									<td colspan="3"><label class="label label-danger"> No posee eventos registrados. </label></td>
								</tr>
						<?php endif; ?>	
					</tbody>
				</table>
			</div>
        </div>
        <!-- /.box-body -->
      </div>
</div>
<div class="col-lg-3 col-xs-6">
	<div class="col-lg-12 col-xs-12">
	  <!-- small box -->
	  <div class="small-box bg-green">
	    <div class="inner">
	      <h3><?php echo $clientsByUser ?></h3>

	      <p>Clientes registrados</p>
	    </div>
	    <div class="icon">
	      <i class="ion ion-person-add"></i>
	    </div>
	    <a href="<?php echo base_url('index.php/menu/client/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<div class="col-lg-12 col-xs-12">
	  <!-- small box -->
	  <div class="small-box bg-blue">
	    <div class="inner">
	      <h3><?php echo $emailCount ?></h3>

	      <p>Correos no leidos</p>
	    </div>
	    <div class="icon">
	      <i class="fa fa-envelope-o"></i>
	    </div>
	    <a href="<?php echo base_url('index.php/menu/inbox/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<div class="col-lg-12 col-xs-12">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
	    <div class="inner">
	      <h3><?php echo $scheduleByUser ?></h3>

	      <p>Pago realizados en el mes</p>
	    </div>
	    <div class="icon">
	      <i class="fa fa-envelope-o"></i>
	    </div>
	    <a href="<?php echo base_url('index.php/menu/clientSchedule/') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
</div>
<!--ventana modal para el calendario-->
		<div class="modal fade" id="eventos">
		    <div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Evento</h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
				        <?php foreach($modelEvents as $modelEvent): ?>
				        	<div class="content-body">
				        		<label class="label label-info"> <?php echo $modelEvent->title; ?> </label>
				        		<hr>
				        		<div>
				        			<?php echo $modelEvent->body; ?> <br>
				        			<b>Fecha inicio:</b> <label class="label label-info"> <?php echo $modelEvent->startDay;?> </label><br>
				        			<b>Fecha fin:</b> <label class="label label-info"><?php echo $modelEvent->startDay; ?> </label><br>
				        		</div>
				        	</div>	
						<?php echo "<script type='text/javascript'>$('#eventos').modal('show');</script>";?>
						<?php endforeach; ?>		        
				    </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<script type="text/javascript">
        	$(function () {
	        $("#events").dataTable({
		          "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": true,
		          "bInfo": true,
		          "bAutoWidth": false,
		          "pageLength": 5,
		          "language": {
			            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			        }
		        });
	      });

        	$(function () {
	        $("#emails").dataTable({
		          "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": true,
		          "bInfo": true,
		          "bAutoWidth": false,
		          "pageLength": 5,
		          "language": {
			            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			        }
		        });
	      });
        </script>
		