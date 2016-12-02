<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Bandeja de entrada</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table id="emails" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Importancia</th>
                      <th>Email</th>
                      <th>Título</th>
                      <th>Fecha</th>
                    </tr>
                </thead>
                  <tbody>
                  <?php if(count($emails)): foreach($emails as $email): ?>
                  <tr>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.html"><?php echo $email->email ?></a></td>
                    <td class="mailbox-subject"><b><?php echo $email->title ?></b> - <?php echo substr($email->body, 0, 15) ?>...
                    </td>
                    <td class="mailbox-date"><?php  echo date('d-m-Y')  - $email->dateSend;?> días </td>
                  </tr>
                  <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                          <td colspan="3"><label class="label label-danger">We could not find any emails.</label></td>
                        </tr>
                    <?php endif; ?> 

                    <!--

                    <tr>
                    <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                    <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">5 mins ago</td>
                  </tr>

                    -->
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
            </div>
          </div>

          <script type="text/javascript">
              $(function () {
            $("#emails").dataTable({
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