<?php $this->load->view('components/page_head_events'); ?>
  <body class="hold-transition skin-blue layout-top-nav">
    <header class="main-header">
     <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url() ?>index.php/dashboard">Home <span class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-bell" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="label label-danger"><?php echo $totalNotifications; ?></span></a>
                    <ul class="dropdown-menu">
                        <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Eventos próximos
                            <span class="label label-warning"><?php echo $eventsCount; ?></span>
                          </a>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Correos recibidos
                            <span class="label label-info"><?php echo $emailCount; ?></span>
                          </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-envelope" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="showModalEmail()">Nuevo correo electrónico</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target=".bs-example-modal-sm"> </a> </li>
                <li><a href="<?php echo base_url() ?>index.php/login/logout" class="glyphicon glyphicon-log-out"> Salir</a></li>
            </ul>
            <?php echo get_menu($menu); ?>
            </div><!-- /.navbar-collapse -->
        </nav>
        </div><!-- /.container-fluid -->
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container" id="content-body">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
              </h1>
              <?php echo $breadcrumbs; ?>
            </section>
            <!-- Main content -->
            <section class="content">
                <?php $this->load->view($subview); ?>
            </section><!-- /.content -->
            <?php if($this->session->flashdata('error')){ ?>
              <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Ups!</strong> <?php echo $this->session->flashdata('error'); ?>
              </div>
            <?php }?>
          </div>
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->

       <!--ventana modal para enviar email-->
  <?php echo form_open('', 'class="form-horizontal"'); ?>
    <div class="modal fade" id="sendEmail-modal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Enviar correo electrónico</h4>
            </div>
          <div class="modal-body">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Título</label>

                    <div class="col-sm-10">
                      <input type="email" name="emailTitle" class="form-control" id="emailTitle" placeholder="Título del correo electrónico">
                    </div>  
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="email" id="emailUser">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-primary btn-flat" data-original-title="Seleccione un usuario del sistema" onclick="showUser()"><i class="fa fa-user"></i></button>
                            </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Asunto</label>

                    <div class="col-sm-10">
                      <textarea type="email" name="emailText" class="form-control" id="emailText" placeholder="Por favor introduzca el mensaje que desea enviar"> </textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4">
                    
                   </div>
                </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="sendEmail()">Enviar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php echo form_close(); ?>


    <div class="modal fade" id="showUser-modal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Enviar correo electrónico</h4>
            </div>
              <div class="modal-body">
                <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                    <label>Minimal</label>
                    <select name="usersEmail" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option selected="selected">Seleccione su abogado</option>
                    <?php 
                      $options = array();
                      if(count($users)) {
                        foreach($users as $user) { ?>
                           <option id="<?php echo $user->idUsers ?>" value="<?php echo $user->email ?>"> <?php echo $user->userName ?></option>
                       <?php }
                      }?>
                      </select><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-ybnz-container"><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="aceptarUser()">Aceptar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php $this->load->view('components/page_tail_events'); ?>