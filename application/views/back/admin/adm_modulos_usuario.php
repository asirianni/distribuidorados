<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nutrilog</title>
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
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/dist/css/skins/skin-yellow-light.min.css">
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
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

  <?php echo $header?>
  <?php echo $menu?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $usuario["usuario"]?>
        <small>Modulos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>MENU DE NAVEGACION</a></li>
        <li class="active">ABM USUARIOS</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url()?>index.php/Administrador/abm_usuarios" class="btn btn-warning pull-right" ><i class='fa fa-arrow-left'></i> Volver al listado</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_modulos_usuario" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Registro</th>
                        <th>Activo</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpo_tabla_modulos_usuario">
                        <?php 
                            foreach($modulos_existentes as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id_modulo"]."</td>
                                    <td>".$value["desc_modulo"]."</td>
                                    <td>
                                        <button class='btn btn-success' id='boton_modulo_".$value["id_modulo"]."' onClick='activar_desactivar_modulo(".$value["id_modulo"].",".$id_usuario.")'>Activo</button>
                                    </td>
                                </tr>";
                            }
                            
                            foreach($modulos_faltantes as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id"]."</td>
                                    <td>".$value["modulo"]."</td>
                                    <td>
                                        <button class='btn btn-danger' id='boton_modulo_".$value["id"]."' onClick='activar_desactivar_modulo(".$value["id"].",".$id_usuario.")'>No Activo</button>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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
<!--<script src="<?php echo base_url()?>recursos/plugins/morris/morris.min.js"></script>-->
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
<!--<script src="<?php echo base_url()?>recursos/dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>recursos/dist/js/demo.js"></script>
<!--FUNCIONES GLOBALES -->
<script src="<?php echo base_url()?>recursos/js/global.js"></script>
<?php
    echo $js;
?>


<!-- PERTENECIENTE A ABM_USUARIOS-->

<script>
   function activar_desactivar_modulo(id_modulo,id_usuario)
   {
       var texto_activo="Activo";
       var texto_no_activo="No Activo";
       
       var texto_actual= $("#boton_modulo_"+id_modulo).text();
       
       if(texto_actual == texto_activo) // DESACTIVAR EL MODULO
       {
           $.ajax({
                url: "<?php echo base_url()?>index.php/Administrador/desactivar_modulo_usuario",
                type: "POST",
                data:{id_modulo:id_modulo,id_usuario:id_usuario},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        $("#boton_modulo_"+id_modulo).removeClass("btn-success");
                        $("#boton_modulo_"+id_modulo).addClass("btn-danger");
                        $("#boton_modulo_"+id_modulo).text(texto_no_activo);
                    }
                },
                error: function(event){alert(event.responseText);},
            });    
           
       }
       else if(texto_actual == texto_no_activo) // ACTIVAR EL MODULO
       {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Administrador/activar_modulo_usuario",
                type: "POST",
                data:{id_modulo:id_modulo,id_usuario:id_usuario},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                       $("#boton_modulo_"+id_modulo).removeClass("btn-danger");
                       $("#boton_modulo_"+id_modulo).addClass("btn-success");
                       $("#boton_modulo_"+id_modulo).text(texto_activo);
                    }
                },
                error: function(event){alert(event.responseText);},
            });    
           
       }
      
   }
      $(function () {
        
        $('#tabla_modulos_usuario').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
</body>
</html>


