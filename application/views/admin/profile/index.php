
	<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo anchor('admin/profile/edit', '<i class="fa fa-plus"></i> Add a profile'); ?></h3>
              </div>
              <div class="box-body">
              	<div class="table-responsive mailbox-messages">
	                <table id="Profiles" class="table table-striped">
						<thead>
							<tr>
								<th>Perfil</th>
								<th >Descripción</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($profile)): foreach($profile as $profile): ?>	
						<tr>
							<td> <?php echo anchor('admin/profile/edit/' . $profile->idProfile, $profile->description); ?></td>
							<td><?php echo anchor('admin/profile/edit/' . $profile->idProfile, $profile->description); ?></td>
							<td align="center"><?php echo btn_edit('admin/profile/edit/' . $profile->idProfile); ?>
								<?php echo btn_popup('' . $profile->idProfile,"","showpermissions(".$profile->idProfile.")");?>
								<?php echo btn_delete('admin/profile/delete/' . $profile->idProfile);?>
							</td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
									<tr>
										<td colspan="3"><h5><label class="label label-danger"> No se encontraron perfiles  registrados. </label></h5></td>
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
					    <div class="modal-body" style="height: 550px">
					        <p id="permisosUsuarios"></p>			
					        <input type="hidden" id="userProfile" name="country">		        
					    </div>
				        <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <?php echo btn_js("btn btn-primary","Guardar","permissionsSave(".$profile->idProfile.")"); ?>
				        </div>
				    </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

         <script type="text/javascript">
        	function showpermissions(idProfiles){
        		//confirm('Esta a punto de elminar este registro. No se podrá deshacer. Esta seguro?');
        		//if(confirm(confirmText)) {
            		var idProfile = idProfiles;
            		var urlController = "<?php echo base_url('index.php/admin/profile/profiles_popup/') ?>";
            		$.ajax({
				       type: "GET",
				       url: urlController + "/" + idProfile,
				       success: function(result){
				       		var html = jQuery.parseJSON(result);
				           $("#permisosUsuarios").html(html.access);
				           $('#permission-modal').modal('show'); 
				           $('#userProfile').val(idProfiles);
				           }
				     });
            	//}
        	}

        	function permissionsSave(idProfiles){
        		var urlController = "<?php echo base_url('index.php/admin/profile/permissionsSave/') ?>";
        		var idMenu = "";
			    $("input[type=checkbox][name='profilesPermissions']:checked").each(function () {
			        idMenu = idMenu + $(this).val() + "-";
			    })
        		$.ajax({
			       type: "POST",
			       url: urlController + "/" + $('#userProfile').val(),
			       data: {perfiles: idMenu},
			       success: function(result){
			       		var html = jQuery.parseJSON(result);
				           if (html.access == true) {
				           	 alert("Permisos modificados");
				           	 $('#permission-modal').modal('hide')
				           }
			           }
			     });
        	}
        	$(function () {
		        $("#Profiles").dataTable({
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
	      $(function () {
		        $("#ProfilesUsers").dataTable({
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
