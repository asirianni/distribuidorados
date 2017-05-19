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
        Ubicaciones <?php echo $producto["descripcion"]?> 
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
                    <?php if($ubicaciones_faltantes_de_producto)
                    {
                        echo "<button class='btn btn-warning' onClick='$(&#34;#modal_agregar_ubicacion&#34;).modal(&#34;show&#34;);'><i class='fa fa-plus'></i> Agregar Ubicacion</button>";
                    }?>
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_listado" class="btn btn-warning pull-right"><i class='fa fa-arrow-left'></i> Volver al Listado</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <!--<th>Codigo</th>-->
                        <th>Ubicacion</th>
                        <th>Controles</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($ubicaciones_de_producto as $value)
                            {
                                echo 
                                "<tr>
                                    <!--<td>".$value["id"]."</td>-->
                                    <td>".$value["desc_ubicacion"]."</td>
                                    <td style='text-align:center; width:20px;'>
                                        <button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Eliminar' onClick='abrir_modal_eliminar_ubicacion_de_producto(".$value["id"].")'><i class='fa fa-close'></i></button>
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

<!-- MODALES DE ABM PRODUCTOS-->
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
                        <label for="ubicacion_agregar_ubicacion">Seleccione la ubicacion: </label>
                        <select class="form-control" type="text" id="ubicacion_agregar_ubicacion" name="ubicacion_agregar_ubicacion" value="">
                            <?php 
                                foreach ($ubicaciones_faltantes_de_producto as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                }
                            ?>
                        </select>
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

<div class="modal modal-danger" id="modal_eliminar_ubicacion_precio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Eliminar ubicacion:</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_ubicacion_para_eliminar" hidden="true"/>
                <h3 class="text-center">¿Desea eliminar la ubicacion para este producto?</h3>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button class="btn btn-outline" onClick="$('#modal_eliminar_ubicacion_precio').modal('hide');">Cancelar</button>
                <button class="btn btn-outline" onClick="eliminar_ubicacion()">Eliminar</button>
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
    
    function abrir_modal_eliminar_ubicacion_de_producto(id)
    {
        $("#id_ubicacion_para_eliminar").val(id);
        $("#modal_eliminar_ubicacion_precio").modal("show");
    }
    
    function eliminar_ubicacion()
    {
        var id= $("#id_ubicacion_para_eliminar").val();
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/eliminar_ubicacion_de_producto",
            type: "POST",
            data:{id:id},
            success: function(data)
            {
                data= JSON.parse(data);
                    
                if(data)
                {
                    location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/ubicaciones_de_producto/<?php echo $id_producto?>";
                }
                else
                {
                    alert("No se ha podido eliminar");
                }
            },
            error: function(event){alert(event.responseText);
            },
        });    
    }
    
    function agregar_ubicacion()
    {
        var id_ubicacion = $("#ubicacion_agregar_ubicacion").val();
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_ubicacion_a_producto",
            type: "POST",
            data:{id_ubicacion:id_ubicacion,id_producto:<?php echo $id_producto?>},
            success: function(data)
            {
                data= JSON.parse(data);
                    
                if(data)
                {
                    location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/ubicaciones_de_producto/<?php echo $id_producto?>";
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
    
    function agregar_precio()
    {
        var fecha_vigente_desde = $("#fecha_vigente_desde_agregar_precio_vigente").val();
        var precio= $("#precio_agregar_precio_vigente").val();
        
        if(precio !="" && !isNaN(precio) && fecha_vigente_desde != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_precio_vigente",
                type: "POST",
                data:{id_producto:<?php echo $id_producto?>,precio:precio,fecha_vigente_desde:fecha_vigente_desde},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/precios_vigentes_de_producto/<?php echo $id_producto?>";
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
    
    function abrir_modal_editar_precio_vigente(id,precio,fecha)
    {
        $("#id_precio_vigente_para_editar").val(id);
        $("#precio_editar_precio_vigente").val(precio);
        $("#fecha_vigente_desde_editar_precio_vigente").val(fecha);
        
        $("#modal_editar_precio_vigente").modal("show");
    }
    
    function editar_precio()
    {
        var id= $("#id_precio_vigente_para_editar").val();
        var precio= parseFloat($("#precio_editar_precio_vigente").val());
        var fecha= $("#fecha_vigente_desde_editar_precio_vigente").val();
        
        if(id != "" && precio !="" && !isNaN(precio) && fecha != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_precio_vigente",
                type: "POST",
                data:{id:id,precio:precio,fecha_vigente_desde:fecha},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/precios_vigentes_de_producto/<?php echo $id_producto?>";
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
        var precio= parseFloat($("#precio_editar_precio_vigente").val());
        var fecha= $("#fecha_vigente_desde_editar_precio_vigente").val();
        
        if(fecha==""){activar_error("fecha_vigente_desde_editar_precio_vigente");}
        else{desactivar_error("fecha_vigente_desde_editar_precio_vigente");}
        
        if(precio=="" || isNaN(precio)){activar_error("precio_editar_precio_vigente");}
        else{desactivar_error("precio_editar_precio_vigente");}
    }
    
    function gestiona_errores_agregar()
    {
        var fecha_vigente_desde = $("#fecha_vigente_desde_agregar_precio_vigente").val();
        var precio= $("#precio_agregar_precio_vigente").val();
        if(fecha_vigente_desde==""){activar_error("fecha_vigente_desde_agregar_precio_vigente");}
        else{desactivar_error("fecha_vigente_desde_agregar_precio_vigente");}
        
        if(precio=="" || isNaN(precio)){activar_error("precio_agregar_precio_vigente");}
        else{desactivar_error("precio_agregar_precio_vigente");}
    }
    
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
      
    jQuery('.datetimepicker').datetimepicker({
        lang:'es',
         i18n:{
          de:{
           months:[
            'Enero','Febrero','Märzo','Abril',
            'Mayo','Junio','Julio','Agosto',
            'Septiembre','Octubre','Noviembre','Diciembre',
           ],
           dayOfWeek:[
            "So.", "Mo", "Di", "Mi", 
            "Do", "Fr", "Sa.",
           ]
          }
         },
         timepicker:false,

         format:'Y-m-d'
    });
</script>
</body>
</html>


