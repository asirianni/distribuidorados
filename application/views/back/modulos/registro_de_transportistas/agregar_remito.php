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
        Agregar Remito
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-truck"></i> Registro de Transportistas</a></li>
        <!--<li class="active">Listado</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" style="text-align: right;">
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/abm_remitos" class="btn btn-warning" ><i class='fa fa-arrow-left'></i> Volver al Listado</a>
                    <button class="btn btn-success" onClick="guardar_remito()"><i class="fa fa-save"></i> Guardar Remito</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">CABECERA DE REMITO:</p>
                    </div>
                   <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Prox. N° remito: </label>
                            <input type="text" class="form-control" value="<?php echo $proximo_remito?>" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_agregar">Fecha: </label>
                            <input type="text" class="form-control datetimepicker" id="fecha_agregar" name="fecha_agregar" value="<?php echo Date("Y-m-d")?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cliente_agregar">Cliente: </label>
                            <select class="form-control select2" style="width: 100%;" id="cliente_agregar" name="cliente_agregar">
                                <?php
                                    foreach($lista_clientes as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="condicion_venta_agregar">Condicion de venta: </label>
                            <select class="form-control select2" style="width: 100%;" id="condicion_venta_agregar" name="condicion_venta_agregar">
                                <?php
                                   foreach($condiciones_de_venta as $value)
                                   {
                                       echo "<option value='".$value["id"]."'>".$value["condicion"]."</option>";
                                   }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="transporte_agregar" id="label_transporte_agregar">Transporte: </label>
                            <select class="form-control select2" style="width: 100%;" id="transporte_agregar" name="transporte_agregar">
                                <option value="0">Seleccione</option>
                                <?php
                                    foreach($lista_transportistas as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["cuit"]." - ".$value["transporte"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="chofer_agregar" id="label_chofer_agregar">Chofer: </label>
                            <select class="form-control select2" style="width: 100%;" id="chofer_agregar" name="chofer_agregar">
                            <option value="0">Seleccione</option>
                            <?php
                                foreach($lista_choferes as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["cuit"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="chasis_agregar">Chasis: </label>
                            <input type="text" class="form-control" id="chasis_agregar" name="chasis_agregar" value=""/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="acoplado_agregar">Acoplado: </label>
                            <input type="text" class="form-control" id="acoplado_agregar" name="acoplado_agregar" value=""/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_vehiculo_agregar">Tipo de vehiculo: </label>
                            <select class="form-control select2" style="width: 100%;" id="tipo_vehiculo_agregar" name="tipo_vehiculo_agregar">
                                <?php
                                foreach($lista_tipos_vehiculos as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["vehiculo"]."</option>";
                                                
                                }  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="patente_agregar">Patente</label>
                            <input type="text" class="form-control" id="patente_agregar" name="patente_agregar" value=""/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="entrega_agregar">Entrega: </label>
                            <input type="text" class="form-control" id="entrega_agregar" name="entrega_agregar" value=""/>
                        </div>
                    </div>
                   
                        
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado_agregar">Estado: </label>
                            <select class="form-control select2" style="width: 100%;" id="estado_agregar" name="estado_agregar">
                                <option value="pendiente">pendiente</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-top: 30px;">
                        <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">DETALLE DE REMITO:</p>
                        <button class="btn btn-warning" onClick="$('#modal_agregar_producto').modal('show');"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                    <div class="col-md-12" id="contenedor_tabla_productos" style="margin-top: 30px;">
                        
                        <div class="box">
                            <div class="box-body">
                              <table id="" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody id="cuerpo_tabla_detalle">
                                    
                                </tbody>
                              </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <div class="col-md-12">
                         
                        <div class="col-md-6">
                            <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">Total Kg Cargados: <span id="total_kg_cargados">0</span></p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">Total: $<span id="total_pesos">0</span></p>
                        </div>
                    </div>
                    <!--<div class="col-md-12" style="text-align: center;margin-top: 50px;">
                        <button class="btn btn-warning" onClick="guardar_remito()"><i class="fa fa-save"></i> Guardar Remito</button>
                    </div>-->
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

<div class="modal modal-default" id="modal_agregar_producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un producto:</h4>
            </div>
            <div class="modal-body">
                <table id="tabla_productos" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_productos as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["id"]."</td>
                                    <td>".$value["descripcion"]."</td>
                                    <td>".$value["stock"]."</td>
                                    <td>$".$value["costo"]."</td>
                                    <td>
                                        <button class='btn btn-warning' data-toggle='tooltip' title='' data-original-title='Agregar' onClick='agregar_producto(".$value["id"].",&#39;".$value["descripcion"]."&#39;,".$value["costo"].")'><i class='fa fa-plus'></i></button>
                                   </td>    
                                </tr>";
                            }
                        ?>              
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="$('modal_agregar_producto').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
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
    
    var detalle_remito = new Array();
    
    function agregar_producto(codigo,descripcion,costo)
    {
        var se_encuentra= false;
        
        codigo = parseInt(codigo);
        var posicion = -1;
        
        for(var i=0; i < detalle_remito.length;i++)
        {
            if(detalle_remito[i] != undefined)
            {
                if(codigo == detalle_remito[i][0] && se_encuentra == false)
                {
                    se_encuentra=true;
                    posicion=i;
                    i= detalle_remito.lenght;
                }
            }
        }
        
        if(se_encuentra)
        {
            var registro= detalle_remito[posicion];
            
            var codigo = detalle_remito[posicion][0];
            var descripcion = detalle_remito[posicion][1];
            var costo = detalle_remito[posicion][2];
            var cantidad = detalle_remito[posicion][3];
            
            cantidad++;
            
            detalle_remito[posicion]= new Array(codigo,descripcion,costo,cantidad);
            
            
        }
        else
        {
            costo = parseFloat(costo);
            var cantidad = 1;
            costo= parseFloat(costo);
            cantidad= parseFloat(cantidad);
            var registro = new Array(codigo,descripcion,costo,cantidad);
            
            detalle_remito.push(registro);
            
            
        }
        
        
        var html= generar_html();
        $("#cuerpo_tabla_detalle").html(html);
        actualizar_totales();
        $("#modal_agregar_producto").modal("hide");
    }
    
    // GENERA EL HTML
    function generar_html()
    {
        var html="";
        
        for(var i=0; i < detalle_remito.length;i++)
        {
            if(detalle_remito[i] != undefined)
            {
                var codigo = detalle_remito[i][0];
                var descripcion = detalle_remito[i][1];
                var costo = detalle_remito[i][2];
                var cantidad = detalle_remito[i][3];
                var total = costo*cantidad;
                
                html+="<tr id='"+codigo+"'>";
                html+="<td>"+codigo+"</td>";
                html+="<td>"+descripcion+"</td>";
                html+="<td><input type='text' id='cantidad_"+codigo+"' onChange='cambio_valor_fila("+codigo+")' value='"+cantidad+"'></td>";
                html+="<td><input type='text' id='costo_"+codigo+"' onChange='cambio_valor_fila("+codigo+")' value='"+costo+"'></td>";
                html+="<td><input type='text' id='total_"+codigo+"' value='"+total+"' readonly=''></td>";
                html+="<td><button class='btn btn-danger' onClick='sacar_producto("+codigo+")'><i class='fa fa-close'></i></button></td>";
                html+="</tr>";
            }
            
        }
        
        return html;
    }
    
    function cambio_valor_fila(codigo)
    {
        
        codigo = parseInt(codigo);
        var posicion = -1;
        
        for(var i=0; i < detalle_remito.length;i++)
        {
            if(codigo == detalle_remito[i][0])
            {
                posicion=i;
                i= detalle_remito.lenght;
            }
        }
        
        var registro= detalle_remito[posicion];
            
        var codigo = detalle_remito[posicion][0];
        var descripcion = detalle_remito[posicion][1];
        var costo = parseFloat($("#costo_"+codigo).val());
        var cantidad = parseFloat($("#cantidad_"+codigo).val());
            
        detalle_remito[posicion]= new Array(codigo,descripcion,costo,cantidad);
        
        var html= generar_html();
        $("#cuerpo_tabla_detalle").html(html);
        actualizar_totales();
        
    }
    
    function actualizar_totales()
    {
        var total_kg_cargados=0;
        var total_pesos=0;
        
        
        for(var i=0; i < detalle_remito.length;i++)
        {
            if(detalle_remito[i] != undefined)
            {
                var codigo =detalle_remito[i][0];
                
                var total_pesos_registro = parseFloat($("#total_"+codigo).val());
                total_pesos+=total_pesos_registro;
                
                var kilos = parseFloat($("#cantidad_"+codigo).val());
                total_kg_cargados+=kilos;
            }
        }
        
        $("#total_pesos").text(total_pesos);
        $("#total_kg_cargados").text(total_kg_cargados);
    }
    
    function sacar_producto(codigo)
    {
        var i=0;
        var se_encuentra=false;
        var posicion = -1;
        
        while(i < detalle_remito.length)
        {
            if(detalle_remito[i] != undefined)
            {
                if(codigo == detalle_remito[i][0])
                {
                    se_encuentra=true;
                    posicion= i;
                    i= detalle_remito.lenght;
                }
            }
            i++;
        }
        
        if(se_encuentra)
        {
            delete detalle_remito[posicion];
            $("#"+codigo).remove();
        }
        
        
        generar_html();
    }
    
    function guardar_remito()
    {
        var fecha = $("#fecha_agregar").val();
        var cliente = $("#cliente_agregar").val();
        var condicion= $("#condicion_venta_agregar").val();
        var transporte= $("#transporte_agregar").val();
        var chofer= $("#chofer_agregar").val();
        var chasis= $("#chasis_agregar").val();
        var acoplado= $("#acoplado_agregar").val();
        var tipo_vehiculo= $("#tipo_vehiculo_agregar").val();
        var patente= $("#patente_agregar").val();
        var entrega= $("#entrega_agregar").val();
        var total_kg= parseInt($("#total_kg_agregar").val());
        var estado= $("#estado_agregar").val();
        
        if(fecha != "" && chasis != "" && acoplado != "" 
            && patente !="" && entrega !="" && total_kg != "" && transporte != 0 && chofer != 0)
        {
            procesar();
        }
        else
        {
            gestiona_errores_agregar();
        }
    }
    
    function procesar()
    {
        var fecha = $("#fecha_agregar").val();
        var cliente = $("#cliente_agregar").val();
        var condicion= $("#condicion_venta_agregar").val();
        var transporte= $("#transporte_agregar").val();
        var chofer= $("#chofer_agregar").val();
        var chasis= $("#chasis_agregar").val();
        var acoplado= $("#acoplado_agregar").val();
        var tipo_vehiculo= $("#tipo_vehiculo_agregar").val();
        var patente= $("#patente_agregar").val();
        var entrega= $("#entrega_agregar").val();
        var total_kg= parseFloat($("#total_kg_cargados").text());
        var estado= $("#estado_agregar").val();
        
        
        var arreglo_limpio= new Array();
        
        for(var i=0; i < detalle_remito.length;i++)
        {
            if(detalle_remito[i] != undefined)
            {
                arreglo_limpio.push(detalle_remito[i]);
            }
        }
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_remito",
            type: "POST",
            data:{
                fecha:fecha,
                cliente:cliente,
                condicion:condicion,
                transporte:transporte,
                chofer:chofer,
                chasis:chasis,
                acoplado:acoplado,
                tipo_vehiculo:tipo_vehiculo,
                patente:patente,
                entrega:entrega,
                total_kg:total_kg,
                estado:estado,
                detalle:arreglo_limpio,
            },
            success: function(data)
            {
                if(data)
                {
                    location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/abm_remitos";
                }
                else
                {
                    alert("No se ha podido agregar");
                } 
            },
            error: function(event){alert(event.responseText);},
        });    
    }
    
    function gestiona_errores_agregar()
    {
        var fecha = $("#fecha_agregar").val();
        var condicion= $("#condicion_venta_agregar").val();
        var chasis= $("#chasis_agregar").val();
        var chofer= $("#chofer_agregar").val();
        var acoplado= $("#acoplado_agregar").val();
        var patente= $("#patente_agregar").val();
        var transporte= $("#transporte_agregar").val();
        var entrega= $("#entrega_agregar").val();
        var total_kg= parseInt($("#total_kg_agregar").val());
        
        if(fecha==""){activar_error("fecha_agregar");}
        else{desactivar_error("fecha_agregar");}
        
        if(transporte==0){activar_error("label_transporte_agregar");}
        else{desactivar_error("label_transporte_agregar");}
        
        if(chofer==0){activar_error("label_chofer_agregar");}
        else{desactivar_error("label_chofer_agregar");}
        
        if(isNaN(condicion)){activar_error("condicion_venta_agregar");}
        else{desactivar_error("condicion_venta_agregar");}
        
        if(chasis==""){activar_error("chasis_agregar");}
        else{desactivar_error("chasis_agregar");}
        
        if(acoplado==""){activar_error("acoplado_agregar");}
        else{desactivar_error("acoplado_agregar");}
        
        if(patente==""){activar_error("patente_agregar");}
        else{desactivar_error("patente_agregar");}
        
        if(entrega==""){activar_error("entrega_agregar");}
        else{desactivar_error("entrega_agregar");}
        
        if(total_kg=="" || isNaN(total_kg)){activar_error("total_kg_agregar");}
        else{desactivar_error("total_kg_agregar");}
    }
    
    // FIN
    
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
        
        $('#tabla_productos').DataTable({
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


