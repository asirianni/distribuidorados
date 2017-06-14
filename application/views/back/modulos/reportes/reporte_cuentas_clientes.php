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
  
  <?php
    echo $css;
  ?>
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
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
        Reporte de Cuenta Cliente
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-bar-chart"></i> Reportes</a></li>
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
                    <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/generar_excel_reporte_cuentas_clientes" method="post" target="_blank" id="FormularioExportacion" hidden>
                        <input type="text" id="desde_imprimir" name="desde_imprimir" value="<?php echo $desde_consultar?>">
                        <input type="text" id="hasta_imprimir" name="hasta_imprimir" value="<?php echo $hasta_consultar?>">
                        <input type="text" id="tipo_imprimir" name="tipo_imprimir" value="<?php echo $tipo_consultar?>">
                        <input type="text" id="cliente_imprimir" name="cliente_imprimir" value="<?php echo $cliente_consultar?>">
                        <input type="text" id="localidad_imprimir" name="localidad_imprimir" value="<?php echo $localidad_consultar?>">
                        <input type="text" id="usuario_imprimir" name="usuario_imprimir" value="<?php echo $usuario_consultar?>">
                        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    </form>
                    <div class="pull-right">
                        <button  class="btn btn-success" onclick="exportar_a_excel();return false;"><i class="fa fa-file-excel-o"></i> Exportar a Excel</button>
                    </div>      
                   
                </div><!-- /.box-header -->
                
                <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/exportar_reporte_caja" method="post" target="_blank" id="FormularioExportacion" hidden="">
                    
                </form>
                <!-- FIN FORMULARIO PARA IMPRIMIR LISTA-->
                
                
                <div class="box-body">
                    <div class="col-md-12">
                        <form action='<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/reporte_de_cuenta_cliente' method='post'>
                            <div class="col-md-2">
                                <label>Fecha desde</label>
                                <input type="text" class="form-control datetimepicker" name="desde_consultar" value="<?php echo $desde_consultar?>"/>
                            </div>
                            <div class="col-md-2">
                                <label>Fecha hasta</label>
                                <input type="text" class="form-control datetimepicker" name="hasta_consultar" value="<?php echo $hasta_consultar?>"/>
                            </div>
                            <div class="col-md-4">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo_consultar">
                                    
                                    <?php
                                        $opciones = Array("todos","entrada","salida");
                                        
                                        for($i=0; $i < count($opciones);$i++)
                                        {
                                            if($opciones[$i] == $tipo_consultar)
                                            {
                                                echo "<option value='".$opciones[$i]."' selected>".$opciones[$i]."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$opciones[$i]."'>".$opciones[$i]."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Cliente</label>
                                <select class="form-control select2" style="width: 100%" id="cliente_consultar" name="cliente_consultar" value="" onChange="cambio_cliente()">
                                    <option value="todos">Todos</option>
                                    <?php
                                    foreach($listado_clientes as $value)
                                    {
                                        if($cliente_consultar == $value["id"])
                                        {
                                            echo "<option value='".$value["id"]."' selected>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                        }
                                    }
                                            
                                    ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <label>Localidad</label>
                                <select class="form-control select2" style="width: 100%" id="localidad_consultar" name="localidad_consultar">
                                <?php

                                    echo "<option value='0'>Todas</option>";

                                    foreach($listado_localidades as $value)
                                    {
                                        if($localidad_consultar == (int)$value["codigo"])
                                        {
                                           echo "<option value='".$value["codigo"]."' selected>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                        }
                                        else
                                        {
                                           echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                        }
                                    }
                                ?>                     
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Usuario</label>
                                <select class="form-control select2" style="width: 100%" id="usuario_consultar" name="usuario_consultar">
                                <?php
                                     echo "<option value='0'>Todos</option>";

                                        foreach($listado_usuarios as $value)
                                        {
                                            if($usuario_consultar == (int)$value["id"])
                                            {
                                                echo "<option value='".$value["id"]."' selected>".$value["usuario"]."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$value["id"]."'>".$value["usuario"]."</option>";
                                            }
                                        }

                                ?>                     
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label></label>
                                <button class="form-control btn btn-danger" id="btn_consultar"><i class="fa fa-search-minus"></i> Consultar</button>
                            </div>
                        </form>
                    </div>
                    <div style="margin-top: 20px;">&nbsp;</div>
                  <table id="tabla_listado" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>CLIENTE</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                        <th>SALDO</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($reporte as $value)
                            {
                                $saldo = (float)$value["entradas"] -(float)$value["salidas"];
                                
                                echo 
                                "
                                    <tr>
                                        <td>".$value["dni_cuit_cuil"]." - ".$value["razon_social"]."</td>
                                        <td>".number_format($value["entradas"], 2)."</td>
                                        <td>".number_format($value["salidas"], 2)."</td>
                                        <td>".  number_format($saldo, 2)."</td>
                                    </tr>
                                ";
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
    
    function cambio_cliente()
    {
        var cliente_consultar= $("#cliente_consultar").val();
        
        if(cliente_consultar == "todos")
        {
            $("#localidad_consultar").removeAttr("disabled");
        }
        else
        {
            $("#localidad_consultar").attr("disabled","disabled");
        }
        
    }
    
    function exportar_a_excel()
    {
	$("#datos_a_enviar").val( $("<div>").append( $("#tabla_listado").eq(0).clone()).html());
	$("#FormularioExportacion").submit();
    }


    $("#btn_consultar").click(function(event){
        var respuesta = false;
        
        var desde = $("#desde_consultar").val();
        var hasta = $("#hasta_consultar").val();
        
        if(desde != "" && hasta != "")
        {
            respuesta = true;
        }
        else
        {
            gestiona_errores_consultar();
        }
        
        return respuesta;
    });
    
    function gestiona_errores_consultar()
    {
        var desde = $("#desde_consultar").val();
        var hasta = $("#hasta_consultar").val();
        
        if(desde==""){activar_error("desde_consultar");}
        else{desactivar_error("desde_consultar");}
        
        if(hasta==""){activar_error("hasta_consultar");}
        else{desactivar_error("hasta_consultar");}
    }
    
    
    
    
    function activar_error(id)
    {
        $("#"+id).css("border-width","2px");
        $("#"+id).css("border-style","solid");
        $("#"+id).css("border-color","#00F");
    }
    
    function desactivar_error(id)
    {
        $("#"+id).css("border-width","0px");
    }
    
    
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
       $(".select2").select2();
      
</script>
</body>
</html>


