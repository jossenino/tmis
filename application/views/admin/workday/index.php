
	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/workday/edit', '<i class="fa fa-plus"></i> Add a jornadas'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table id="workday" class="table table-striped">
						<thead>
							<tr>
								<th>Jornada</th>
								<th>Tipo jornada</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($workdays)): foreach($workdays as $workday): ?>	
						<tr>
							<td> <?php echo anchor('admin/workday/edit/' . $workday->idWorkday, $workday->workday); ?></td>
							<td><?php echo anchor('admin/workday/edit/' . $workday->idWorkday, $workday->typeWorkday); ?></td>
							<td><?php echo btn_edit('admin/workday/edit/' . $workday->idWorkday); ?>
								<?php echo btn_delete('admin/workday/delete/' . $workday->idWorkday);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3">We could not find any workdays.</td>
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
			        $("#workday").dataTable({
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