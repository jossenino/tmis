
	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/user/edit', '<i class="fa fa-plus"></i> Añadir usuario'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table id="users" class="table table-striped">
						<thead>
							<tr>
								<th>Nombre usuario</th>
								<th>Correo electrónico</th>
								<th> Compañia </th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($users)): foreach($users as $user): ?>	
						<tr>
							<td> <?php echo anchor('admin/user/edit/' . $user->idUsers, $user->userName); ?></td>
							<td><?php echo anchor('admin/user/edit/' . $user->idUsers, $user->email); ?></td>
							<td><?php echo anchor('admin/user/edit/' . $user->idUsers, $user->idCompany); ?></td>
							<td><?php echo btn_edit('admin/user/edit/' . $user->idUsers); ?>
								<?php echo btn_popup('admin/user/profiles_popup/' . $user->idUsers,"","showpermissions(".$user->idUsers.")");?>
								<?php echo btn_delete('admin/user/delete/' . $user->idUsers);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3">We could not find any users.</td>
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

            <!--ventana modal para los permisos-->
			<div class="modal fade" id="permission-modal">
			    <div class="modal-dialog">
				    <div class="modal-content">
				        <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title">Accesos autorizados</h4>
				        </div>
					    <div class="modal-body" style="height: 400px">
					        <p id="permisosUsuarios"></p>					        
					    </div>
				        <div class="modal-footer">
					        <button type="button" class="btn btn-success">Ok</button>
				        </div>
				    </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

            <script type="text/javascript">
            	function showpermissions(idUsers){
            		var idUsuario = idUsers;
            		var urlController = "<?php echo base_url('index.php/admin/user/profiles_popup/') ?>";
            		$.ajax({
				       type: "GET",
				       url: urlController + "/" + idUsuario,
				       success: function(result){
				       		var html = jQuery.parseJSON(result);
				           $("#permisosUsuarios").html(html.access);
				           $('#permission-modal').modal('show') 
				           }
				     });
            	}
            	$(function () {
		        $("#users").dataTable({
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
