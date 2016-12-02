	 <div >
		<div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Opcciones de eventos</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
              	<button class="btn btn-block btn-primary btn-sm" data-toggle='modal' onclick="addEvent()">Añadir evento</button>
                <button id="trash" class="btn btn-block btn-danger btn-sm" data-toggle='modal'> Eliminar </button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div style="padding:10px;">
              	<div id="calendar"></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->

		<!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal">
		    <div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Evento</h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
				        <p>One fine body&hellip;</p>
				    </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!--ventana modal para añadir eventos-->
		<div class="modal fade" id="addevents">
		    <div class="modal-dialog">
			    <div class="modal-content">
				    <?php if (validation_errors()){?>
				    <div class="alert alert-danger">
					    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo validation_errors(); ?>
					    </div>
					 <?php } ?>
			            <?php echo form_open(base_url('index.php/menu/calendar/save'),'class="form-horizontal"'); ?>
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Añadir un nuevo evento</h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="title">Título</label>
                                <div class="col-md-4">
                                    <input id="title2" name="title" type="text" class="form-control input-md" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="time">Fecha inicio</label>
                                <div class="col-md-4 input-append">
                                    <input id="startDate" name="startDate" type="text" class="form-control input-md" data-date-format="YYYY-MM-DD HH:mm" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="time">Fecha fin</label>
                                <div class="col-md-4 input-append ">
                                    <input type='text' class="form-control" name="finalDate" id='finalDate' data-date-format="YYYY-MM-DD HH:mm" />
                                </div>
                            </div>
                            <div class="form-group">
			                    <label class="col-sm-4 control-label">Tipo de evento</label>
			                    <div class="col-sm-4">
			                        <select class="form-control" name="typeEvent">
			                        	<option value="Información">Información</option>
			                        	<option value="Reunión">Reunión</option>
			                            <option value="Recordatorio">Recordatorio</option>
			                            <option value="Correcto">Correcto</option>
			                            <option value="Importante">Importante</option>
			                            <option value="Advertencia">Advertencia</option>
			                            <option value="Especial">Especial</option>
			                        </select>
			                    </div>
			                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="description">Descripción</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="description2" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
			                    <label for="url" class="col-sm-4 control-label">Enlace al evento</label>
			                    <div class="col-sm-4">
			                      <input type="url" name="url" class="form-control" id="url2" placeholder="Introduce una url o no :)">
			                    </div>
			                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="color">Color</label>
                                <div class="col-md-4">
                                    <input id="color2" name="color2" type="text" class="form-control input-md" readonly="readonly" />
                                    <span class="help-block">Click to pick a color</span>
                                </div>
                            </div>
                        
				    </div>
			        <div class="modal-footer">
				        <?php echo form_submit('submit', 'Añadir evento', 'class="btn btn-success"'); ?>
			        </div>
			       <?php echo form_close(); ?>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<div class="modal fade" id="modalCalendar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <?php echo form_open('','class="form-horizontal" id="crud-form"'); ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="title">Título</label>
                                <div class="col-md-4">
                                    <input id="title" name="title" type="text" class="form-control input-md" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="time">Fecha inicio</label>
                                <div class="col-md-4 input-append bootstrap-timepicker">
                                    <input id="time" name="date" type="text" class="form-control input-md" data-date-format="YYYY-MM-DD HH:mm" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="time">Fecha fin</label>
                                <div class="col-md-4 input-append bootstrap-timepicker">
                                    <input type='text' class="form-control" id='endDate' data-date-format="YYYY-MM-DD HH:mm" />
                                </div>
                            </div>
                            <div class="form-group">
			                    <label class="col-sm-4 control-label">Tipo de evento</label>
			                    <div class="col-sm-4">
			                        <select class="form-control" name="typeEvent">
			                        	<option value="Información">Información</option>
			                        	<option value="Reunión">Reunión</option>
			                            <option value="Recordatorio">Recordatorio</option>
			                            <option value="Correcto">Correcto</option>
			                            <option value="Importante">Importante</option>
			                            <option value="Advertencia">Advertencia</option>
			                            <option value="Especial">Especial</option>
			                        </select>
			                    </div>
			                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="description">Descripción</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
			                    <label for="url" class="col-sm-4 control-label">Enlace al evento</label>
			                    <div class="col-sm-4">
			                      <input type="url" name="url" class="form-control" id="url" placeholder="Introduce una url o no :)">
			                    </div>
			                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="color">Color</label>
                                <div class="col-md-4">
                                    <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                                    <span class="help-block">Click to pick a color</span>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="modal-footer" id="Calendarmodal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>



	</div>
	<script type="text/javascript">
		$('#endDate').datetimepicker({
	            locale: 'es',
	            minDate: new Date(),
	        });
		$('#startDate').datetimepicker({
	            locale: 'es',
	            minDate: new Date()
	        });
		$('#finalDate').datetimepicker({
	            locale: 'es',
	            minDate: new Date()
	        });
	    //DateTimepicker
		function addEvent(){
			$('#addevents').modal('show');
		}
	</script>