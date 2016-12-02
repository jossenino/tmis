	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('menu/clientSchedule/edit', '<i class="fa fa-plus"></i> Nuevo Cronograma'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table class="table table-striped" id="schedules">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Fecha inicio</th>
								<th>Fecha culminación</th>
								<th>Documento</th>
								<th>Horas trabajadas</th>
								<th>Pago realizado</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($schedules)): foreach($schedules as $schedule): ?>	
						<tr>
							<td> <?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, $schedule->idClient); ?></td>
							<td><?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, $schedule->startDate); ?></td>
							<td><?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, $schedule->endDate); ?></td>
							<td><?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, $schedule->documento); ?></td>
							<td><?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, $schedule->hourValue); ?></td>
							<td><?php echo anchor('menu/clientSchedule/edit/' . $schedule->id, number_format($schedule->total, 0, '', '.')); ?></td>
							
							<td><?php echo btn_edit('menu/clientSchedule/edit/' . $schedule->id); ?>
								<?php echo btn_delete('menu/clientSchedule/delete/' . $schedule->id);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3"><label class="label label-danger">We could not find any schedule.</label></td>
									</tr>
							<?php endif; ?>	
						</tbody>
					</table>
				</div>
              </div><!-- /.box-body -->
              <div class="box-footer primary">
                  <div class="row">
                  </div><!-- /.row -->
                </div>
            </div><!-- /.box -->
            <script type="text/javascript">
            	$(function () {
		        $("#schedules").dataTable({
			          "bPaginate": true,
			          "bLengthChange": false,
			          "bFilter": false,
			          "bSort": true,
			          "bInfo": true,
			          "bAutoWidth": false,
			          "language": {
				            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				        }
			        });
		      });
            </script>