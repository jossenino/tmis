
	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/navBar/edit', '<i class="fa fa-plus"></i> Añadir páginas'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table id="NavBars" class="table table-striped">
						<thead>
							<tr>
								<th>Title</th>
								<th>Pertenece</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($navBars)): foreach($navBars as $navBar): ?>	
						<tr>
							<td> <?php echo anchor('admin/navBar/edit/' . $navBar->id, $navBar->nombreNavBar); ?></td>
							<td> <?php echo $navBar->parent_name; ?></td>
							<td><?php echo btn_edit('admin/navBar/edit/' . $navBar->id); ?>
								<?php echo btn_delete('admin/navBar/delete/' . $navBar->id);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3"><h5><label class="label label-danger"> No se encontraron páginas registradas. </label></h5></td>
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
            <script>				
			      $(function () {
			        $("#NavBars").dataTable({
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