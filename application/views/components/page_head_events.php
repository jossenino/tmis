<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $meta_title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
     <!-- Bootstrap 3.3.5 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css'); ?>">
    <!-- Afdeling CSS -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/Style.css'); ?>">
    <!--FullCalendar -->
    <link href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.min.css' rel='stylesheet' />
    <link href='//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.print.css' rel='stylesheet' media='print' />

    <!--DatetimePicker-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2/select2.min.css'); ?>">
    <!--ColorPicker-->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <!--TimePicker-->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap-timepicker.min.css" rel="stylesheet" />
   <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- FullCalendar -->
    <script src="<?php echo base_url('js/moment.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.1/fullcalendar.min.js"></script>

    <script src='<?php echo base_url();?>js/bootstrap-colorpicker.min.js'></script>
    <script src='<?php echo base_url();?>js/bootstrap-timepicker.min.js'></script>
    <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/d004434a5ff76e7b97c8b07c01f34ca69e635d97/src/js/bootstrap-datetimepicker.js"></script>
    <script src='<?php echo base_url();?>bootstrap/js/bootstrap-datetimepicker.es.js'></script>
    <script src='<?php echo base_url();?>js/main.js'></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body{background-color:#f3f3f4;
        }
        #content-body{ border-radius: 10px;}

        #trash{
            float:left;
            position: relative;
        }

        .fc th {
            padding: 10px 0px;
            vertical-align: middle;
            background:#F2F2F2;
        }
        .fc-day-grid-event>.fc-content {
            padding: 4px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .error {
            color: #ac2925;
            margin-bottom: 15px;
        }
        .event-tooltip {
            width:150px;
            background: rgba(0, 0, 0, 0.85);
            color:#FFF;
            padding:10px;
            position:absolute;
            z-index:10001;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;

        }
        .modal-header
        {
            background-color: #3A87AD;
            color: #fff;
        } 
    </style>
  </head>