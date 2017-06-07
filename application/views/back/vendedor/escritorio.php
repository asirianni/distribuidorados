<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Distribuidores</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/dist/css/skins/skin-red-light.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
  <?php
    echo $css;
  ?>
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

  <?php echo $header?>
  <?php echo $menu?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escritorio
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-desktop"></i> Escritorio</a></li>
        <!--<li class="active">Dashboard</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php
            // lista colores para los modulos
            $colores = Array("red","green","aqua","yellow","fuchsia","orange");
            $indice = 0;
        ?>
        <div class="col-md-12">
            <?php if($permiso_productos){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>PRODUCTOS</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cube"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_listado" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($permiso_clientes){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>CLIENTES</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_clientes" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($permiso_facturacion){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>FACTURACION</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calculator"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/facturacion" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($permiso_reportes){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>REPORTES</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/reporte_de_pedidos" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($permiso_pedidos){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>PEDIDOS</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-edit"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($permiso_compras){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>COMPRAS</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/factura_compra" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($indice >= count($colores)){$indice=0;}?>
            <?php if($permiso_estados_cuentas){?>
            <div class="col-md-4">
                <div class="small-box bg-<?php echo $colores[$indice];$indice++;?>">
                    <div class="inner">
                      <h3>Estado de Ctas</h3>

                      <p></p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/estados_de_cuentas" class="small-box-footer">Ir a la seccion <i class="fa fa-arrow-circle-right"></i></a>
                 </div>
            </div>
            <?php } ?>
            <?php if($indice >= count($colores)){$indice=0;}?>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php echo $footer?>

  <?php echo $menu_configuracion?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>recursos/plugins/jQuery/jquery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>recursos/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url()?>recursos/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>recursos/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url()?>recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()?>recursos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>recursos/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url()?>recursos/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url()?>recursos/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url()?>recursos/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>recursos/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>recursos/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>recursos/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>recursos/dist/js/demo.js"></script>

<?php
    echo $js;
?>
</body>
</html>


