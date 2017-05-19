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
        Agregar Movimiento
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
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_movimientos" class="btn btn-warning pull-right" ><i class='fa fa-arrow-left'></i> Volver al Listado</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_agregar_movimiento">Fecha</label>
                            <input type="text" class="form-control datetimepicker" id="fecha_agregar_movimiento" name="fecha_agregar_movimiento" value="<?php echo Date("Y-m-d")?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Prox. N° comprobante: </label>
                            <input type="text" class="form-control datetimepicker" id="" name="" value="<?php echo $numero_comprobante?>" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_comprobante_agregar_movimiento">Tipo de comprobante</label>
                            <select class="form-control select2" style="width: 100%;" id="tipo_comprobante_agregar_movimiento" name="tipo_comprobante_agregar_movimiento">
                                <?php
                                    foreach($tipos_comprobantes as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- NUMERO DE COMPROBANTE -->
                    <!--<div class="col-md-12">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" id="" name=""/>
                        </div>
                    </div>-->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="concepto_agregar_movimiento">Concepto</label>
                            <select class="form-control select2" style="width: 100%;" id="concepto_agregar_movimiento" name="concepto_agregar_movimiento">
                                <option value="entrada">entrada</option>
                                <option value="salida">salida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="contenedor_tabla_productos">
                        <div class="box">
                            <div class="box-body">
                              <table id="tabla_listado" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Costo</th>
                                    <th>Stock</th>
                                    <th>Punto Critico</th>
                                    <th>Stock Ingresante</th>
                                    <th>Controles</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($listado_productos as $value)
                                        {
                                            echo 
                                            "<tr id='fila_producto_".$value["id"]."' >
                                                <td id='id_producto_".$value["id"]."'>".$value["id"]."</td>
                                                <td id='descripcion_producto_".$value["id"]."'>".$value["descripcion"]."</td>
                                                <td id='costo_producto_".$value["id"]."' style='text-align: center;'>".$value["costo"]."</td>
                                                <td id='stock_producto_".$value["id"]."' style='text-align: center;'>".$value["stock"]."</td>
                                                <td style='text-align: center;'>".$value["punto_critico"]."</td>
                                                <td><p id='cantidad_solicitada_".$value["id"]."' style='text-align: center;'>0</p></td>
                                                <td>
                                                    <button class='btn btn-success' onClick='agregar_producto(".$value["id"].")'><i class='fa fa-plus'></i></button>
                                                    <button class='btn btn-danger' onClick='restar_producto(".$value["id"].")'><i class='fa fa-minus'></i></button>
                                                </td>
                                            </tr>";
                                        }
                                    ?>  
                                </tbody>
                              </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                                        
                    <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-warning" onClick="procesar()">Procesar</button>
                    </div>
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

<div class="modal modal-warning" id="modal_agregar_producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulo_agregar_cantidad_producto"></h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_producto_a_agregar" hidden="true"/>
               <div class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label for="cantidad_actual_agregar_producto">Stock Ingresante: </label>
                        <input class="form-control" type="text" id="cantidad_actual_agregar_producto" name="cantidad_actual_agregar_producto" value="" readonly="" />
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label for="cantidad_a_agregar_agregar_producto">Cantidad a Agregar: </label>
                        <input class="form-control" type="text" id="cantidad_a_agregar_agregar_producto" name="cantidad_a_agregar_agregar_producto" value=""/>
                    </div>
                </div>
                <p id="mensaje_error_agregar_producto" style="font-size: 14px;font-weight: bold;color: #fff;"></p>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="agregar_cantidad_producto()">Agregar Cantidad</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_restar_producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulo_editar_cantidad_producto"></h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_producto_a_restar" hidden="true"/>
               <div class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label for="cantidad_actual_restar_producto">Stock Ingresante: </label>
                        <input class="form-control" type="text" id="cantidad_actual_restar_producto" name="cantidad_actual_restar_producto" value="" readonly=""/>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label for="cantidad_a_restar_restar_producto">Cantidad a Restar: </label>
                        <input class="form-control" type="text" id="cantidad_a_restar_restar_producto" name="cantidad_a_restar_restar_producto" value=""/>
                    </div>
                </div>
                <p id="mensaje_error_restar_producto" style="font-size: 14px;font-weight: bold;color: #fff;"></p>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="restar_cantidad_producto()">Restar Cantidad</button>
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
    
    var productos_agregados = new Array();
    
    function agregar_producto(id)
    {
        $("#titulo_agregar_cantidad_producto").text($("#descripcion_producto_"+id).text());
        $("#id_producto_"+id).val(id);
        $("#costo_producto_"+id).val();
        $("#stock_producto_"+id).val();
        
        var cantidad_actual = parseInt($("#cantidad_solicitada_"+id).text());
        $("#cantidad_actual_agregar_producto").val(cantidad_actual);
        $("#id_producto_a_agregar").val(id);
        $("#cantidad_a_agregar_agregar_producto").val("1");
        $("#modal_agregar_producto").modal("show");
    }
    
    function agregar_cantidad_producto()
    {
        var cantidad_a_agregar = parseInt($("#cantidad_a_agregar_agregar_producto").val());
        var id= parseInt($("#id_producto_a_agregar").val());
        
        if(id != "" && !isNaN(id) && cantidad_a_agregar != "" && !isNaN(cantidad_a_agregar))
        {
            
            var cantidad_actual = parseInt($("#cantidad_solicitada_"+id).text());
            cantidad_actual+= cantidad_a_agregar;
            $("#cantidad_solicitada_"+id).text(cantidad_actual);
            $("#fila_producto_"+id).addClass("bg-success");
            $("#modal_agregar_producto").modal("hide");
        }
        else{
            $("#mensaje_error_agregar_producto").text("Ha ocurrido un error, revise los valores");
        }
    }
    
    function restar_producto(id)
    {
        $("#titulo_editar_cantidad_producto").text($("#descripcion_producto_"+id).text());
        $("#id_producto_"+id).val(id);
        $("#costo_producto_"+id).val();
        $("#stock_producto_"+id).val();
        
        var cantidad_actual = parseInt($("#cantidad_solicitada_"+id).text());
        $("#cantidad_actual_restar_producto").val(cantidad_actual);
        $("#id_producto_a_restar").val(id);
        $("#cantidad_a_restar_restar_producto").val("1");
        $("#modal_restar_producto").modal("show");
    }
    
    function restar_cantidad_producto()
    {
        var cantidad_a_restar = parseInt($("#cantidad_a_restar_restar_producto").val());
        var id= parseInt($("#id_producto_a_restar").val());
        
        if(id != "" && !isNaN(id) && cantidad_a_restar != "" && !isNaN(cantidad_a_restar))
        {
            var cantidad_actual = parseInt($("#cantidad_solicitada_"+id).text());
            cantidad_actual-= cantidad_a_restar;
            if(cantidad_actual < 0)
            {
                cantidad_actual=0;
                alert("La cantidad quedará en 0");
                $("#cantidad_solicitada_"+id).text(cantidad_actual);
                $("#modal_restar_producto").modal("hide");
                
                $("#fila_producto_"+id).removeClass("bg-success");
            }
            else
            {
                if(cantidad_actual==0)
                {
                    $("#fila_producto_"+id).removeClass("bg-success");
                    $("#cantidad_solicitada_"+id).text(cantidad_actual);
                }
                else{
                    $("#fila_producto_"+id).addClass("bg-success");
                }
                $("#modal_restar_producto").modal("hide");
            }
        }
        else{
            $("#mensaje_error_restar_producto").text("Ha ocurrido un error, revise los valores");
        }
    }
    
    function procesar()
    {
        var ids_con_cantidades = Array();
        
        
        $( "td[id^='id_producto_']").each(function(indice, elemento) {
            var id= parseInt($(elemento).text());
            
            var cantidad_solicitada= parseInt($("#cantidad_solicitada_"+id).text());
            
            if(cantidad_solicitada != 0 && !isNaN(cantidad_solicitada))
            {
                ids_con_cantidades.push(id);
            }
        });
        
        
        var detalles_movimiento = Array();
        
        for(var i=0; i < ids_con_cantidades.length;i++)
        {
            var id_producto= ids_con_cantidades[i];
            var cantidad = $("#cantidad_solicitada_"+id_producto).text();
            
            var registro = new Array(id_producto,cantidad);
            
            detalles_movimiento.push(registro);
        }
        
        var fecha = $("#fecha_agregar_movimiento").val();
        var concepto = $("#concepto_agregar_movimiento").val();
        var tipo_comprobante = $("#tipo_comprobante_agregar_movimiento").val();
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_movimiento_y_detalle",
            type: "POST",
            data:{fecha:fecha,tipo_comprobante:tipo_comprobante,concepto:concepto,detalle:detalles_movimiento},
            success: function(data)
            {
               data= JSON.parse(data);
                    
                if(data > 0)
                {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_movimientos";
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
    
    $(".select2").select2();
      
</script>
</body>
</html>


