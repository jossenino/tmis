
	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/turns/edit', '<i class="fa fa-plus"></i> Add a turns'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table id="turns" class="table table-striped">
						<thead>
							<tr>
								<th>Turno</th>
								<th>Descripción</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($turns)): foreach($turns as $turn): ?>	
						<tr>
							<td> <?php echo anchor('admin/turns/edit/' . $turn->idTurn, $turn->turn); ?></td>
							<td><?php echo anchor('admin/turns/edit/' . $turn->idTurn, $turn->typeTurn); ?></td>
							<td><?php echo btn_edit('admin/turns/edit/' . $turn->idTurn); ?>
								<?php echo btn_delete('admin/turns/delete/' . $turn->idTurn);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3">We could not find any turnss.</td>
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
			        $("#turns").dataTable({
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