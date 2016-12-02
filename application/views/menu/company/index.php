	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('menu/company/edit', '<i class="fa fa-plus"></i> Add a company'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table class="table table-striped" id="companys">
						<thead>
							<tr>
								<th>Nombre empresa</th>
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
							<?php if(count($companys)): foreach($companys as $company): ?>	
						<tr>
							<td> <?php echo anchor('menu/company/edit/' . $company->id, $company->companyName); ?></td>
							<td><?php echo anchor('menu/company/edit/' . $company->id, $company->email); ?></td>
							<td><?php echo anchor('menu/company/edit/' . $company->id, $company->country); ?></td>
							<td><?php echo anchor('menu/company/edit/' . $company->id, $company->state); ?></td>
							<td><?php echo anchor('menu/company/edit/' . $company->id, $company->city); ?></td>
							<td><?php echo anchor('menu/company/edit/' . $company->id, $company->direction); ?></td>
							<?php if ($company->status == 1) {?>
								<td><?php echo anchor('menu/company/edit/' . $company->id, "Activo"); ?></td>
							<?php } 
							else { ?>
								<td><?php echo anchor('menu/company/edit/' . $company->id, "Inactivo"); ?></td>
								<?php } ?>
							
							<td><?php echo btn_edit('menu/company/edit/' . $company->id); ?>
								<?php echo btn_delete('menu/company/delete/' . $company->id);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3"><label class="label label-danger">We could not find any companys.</label></td>
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
		        $("#companys").dataTable({
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