    <!--<ol class="breadcrumb">
        <li><a href="<?php //echo base_url() ?>menu/calendar">Calendario</a></li>
        <li><a href="<?php //echo base_url() ?>menu/events">Añadir evento</a></li>
    </ol>-->
    <div class="row">
    <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>
        <div class="col-sm-8 col-sm-offset-2">
            <?php echo form_open(base_url('index.php/menu/events/save')) ?>
               <div class='col-md-6'>
                    <div class="form-group">
                        <div class='input-group date' id='from'>
                            <input type='text' name="from" class="form-control" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class="form-group">
                        <div class='input-group date' id='to'>
                            <input type='text' name="to" class="form-control" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-12 control-label">Enlace al evento</label>
                    <div class="col-sm-12">
                      <input type="url" name="url" class="form-control" id="url" placeholder="Introduce una url o no :)">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 control-label">Tipo de evento</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="class">
                            <option value="event-info">Información</option>
                            <option value="event-success">Correcto</option>
                            <option value="event-inverse">Invertido</option>
                            <option value="event-important">Importante</option>
                            <option value="event-warning">Advertencia</option>
                            <option value="event-special">Especial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-12 control-label">Título</label>
                    <div class="col-sm-12">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Introduce un título">
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-12 control-label">Evento</label>
                    <div class="col-sm-12">
                      <textarea id="body" name="event" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                 <input style="margin-top: 10px" type="submit" class="pull-right btn btn-success" value="Gurdar evento">
                <?php echo form_close() ?>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            $('#to').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            
        });
    </script>