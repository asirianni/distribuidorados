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
  
  <?php
    echo $css;
  ?>
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
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
        Ubicaciones
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cube"></i> Stock de productos</a></li>
        <!--<li class="active">Listado</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <button class="btn btn-warning" onClick="$('#modal_agregar_ubicacion').modal('show');"><i class='fa fa-plus'></i> Agregar Ubicacion</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_ubicaciones as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id"]."</td>
                                    <td>".$value["descripcion"]."</td>
                                    <td>
                                        <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' onClick='abrir_modal_editar_rubro(".$value["id"].",&#34;".$value["descripcion"]."&#34;)'><i class='fa fa-edit'></i></button>
                                        <!--<button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Eliminar' onClick='abrir_modal_eliminar_precio_vigente(".$value["id"].")'>X</button>-->
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


<!---->
<div class="modal modal-warning" id="modal_editar_ubicacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar ubicacion:</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_ubicacion_para_editar" hidden="true"/>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_editar_ubicacion">Descripcion: </label>
                        <input class="form-control" type="text" id="descripcion_editar_ubicacion" name="descripcion_editar_ubicacion" value=""/>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="editar_ubicacion()"><i class='fa fa-save'></i> Guardar Cambios</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-warning" id="modal_agregar_ubicacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar una ubicacion:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_agregar_ubicacion">Ubicacion: </label>
                        <input class="form-control" type="text" id="descripcion_agregar_ubicacion" name="descripcion_agregar_ubicacion" value=""/>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="agregar_ubicacion()"><i class='fa fa-save'></i> Guardar Ubicacion</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




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

<script>
    
    function abrir_modal_editar_rubro(id,descripcion)
    {
        $("#id_ubicacion_para_editar").val(id);
        $("#descripcion_editar_ubicacion").val(descripcion);
        $("#modal_editar_ubicacion").modal("show");
    }
    
    function editar_ubicacion()
    {
        var id= $("#id_ubicacion_para_editar").val();
        var descripcion= $("#descripcion_editar_ubicacion").val();
        
        if(descripcion != "" && !isNaN(id))
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_ubicacion",
                type: "POST",
                data:{id_ubicacion:id,descripcion:descripcion},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_ubicaciones";
                    }
                    else
                    {
                        alert("No se ha podido editar");
                    }
                },
                error: function(event){alert(event.responseText);
                },
            });    
        }
        else
        {
            gestiona_errores_editar();
        }
    }
    
   
    function gestiona_errores_editar()
    {
        var descripcion= $("#descripcion_editar_ubicacion").val();
        
        if(descripcion==""){activar_error("descripcion_editar_ubicacion");}
        else{desactivar_error("descripcion_editar_ubicacion");}
    }
    
    function agregar_ubicacion()
    {
        var descripcion= $("#descripcion_agregar_ubicacion").val();
        
        if(descripcion != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_ubicacion",
                type: "POST",
                data:{descripcion:descripcion},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_ubicaciones";
                    }
                    else
                    {
                        alert("No se ha podido agregar");
                    }
                },
                error: function(event){alert(event.responseText);
                },
            });    
        }
        else
        {
            gestiona_errores_agregar();
        }
    }
    
    function gestiona_errores_agregar()
    {
        var descripcion= $("#descripcion_agregar_ubicacion").val();
        
        if(descripcion==""){activar_error("descripcion_agregar_ubicacion");}
        else{desactivar_error("descripcion_agregar_ubicacion");}
    }
    
    //
    
    
    function activar_error(id)
    {
        $("#"+id).css("border-width","2px");
        $("#"+id).css("border-style","solid");
        $("#"+id).css("border-color","#F00");
    }
    
    function desactivar_error(id)
    {
        $("#"+id).css("border-width","0px");
    }
    
    $(function () {
        $('#tabla_listado').DataTable({
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


