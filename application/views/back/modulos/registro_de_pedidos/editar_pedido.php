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
        Editar Pedido
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-edit"></i> Registro de Pedidos</a></li>
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
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos" class="btn btn-danger pull-right" ><i class='fa fa-arrow-left'></i> Volver al listado</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_agregar_pedido">Fecha: </label>
                            <input class="form-control datetimepicker" type="text" id="fecha_agregar_pedido" value="<?php echo $pedido["fecha"]?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_entrega_agregar_pedido">F. Entrega: </label>
                            <input class="form-control datetimepicker" type="text" id="fecha_entrega_agregar_pedido" value="<?php echo $pedido["fecha_entrega"]?>"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado_agregar_pedido">Estado: </label>
                            <select class="form-control" type="text" id="estado_agregar_pedido">
                                <?php 
                                    if($pedido["estado"] == "cumplido")
                                    {
                                        echo "<option value='cumplido' selected>cumplido</option>";
                                        echo "<option value='pendiente'>pendiente</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='cumplido'>cumplido</option>";
                                        echo "<option value='pendiente' selected>pendiente</option>";
                                    }
                                ?>
                                
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
                                        if($pedido["cliente"] == $value["id"])
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
                    </div>
                    
                    <!-- TABLA DE PEDIDO DETALLE -->
                        <div class="col-md-12">
                            <input type="button" class="btn btn-danger" id="btn_productos_agregados" value="Productos ya agregados"/>&nbsp;
                            <input type="button" class="btn btn-default" id="btn_agregar_productos" value="Productos sin agregar"/>
                        </div> 
                    
                    <div id="tabla1" class="col-md-12" style="margin-top: 32px;">
                        <table id="tabla_listado_detalle" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Cod producto</th>
                                <th>Producto</th>
                                <th>Precio Vigente</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <!--<th></th>-->

                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($detalle_pedido as $value)
                                    {
                                        echo 
                                        "<tr>
                                            <td id='id_producto_".$value["cod_producto"]."'>".$value["cod_producto"]."</td>
                                            <td>".$value["desc_producto"]."</td>
                                            <td><input type='number'  step='0.5'   id='costo_producto_".$value["cod_producto"]."' value='".$value["precio"]."'/></td>
                                            <td><input type='number' step='0.5' id='cantidad_producto_".$value["cod_producto"]."'  value='".$value["cantidad"]."'/></td>
                                            
                                            <td>
                                                <select class='form-control' id='estado_producto_detalle_".$value["cod_producto"]."'>";
                                                    if($value["estado"] == "pendiente")
                                                    {
                                                        echo 
                                                        "<option value='pendiente' selected>pendiente</option>
                                                        <option value='cumplido'>cumplido</option>";
                                                    }
                                                    else if($value["estado"] == "cumplido")
                                                    {
                                                        echo 
                                                        "<option value='pendiente'>pendiente</option>
                                                        <option value='cumplido' selected>cumplido</option>";
                                                    }
                                                    
                                            echo"</select>
                                            </td>
                                            <!--<td>
                                                <input type='button' class='btn btn-default' value='eliminar'/>
                                            </td>-->
                                        </tr>";
                                    }
                                ?>  
                            </tbody>
                          </table>
                    </div>
                    <!-- TABLA DE PEDIDO DETALLE -->
                    <div id="tabla2" class="col-md-12" style="margin-top: 10px;display:none;">
                        <table id="tabla_listado_productos_no_agregados" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                                <th>Precio Vigente</th>
                                <th>Cant Solicitada</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($listado_productos_faltantes as $value)
                                    {
                                        echo 
                                        "<tr>
                                            <td id='id_producto_".$value["id"]."'>".$value["id"]."</td>
                                            <td>".$value["descripcion"]."</td>
                                            <td>".$value["stock"]."</td>
                                            <td><input type='number'  step='0.5' id='costo_producto_".$value["id"]."' value='".$value["costo"]."'/></td>
                                            <td><input type='number' step='0.5' id='cantidad_producto_".$value["id"]."' value='0'/></td>
                                             <td>
                                                <select class='form-control' id='estado_producto_detalle_".$value["id"]."'>
                                                    <option value='pendiente'>pendiente</option>
                                                    <option value='cumplido'>cumplido</option>
                                                </select>
                                            </td>
                                        </tr>";
                                    }
                                ?>  
                            </tbody>
                          </table>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-danger" onClick="editar_pedido_y_detalle()"><i class='fa fa-save'></i> Guardar Cambios</button>
                    </div>
                    <!-- -->
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

<script>
    
    function editar_pedido_y_detalle()
    {
        var fecha = $("#fecha_agregar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
        var cliente = $("#cliente_agregar_pedido").val();
        var estado = $("#estado_agregar_pedido").val();
        
        if(fecha != "" && fecha_entrega !="" && cliente != "" && estado != "")
        {
            procesar();
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
    
    function procesar()
    {
        
        
        
        var ids_con_cantidades = new Array();
        
        //LEYENDO DE PRODUCTOS NO AGREGADOS
        $( "td[id^='id_producto_']").each(function(indice, elemento) {
            var id= parseInt($(elemento).text());
           
            var cantidad_solicitada= parseFloat($("#cantidad_producto_"+id).val());
            var costo= parseFloat($("#costo_producto_"+id).val());
            var estado = $("#estado_producto_detalle_"+id).val();
            
            if(cantidad_solicitada != 0 && !isNaN(cantidad_solicitada))
            {
                var registro = new Array(id,cantidad_solicitada,costo,estado);
                ids_con_cantidades.push(registro);
            }
        });
        
        var numero_pedido = "<?php echo $numero_pedido?>";
        var fecha = $("#fecha_agregar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
        var cliente = $("#cliente_agregar_pedido").val();
        var estado = $("#estado_agregar_pedido").val();
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/editar_pedido_y_detalle",
            type: "POST",
            data:{
                numero_pedido:numero_pedido,
                fecha:fecha,
                fecha_entrega:fecha_entrega,
                cliente:cliente,
                estado:estado,
                detalle:ids_con_cantidades,
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
    
    $("#btn_productos_agregados").click(function(){
        $("#tabla1").css("display","block");
        $("#tabla2").css("display","none");
        $("#btn_productos_agregados").removeClass("btn-default");
        $("#btn_productos_agregados").addClass("btn-danger");
        $("#btn_agregar_productos").removeClass("btn-danger");
    });
    
    $("#btn_agregar_productos").click(function(){
        $("#btn_agregar_productos").removeClass("btn-default");
        $("#btn_agregar_productos").addClass("btn-danger");
        $("#btn_productos_agregados").removeClass("btn-danger");
        $("#tabla2").css("display","block");
        $("#tabla1").css("display","none");
    });
    
    $(function () {
        $('#tabla_listado_detalle').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        
        $('#tabla_listado_productos_no_agregados').DataTable({
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


