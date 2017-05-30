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
  <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url()?>recursos/plugins/jQuery/jquery-2.1.4.min.js"></script>

  <script>
    $(document).ready(function()
    {
        $("#btn_exportar_excel").click(function()
        {
            $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
        });
    });
  </script>
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
        Ver factura N° <?php echo $factura["numero"]?>
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Clientes</a></li>
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
                    <p class="pull-right">
                        <a class="btn btn-danger" target="_blank" href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/imprimir_factura/<?php echo $factura["numero"]?>"><i class="fa fa-print"></i> Imprimir</a>
                    </p>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">DATOS DE LA FACTURA:</p>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero_ver_factura">Numero: </label>
                                <input class="form-control" type="text" id="numero_ver_factura" value="<?php echo $factura["numero"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="punto_de_venta_ver_factura">Punto de venta: </label>
                                <input class="form-control" type="text" id="punto_de_venta_ver_factura" value="<?php echo $factura["desc_punto_venta"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_ver_factura">Fecha: </label>
                                <input class="form-control" type="text" id="fecha_ver_factura" value="<?php echo $factura["fecha"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cliente_ver_factura">Cliente: </label>
                                <input class="form-control" type="text" id="cliente_ver_factura" value="<?php echo $factura["cliente_dni_cuit_cuil"]." ".$factura["cliente_nombre"]." ".$factura["cliente_apellido"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="remito_ver_factura">Remito: </label>
                                <input class="form-control" type="text" id="remito_ver_factura" value="<?php echo $factura["remito"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pedido_ver_factura">Pedido: </label>
                                <input class="form-control" type="text" id="pedido_ver_factura" value="<?php echo $factura["pedido"]?>" disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cliente_ver_factura">Tipo de factura: </label>
                                <input class="form-control" type="text" id="cliente_ver_factura" value="<?php echo $factura["desc_tipo_factura"]?>"  disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="condicion_de_venta_ver_factura">Condicion de venta: </label>
                                <input class="form-control" type="text" id="condicion_de_venta_ver_factura" value="<?php echo $factura["desc_condicion"]?>"  disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total_ver_factura">Total: </label>
                                <input class="form-control" type="text" id="total_ver_factura" value="<?php echo $factura["total"]?>"  disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="usuario_ver_factura">Usuario: </label>
                                <input class="form-control" type="text" id="usuario_ver_factura" value="<?php echo $factura["desc_usuario"]?>"  disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descuento_general_ver_factura">Descuento general: </label>
                                <input class="form-control" type="text" id="descuento_general_ver_factura" value="<?php echo $factura["descuento_general"]?>"  disabled/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado_ver_factura">Estado: </label>
                                <input class="form-control" type="text" id="estado_ver_factura" value="<?php echo $factura["desc_estado"]?>"  disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">DETALLE</p>
                        <table class="table table-bordered">
                            <tr>
                                <th>DESCRIPCION</th>
                                <th>PRECIO</th>
                                <th>CANTIDAD</th>
                                <th>DESCUENTO</th>
                                <th>SUBTOTAL</th>
                                <th>TOTAL</th>
                            </tr>
                            
                            <!-- DETALLE -->
                            <?php

                                $suma_totales = 0;

                                foreach ($detalle_factura as $value)
                                {
                                    $cantidad = (float)$value["cantidad"];
                                    $unitario = (float)$value["precio"];
                                    $descuento = (int)$value["descuento"];

                                    $descuento_en_pesos=0;

                                    if($descuento != 0)
                                    {
                                        $descuento_en_pesos = ($unitario * ($descuento / 100));
                                    }

                                    $subtotal =$unitario-$descuento_en_pesos;
                                    $total=$subtotal*$cantidad;

                                    echo 
                                    "<tr>
                                        <td>".$value["descripcion"]."</td>
                                        <td>$".number_format($unitario,2,".",",")."</td>
                                        <td>".$cantidad."</td>
                                        <td>".$descuento."%</td>
                                        <td>$".number_format($subtotal,2,".",",")."</td>
                                        <td><strong>$".number_format($total,2,".",",")."</strong></td>";
                                        $suma_totales+=$total;
                                }
                            ?>
                        </table>
                        
                        <div  style="font-size: 17px;font-weight: bold;">
                            <div class="col-xs-offset-8 col-xs-4">
                                <p>SUBTOTAL: $<?php echo $suma_totales?></p>
                            </div>
                            <div class="col-xs-offset-8 col-xs-4">
                                <?php 
                                    $descuento_general = (int)$factura["descuento_general"];
                                    $descuento_general_pesos =0;

                                    if($descuento_general != 0)
                                    {
                                        $descuento_general_pesos = $suma_totales * ($descuento_general / 100);
                                    }

                                    $suma_totales-= $descuento_general_pesos;

                                    //$impuestos = $suma_totales * 0.21;
                                ?>
                                <p>DESC. GRAL: <?php echo $factura["descuento_general"]?>% - $<?php echo number_format($descuento_general_pesos,2,".",",")?></p>
                            </div>

                            <!--<div class="col-xs-offset-8 col-xs-4">
                                <p>IMPUESTOS: $</p>
                            </div>-->
                            <div class="col-xs-offset-8 col-xs-4">
                                <p>TOTAL: $<?php echo number_format($factura["total"],2,".",",");?></p>
                            </div>
                        </div>
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
 
<div class="modal modal-danger" id="modal_ver_factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ver factura:</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero_ver_factura">Numero: </label>
                            <input class="form-control" type="text" id="numero_ver_factura" disabled/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="punto_de_venta_ver_factura">Punto de venta: </label>
                            <input class="form-control" type="text" id="punto_de_venta_ver_factura" disabled/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cliente_ver_factura">Cliente: </label>
                            <input class="form-control" type="text" id="cliente_ver_factura" disabled/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cliente_ver_factura">Tipo de factura: </label>
                            <input class="form-control" type="text" id="cliente_ver_factura" disabled/>
                        </div>
                    </div>
                    
                    
                </div> 
                <div class="clearfix"></div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="$('#modal_ver_recibo').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


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
    
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    
    function abrir_modal_ver_recibo(numero)
    {
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/get_recibo",
            type: "POST",
            data:{numero:numero},
            success: function(data)
            {
                data= JSON.parse(data);
                
                $("#numero_ver_recibo").val(data["numero"]);
                $("#cliente_ver_recibo").val(data["cliente_dni_cuit_cuil"] + " - "+data["nombre"]+" "+data["apellido"]);
                $("#importe_ver_recibo").val(data["importe"]);
                $("#forma_pago_ver_recibo").val(data["desc_forma_pago"]);
                $("#modal_ver_recibo").modal("show");
            },
            error: function(event){alert(event.responseText);
            },
        });    
    }
    
    
    function comprueba_valores()
    {
        comprueba_valor("telefono_agregar_cliente");
        comprueba_valor("telefono_editar_cliente");
        comprueba_valor("dni_cuit_cuil_editar_cliente");
        comprueba_valor("dni_cuit_cuil_agregar_cliente");
    }
    
    function comprueba_valor(id)
    {
        var valor = parseInt($("#"+id).val());
        
        if(isNaN(valor))
        {
            valor =0;
        }
        
        $("#"+id).val(valor);
    }
   
    
    function modal_editar_cliente(id)
    {
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/get_cliente",
            type: "POST",
            data:{id:id},
            success: function(data)
            {
                data= JSON.parse(data);
                
                $("#id_editar_cliente").val(id);
                $("#dni_cuit_cuil_editar_cliente").val(data["dni_cuit_cuil"]);
                $("#razon_social_editar_cliente").val(data["razon_social"]);
                $("#nombre_editar_cliente").val(data["nombre"]);
                $("#apellido_editar_cliente").val(data["apellido"]);
                $("#telefono_editar_cliente").val(data["telefono"]);
                $("#correo_editar_cliente").val(data["correo"]);
                $("#direccion_editar_cliente").val(data["direccion"]);
                $("#contrasenia_editar_cliente").val(data["contrasenia"]);
                $("#localidad_editar_cliente").val(data["localidad"]);
                $("#tipo_inscripcion_editar_cliente").val(data["tipo_inscripcion"]);
                $("#estado_editar_cliente").val(data["estado"]);
                $("#descuento_gral_editar_cliente").val(data["descuento_gral"]);
                $("#ingresos_brutos_editar_cliente").val(data["ingresos_brutos"]);
                $("#limite_cuenta_editar_cliente").val(data["limite_cuenta"]);
                $("#modal_editar_cliente").modal("show");
            },
            error: function(event){alert(event.responseText);
            },
        });    
    }
    
    function editar_cliente()
    {
        var id = $("#id_editar_cliente").val();
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_editar_cliente").val());
        var razon_social = $("#razon_social_editar_cliente").val();
        var nombre = $("#nombre_editar_cliente").val();
        var apellido = $("#apellido_editar_cliente").val();
        var telefono = parseInt($("#telefono_editar_cliente").val());
        var correo = $("#correo_editar_cliente").val();
        var direccion = $("#direccion_editar_cliente").val();
        var contrasenia = $("#contrasenia_editar_cliente").val();
        var localidad = parseInt($("#localidad_editar_cliente").val());
        var localidad2 = parseInt($("#localidad2_editar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_editar_cliente").val());
        var tipo_inscripcion2 = parseInt($("#tipo_inscripcion2_editar_cliente").val());
        var estado = parseInt($("#estado_editar_cliente").val());
        var estado2 = parseInt($("#estado2_editar_cliente").val());
        var descuento_gral=$("#descuento_gral_editar_cliente").val();
        var ingresos_brutos = $("#ingresos_brutos_editar_cliente").val();
        var limite_cuenta = $("#limite_cuenta_editar_cliente").val();
        
        if  (dni_cuit_cuil != "" && ingresos_brutos != "" && !isNaN(dni_cuit_cuil) &&
             razon_social != "" && nombre != "" && apellido != "" &&
             telefono != "" && !isNaN(telefono) && correo != "" && validarEmail(correo) &&
             direccion !="" && localidad != "" && !isNaN(localidad) && localidad != 0 &&
             tipo_inscripcion != "" && !isNaN(tipo_inscripcion) && tipo_inscripcion != 0 && estado != "" && !isNaN(estado) && estado != 0
            )
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_cliente",
                type: "POST",
                data:
                {
                    id:id,
                    dni_cuit_cuil:dni_cuit_cuil,
                    razon_social:razon_social,
                    nombre:nombre,
                    apellido:apellido,
                    telefono:telefono,
                    correo:correo,
                    direccion:direccion,
                    contrasenia:contrasenia,
                    localidad:localidad,
                    tipo_inscripcion:tipo_inscripcion,
                    estado:estado,
                    localidad2:localidad2,
                    tipo_inscripcion2:tipo_inscripcion2,
                    estado2:estado2,
                    descuento_gral:descuento_gral,
                    ingresos_brutos:ingresos_brutos,
                    limite_cuenta:limite_cuenta
                    
                },
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_clientes";
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
            $("#mensaje_error_editar_cliente").text("Por favor complete todos los campos");
        }
    }
    
    function agregar_cliente()
    {
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_agregar_cliente").val());
        var razon_social = $("#razon_social_agregar_cliente").val();
        var nombre = $("#nombre_agregar_cliente").val();
        var apellido = $("#apellido_agregar_cliente").val();
        var telefono = parseInt($("#telefono_agregar_cliente").val());
        var correo = $("#correo_agregar_cliente").val();
        var direccion = $("#direccion_agregar_cliente").val();
        var contrasenia = $("#contrasenia_agregar_cliente").val();
        var localidad = parseInt($("#localidad_agregar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_agregar_cliente").val());
        var estado = parseInt($("#estado_agregar_cliente").val());
        var descuento_gral= $("#descuento_gral_agregar_cliente").val();
        var ingresos_brutos = $("#ingresos_brutos_agregar_cliente").val();
        var limite_cuenta = parseFloat($("#limite_cuenta_agregar_cliente").val());
        
        if  (dni_cuit_cuil != "" && !isNaN(dni_cuit_cuil) &&
             razon_social != "" && ingresos_brutos != "" && nombre != "" && apellido != "" &&
             telefono != "" && !isNaN(telefono) && correo != "" && validarEmail(correo) &&
             direccion !="" && localidad != "" && !isNaN(localidad) && localidad != 0 &&
             tipo_inscripcion != "" && !isNaN(tipo_inscripcion) && tipo_inscripcion != 0 && estado != "" && !isNaN(estado) && estado != 0
            )
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_cliente",
                type: "POST",
                data:
                {
                    dni_cuit_cuil:dni_cuit_cuil,
                    razon_social:razon_social,
                    nombre:nombre,
                    apellido:apellido,
                    telefono:telefono,
                    correo:correo,
                    direccion:direccion,
                    contrasenia:contrasenia,
                    localidad:localidad,
                    tipo_inscripcion:tipo_inscripcion,
                    estado:estado,
                    descuento_gral:descuento_gral,
                    ingresos_brutos:ingresos_brutos,
                    limite_cuenta:limite_cuenta,
                },
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_clientes";
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
            $("#mensaje_error_agregar_cliente").text("Por favor complete todos los campos");
        }
    }
    
    function gestiona_errores_agregar()
    {
        
        var razon_social = $("#razon_social_agregar_cliente").val();
        var nombre = $("#nombre_agregar_cliente").val();
        var apellido = $("#apellido_agregar_cliente").val();
        var telefono = parseInt($("#telefono_agregar_cliente").val());
        var correo = $("#correo_agregar_cliente").val();
        var direccion = $("#direccion_agregar_cliente").val();
        var ingresos_brutos = $("#ingresos_brutos_agregar_cliente").val();
        
        var localidad = parseInt($("#localidad_agregar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_agregar_cliente").val());
        var estado = parseInt($("#estado_agregar_cliente").val());
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_agregar_cliente").val());
        
        
        if(razon_social==""){activar_error("razon_social_agregar_cliente");}
        else{desactivar_error("razon_social_agregar_cliente");}
        
        if(ingresos_brutos==""){activar_error("ingresos_brutos_agregar_cliente");}
        else{desactivar_error("ingresos_brutos_agregar_cliente");}
        
        if(nombre==""){activar_error("nombre_agregar_cliente");}
        else{desactivar_error("nombre_agregar_cliente");}
        
        if(apellido==""){activar_error("apellido_agregar_cliente");}
        else{desactivar_error("apellido_agregar_cliente");}
        
         
        if(correo=="" || !validarEmail(correo)){activar_error("correo_agregar_cliente");}
        else{desactivar_error("correo_agregar_cliente");}
        
        if(direccion==""){activar_error("direccion_agregar_cliente");}
        else{desactivar_error("direccion_agregar_cliente");}
        
        
       
        if(localidad=="" || isNaN(localidad) || localidad == 0){activar_error("localidad_agregar_cliente");}
        else{desactivar_error("localidad_agregar_cliente");}
        
        if(tipo_inscripcion=="" || isNaN(tipo_inscripcion || tipo_inscripcion == 0)){activar_error("tipo_inscripcion_agregar_cliente");}
        else{desactivar_error("tipo_inscripcion_agregar_cliente");}
        
        if(estado=="" || isNaN(estado) || estado == 0){activar_error("estado_agregar_cliente");}
        else{desactivar_error("estado_agregar_cliente");}
        
        if(dni_cuit_cuil=="" || isNaN(dni_cuit_cuil) ){activar_error("dni_cuit_cuil_agregar_cliente");}
        else{desactivar_error("dni_cuit_cuil_agregar_cliente");}
        
        if(telefono=="" || isNaN(telefono)){activar_error("telefono_agregar_cliente");}
        else{desactivar_error("telefono_agregar_cliente");}
       
    }
    
    function gestiona_errores_editar()
    {
        
        var razon_social = $("#razon_social_editar_cliente").val();
        var nombre = $("#nombre_editar_cliente").val();
        var apellido = $("#apellido_editar_cliente").val();
        var telefono = parseInt($("#telefono_editar_cliente").val());
        var correo = $("#correo_editar_cliente").val();
        var direccion = $("#direccion_editar_cliente").val();
        var ingresos_brutos = $("#ingresos_brutos_editar_cliente").val()
        
        var localidad = parseInt($("#localidad_editar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_editar_cliente").val());
        var estado = parseInt($("#estado_editar_cliente").val());
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_editar_cliente").val());
        
        if(razon_social==""){activar_error("razon_social_editar_cliente");}
        else{desactivar_error("razon_social_editar_cliente");}
        
       
        
        if(ingresos_brutos==""){activar_error("ingresos_brutos_editar_cliente");}
        else{desactivar_error("ingresos_brutos_editar_cliente");}
        
        if(nombre==""){activar_error("nombre_editar_cliente");}
        else{desactivar_error("nombre_editar_cliente");}
        
        if(apellido==""){activar_error("apellido_editar_cliente");}
        else{desactivar_error("apellido_editar_cliente");}
        
        if(telefono=="" || isNaN(telefono)){activar_error("telefono_editar_cliente");}
        else{desactivar_error("telefono_editar_cliente");}
        
        if(correo=="" || !validarEmail(correo)){activar_error("correo_editar_cliente");}
        else{desactivar_error("correo_editar_cliente");}
        
        if(direccion==""){activar_error("direccion_editar_cliente");}
        else{desactivar_error("direccion_editar_cliente");}
        
        
        
        
        if(localidad=="" || isNaN(localidad) || localidad == 0){activar_error("localidad_editar_cliente");}
        else{desactivar_error("localidad_editar_cliente");}
        
        if(tipo_inscripcion=="" || isNaN(tipo_inscripcion || tipo_inscripcion == 0)){activar_error("tipo_inscripcion_editar_cliente");}
        else{desactivar_error("tipo_inscripcion_editar_cliente");}
        
        if(estado=="" || isNaN(estado) || estado == 0){activar_error("estado_editar_cliente");}
        else{desactivar_error("estado_editar_cliente");}
        
        if(dni_cuit_cuil=="" || isNaN(dni_cuit_cuil) ){activar_error("dni_cuit_cuil_editar_cliente");}
        else{desactivar_error("dni_cuit_cuil_editar_cliente");}
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
        $('#Exportar_a_Excel').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    
    $(document).ready(function()
    {
        $(".select2").select2();
    });
    
    
</script>
</body>
</html>


