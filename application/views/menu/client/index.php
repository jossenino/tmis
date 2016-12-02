	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('menu/client/edit', '<i class="fa fa-plus"></i> Add a client'); ?></h3>
              </div>
              <div class="box-body no-padding">
              	<div class="table-responsive mailbox-messages">
	                <table class="table table-hover table-striped" id="clients">
						<thead>
							<tr>
								<th>Nombre cliente</th>
								<th>Email</th>
								<th>País</th>
								<th>Estado</th>
								<th>Ciudad</th>
								<th>Dirección</th>
								<th>Estatus</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($clients)): foreach($clients as $client): ?>	
						<tr>
							<td> <?php echo anchor('menu/client/edit/' . $client->id, $client->clientName); ?></td>
							<td><?php echo anchor('menu/client/edit/' . $client->id, $client->email); ?></td>
							<td><?php echo anchor('menu/client/edit/' . $client->id, $client->pais); ?></td>
							<td><?php echo anchor('menu/client/edit/' . $client->id, $client->estado); ?></td>
							<td><?php echo anchor('menu/client/edit/' . $client->id, $client->ciudad); ?></td>
							<td><?php echo anchor('menu/client/edit/' . $client->id, $client->direction); ?></td>
							<?php if ($client->status == 1) {?>
								<td><?php echo anchor('menu/client/edit/' . $client->id, "Activo"); ?></td>
							<?php } 
							else { ?>
								<td><?php echo anchor('menu/client/edit/' . $client->id, "Inactivo"); ?></td>
								<?php } ?>
							
							<td><?php echo btn_edit('menu/client/edit/' . $client->id); ?>
								<?php echo btn_delete('menu/client/delete/' . $client->id);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3"><label class="label label-danger">We could not find any clients.</label></td>
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
		        $("#clients").dataTable({
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