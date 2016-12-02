   <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <strong>Copyright &copy; 2015-2016 <a href="#">TMIS</a>.</strong> Todos los derechos reservados.
        </div><!-- /.container -->
    </footer>
   </div><!-- ./wrapper -->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <!-- Selected2 -->
    <script src="<?php echo base_url('plugins/select2/select2.full.min.js'); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('dist/js/app.min.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('dist/js/demo.js'); ?>"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('.btn').tooltip();
        $("select[name=usersEmail]").change(function(){
              $('#emailUser').val($(this).val());
               $('#showUser-modal').modal('hide'); 
          });
      });            

      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });

      function showModalEmail() {
        $('#sendEmail-modal').modal('show'); 
        $('#emailTitle').val(''); 
        $('#emailUser').val(''); 
        $('#emailText').val(''); 
      }

      function showUser(){
        $('#showUser-modal').modal('show'); 
      }
      
      function sendEmail() {
        var urlController = "<?php echo base_url('index.php/admin/events/EventsEmail/sendEmailNormaly/') ?>";
        var emailTitle = $('#emailTitle').val(); 
        var emailUser = $('#emailUser').val(); 
        var emailText = $('#emailText').val(); 
        var error = validations(emailTitle, emailText, emailUser);
        if (error == 1) {
          $.ajax({
               type: "POST",
               url: urlController + "/",
               data: {
                      emailTitle: emailTitle,
                      emailUser : emailUser,
                      emailText : emailText
                     },
               success: function(result){
                  var html = jQuery.parseJSON(result);
                     if (html.access == true) {
                       alert("Your Email has been sent successfully... !!");
                       $('#sendEmail-modal').modal('hide');
                     }
                   }
             });
        }
        else{
          alert("No se han ingresado todos los datos para enviar el correo. Por favor verifique e intente de nuevo");
        }
      }

      function validations(emailTitle, emailText, emailUser){
        var validation = 0;
        if (emailText == "") {
          validation = 0;
        }
        if (emailUser == "") {
          validation = 0;
        }
        if (emailTitle == "") {
          validation = 0;
        }
        else{
          validation = 1;
        }
        return validation;
      }
    </script>
    
</body>
</html>