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
        Pedidos
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-edit"></i> Registro de Pedidos</a></li>
        <!--<li class="active">Listado</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/generar_excel" method="post" target="_blank" id="FormularioExportacion">
            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
        </form>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-6">
                        <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos_agregar" class="btn btn-danger" ><i class='fa fa-plus'></i> Agregar Pedido</a>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <button id="btn_exportar_excel" type="button" class="btn btn-success botonExcel" onclick="exportar_excel()"><i class="fa fa-file-excel-o"></i> Exportar</button>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>F. Entrega</th>
                        <th>Cliente</th>
                        <th>Cuit-Dni-cuil cliente</th>
                        <th>Desc. gral</th>
                        <th>Estado</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_pedidos as $value)
                            {
                                if($value["estado"] == "cumplido" )
                                {
                                    echo "<tr class='bg-success'>";
                                }
                                else if($value["estado"] == "pendiente" )
                                {
                                    echo "<tr class='bg-danger'>";
                                }
                                else
                                {
                                    echo "<tr>";
                                }
                                echo 
                                "   <td>".$value["fecha"]."</td>
                                    <td>".$value["fecha_entrega"]."</td>
                                    <td>".$value["nombre"]." ".$value["apellido"]."</td>
                                    <td>".$value["dni_cuit_cuil"]."</td>
                                    <td>".$value["descuento_gral"]."%</td>
                                    <td>".$value["estado"]."</td> 
                                    <td>
                                        <a href='".base_url()."index.php/".$controller_usuario."/registro_de_pedidos_editar/".$value["numero"]."' class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' ><i class='fa fa-edit'></i></a>
                                        <!--<button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Eliminar' onClick='abrir_modal_eliminar_transportista()'>X</button>-->
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

<div class="modal modal-danger" id="modal_agregar_pedido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un pedido:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_agregar_pedido">Fecha: </label>
                        <input class="form-control datetimepicker" type="text" id="fecha_agregar_pedido" value="<?php echo Date("Y-m-d")?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_entrega_agregar_pedido">F. Entrega: </label>
                        <input class="form-control datetimepicker" type="text" id="fecha_entrega_agregar_pedido"/>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_agregar_pedido">Estado: </label>
                        <select class="form-control" type="text" id="estado_agregar_pedido">
                            <option value="cumplido">cumplido</option>
                            <option value="pendiente">pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_agregar_pedido">Cliente: </label>
                        <select class="form-control select2" style="width: 100%;" id="cliente_agregar_pedido">
                            <?php
                                foreach($lista_clientes as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_pedido()">Guardar Pedido</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_editar_pedido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar un pedido:</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="numero_editar_pedido" hidden="true"/>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_editar_pedido">Fecha: </label>
                        <input class="form-control datetimepicker" type="text" id="fecha_editar_pedido" value="<?php echo Date("Y-m-d")?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_entrega_editar_pedido">F. Entrega: </label>
                        <input class="form-control datetimepicker" type="text" id="fecha_entrega_editar_pedido"/>
                    </div>
                </div>
                
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_editar_pedido">Cliente: </label>
                        <select class="form-control" id="cliente_editar_pedido" disabled>
                            <?php
                                foreach($lista_clientes as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente2_editar_pedido">Cambiar cliente: </label>
                        <select class="form-control select2" style="width: 100%;" id="cliente2_editar_pedido">
                            <option value="0">seleccione</option>
                            <?php
                                foreach($lista_clientes as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_editar_pedido">Estado: </label>
                        <select class="form-control" type="text" id="estado_editar_pedido">
                            <option value="cumplido">cumplido</option>
                            <option value="pendiente">pendiente</option>
                        </select>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="editar_pedido()">Guardar Pedido</button>
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
    $(document).ready(function()
    {
        $("#btn_exportar_excel").click(function()
        {
            $("#datos_a_enviar").val( $("<div>").append( $("#tabla_listado").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
        });
    });
  </script>
  
<script>
    
    
    ////
    
    function abrir_modal_editar_pedido(numero,fecha,fecha_entrega,cliente,estado)
    {
        $("#numero_editar_pedido").val(numero);
        $("#fecha_editar_pedido").val(fecha);
        $("#fecha_entrega_editar_pedido").val(fecha_entrega);
        $("#cliente_editar_pedido").val(cliente);
        $("#estado_editar_pedido").val(estado);
        
        $("#modal_editar_pedido").modal("show");
    }
    
    function editar_pedido()
    {
        var numero = $("#numero_editar_pedido").val();
        var fecha = $("#fecha_editar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_editar_pedido").val();
        var cliente = $("#cliente_editar_pedido").val();
        var cliente2 = $("#cliente2_editar_pedido").val();
        var estado = $("#estado_editar_pedido").val();
        
        if(fecha != "" && fecha_entrega !="" && cliente != "" && estado != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_pedido",
                type: "POST",
                data:{
                    numero:numero,
                    fecha:fecha,
                    fecha_entrega:fecha_entrega,
                    cliente:cliente,
                    cliente2:cliente2,
                    estado:estado,
                 },
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos";
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
    
    function agregar_pedido()
    {
        var fecha = $("#fecha_agregar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
        var cliente = $("#cliente_agregar_pedido").val();
        var estado = $("#estado_agregar_pedido").val();
        
        if(fecha != "" && fecha_entrega !="" && cliente != "" && estado != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_pedido",
                type: "POST",
                data:{
                    
                    fecha:fecha,
                    fecha_entrega:fecha_entrega,
                    cliente:cliente,
                    estado:estado,
                 },
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos";
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
        
        var fecha = $("#fecha_agregar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
        var cliente = $("#cliente_agregar_pedido").val();
        var estado = $("#estado_agregar_pedido").val();
        
        if(fecha==""){activar_error("fecha_agregar_pedido");}
        else{desactivar_error("fecha_agregar_pedido");}
        
        if(fecha_entrega==""){activar_error("fecha_entrega_agregar_pedido");}
        else{desactivar_error("fecha_entrega_agregar_pedido");}
        
        
        if(cliente==""){activar_error("cliente_agregar_pedido");}
        else{desactivar_error("cliente_agregar_pedido");}
        
        if(estado==""){activar_error("estado_agregar_pedido");}
        else{desactivar_error("estado_agregar_pedido");}
        
        
    }
    
    
    function gestiona_errores_editar()
    {
        
        var fecha = $("#fecha_editar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_editar_pedido").val();
        var cliente = $("#cliente_editar_pedido").val();
        var estado = $("#estado_editar_pedido").val();
        
        if(fecha==""){activar_error("fecha_editar_pedido");}
        else{desactivar_error("fecha_editar_pedido");}
        
        if(fecha_entrega==""){activar_error("fecha_entrega_editar_pedido");}
        else{desactivar_error("fecha_entrega_editar_pedido");}
        
        if(cliente==""){activar_error("cliente_editar_pedido");}
        else{desactivar_error("cliente_editar_pedido");}
        
        if(estado==""){activar_error("estado_editar_pedido");}
        else{desactivar_error("estado_editar_pedido");}
        
        
    }

    
    ///
    
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
    
    // FIN
    
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


