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
        Agregar Pedido
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
                                <!--<option value="cumplido">cumplido</option>-->
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
                    <div class="col-md-12">
                        <p style="color:#f00;font-weight: bold;font-size: 17px;" id="mensaje_error_siguiente"></p>
                    </div>
                    <div class="col-md-12" style="text-align:center;">
                        <button class="btn btn-danger" onClick="cargar_productos()" id="btn_cargar_productos"><i class="fa  fa-sort-amount-asc"></i> Cargar Productos</button>
                    </div>
                    
                    <!-- TABLA DE PEDIDO DETALLE -->
                    <div class="col-md-12" style="margin-top: 10px;display: none;" id="contenedor_tabla_productos">
                        <button class="btn btn-danger" id="btn_agregar_producto_detalle" onclick="$('#modal_lista_productos').modal('show');"><i class="fa fa-plus"></i> Agregar</button>
                        <table id="tabla_listado" class="table table-bordered table-hover" style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th style='display: none;'>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Desc</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_listado">
                                
                            </tbody>
                          </table>
                        <div class="col-md-12" style="padding-right: 22px !important;">
                            <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6 marco-sin-width">
                                    <div  style="font-size: 18px;font-weight: bold;">
                                        <div class="col-md-6">
                                            <p>TOTAL</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>$<span style="font-size:22px;" id='total'>0</span></p>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-danger disabled" id="btn_guardar" onClick="agregar_pedido_y_detalle()"><i class='fa fa-save'></i> Guardar Pedido</button>
                        </div>
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

<div class="modal modal-default" id="modal_lista_productos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    Agrege un producto 
                    <button class="btn btn-danger pull-right" onClick="$('#modal_lista_productos').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla_listado_productos" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_listado_productos">
                               
                                            
                            </tbody>
                          </table>
                    </div>
                    
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
    
    var productos_cargados = false;
    var arreglo_detalles = new Array();
    
    function agregar_detalle(cod_producto,descripcion,precio)
    {
        if(!buscar_codigo_en_arreglo(cod_producto))
        {
            var cantidad =1;
            var descuento = 0;
            var subtotal=precio;
            var total=cantidad*subtotal;
            var arreglo= {"cod_producto":cod_producto,"descripcion":descripcion,"cantidad":cantidad,"precio":precio,"descuento":descuento,"total":total,"subtotal":subtotal};
            arreglo_detalles.push(arreglo);

            $("#btn_guardar").removeClass("disabled");
            generar_html_tabla_listado();
        }
        else
        {
            alert("Producto ya agregado");
        } 
    }
    
    function buscar_codigo_en_arreglo(cod_producto)
    {
        var i=0;
        var respuesta = false;
        
        while( i < arreglo_detalles.length)
        {
            if(arreglo_detalles[i] != undefined)
            {
                if(arreglo_detalles[i]["cod_producto"] == cod_producto)
                {
                    respuesta= true;
                    i= arreglo_detalles.length;
                }
            }
            i++;
        }
        
        return respuesta;
    }
    
    function get_posicion_codigo_en_arreglo(cod_producto)
    {
        var i=0;
        var valor = -1;
        
        while( i < arreglo_detalles.length)
        {
            if(arreglo_detalles[i] != undefined)
            {
                if(arreglo_detalles[i]["cod_producto"] == cod_producto)
                {
                    valor = i;
                    i= arreglo_detalles.length;
                }
            }
            i++;
        }
        
        return valor;
    }
    
    function cambio_valor(codigo_producto)
    {
        var i= get_posicion_codigo_en_arreglo(codigo_producto);
        
        var codigo =arreglo_detalles[i]["codigo"];
        var cod_producto =arreglo_detalles[i]["cod_producto"];
        var descripcion =arreglo_detalles[i]["descripcion"];
        
        var iva =arreglo_detalles[i]["iva"];
        
        var cantidad = parseFloat($("#cantidad_"+codigo_producto).val());
        var precio = parseFloat($("#precio_"+codigo_producto).val());
        var descuento = parseFloat($("#descuento_"+codigo_producto).val());
        
        if(isNaN(cantidad))
        {
            cantidad=arreglo_detalles[i]["cantidad"];
        }
        if(isNaN(precio))
        {
            precio=arreglo_detalles[i]["precio"];
        }
        if(isNaN(descuento))
        {
            descuento=arreglo_detalles[i]["descuento"];
        }
        
        var descuento_en_pesos= precio * descuento / 100;
        
        var subtotal= precio-descuento_en_pesos;
        var total = subtotal*cantidad;
        arreglo_detalles[i]["cod_producto"]=cod_producto;
        arreglo_detalles[i]["codigo"]=codigo;
        arreglo_detalles[i]["descripcion"]=descripcion;
        arreglo_detalles[i]["cantidad"]=cantidad;
        arreglo_detalles[i]["precio"]=precio;
        arreglo_detalles[i]["descuento"]=descuento;
        arreglo_detalles[i]["iva"]=iva;
        arreglo_detalles[i]["subtotal"]=subtotal;
        arreglo_detalles[i]["total"]=total;
        arreglo_detalles[i]["cod_producto"]=cod_producto;
        
        generar_html_tabla_listado();
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
        
        if(arreglo_detalles.length <= 0){}
        else{}
    }
    
    function ccleaner_arreglo_detalle()
    {
        var aux=new Array();
        
        for(var i=0; i < arreglo_detalles.length;i++)
        {
            if(arreglo_detalles[i] != undefined)
            {
                aux.push(arreglo_detalles[i]);
            }
        }
        
        arreglo_detalles=aux;
        
    }
    
    function eliminar_producto(codigo_producto)
    {
        var posicion = get_posicion_codigo_en_arreglo(codigo_producto);
        
        delete arreglo_detalles[posicion];
        ccleaner_arreglo_detalle();
        
        if(arreglo_detalles.length <= 0)
        {
            $("#btn_guardar").addClass("disabled");
        }
        else
        {
            $("#btn_guardar").removeClass("disabled");
        }
        generar_html_tabla_listado();
    }
    
    
    function generar_html_tabla_listado()
    {
        var html="";
        
        var suma_totales = 0;
        
        for(var i=0; i < arreglo_detalles.length;i++)
        {
            if(arreglo_detalles[i] != undefined)
            {
                var codigo =arreglo_detalles[i]["codigo"];
                var cod_producto =arreglo_detalles[i]["cod_producto"];
                var descripcion =arreglo_detalles[i]["descripcion"];
                var cantidad =arreglo_detalles[i]["cantidad"];
                var precio =arreglo_detalles[i]["precio"];
                var descuento =arreglo_detalles[i]["descuento"];
                var subtotal= arreglo_detalles[i]["subtotal"];
                var total=arreglo_detalles[i]["total"];
                
                
                suma_totales+=total;
                
                html+="<tr>";
                html+="<td style='display: none;'><input type='text' id='codigo_detalle_"+cod_producto+"' value='"+codigo+"'></td>";
                html+="<td>"+descripcion+"</td>";
                html+="<td><input type='number' step='0.5' id='cantidad_"+cod_producto+"' value='"+cantidad+"' onChange='cambio_valor("+cod_producto+")'></td>";
                html+="<td>$<input type='number' step='0.5' id='precio_"+cod_producto+"' value='"+precio+"' onChange='cambio_valor("+cod_producto+")'></td>";
                html+="<td><input type='number' step='0.5' id='descuento_"+cod_producto+"' value='"+descuento+"' onChange='cambio_valor("+cod_producto+")'>%</td>";
                html+="<td>$"+subtotal.toFixed(2)+"</td>";
                html+="<td style='font-weight: bold;' id='total_"+cod_producto+"'>$"+total.toFixed(2)+"</td>";
                html+="<td><button class='btn btn-danger' onClick='eliminar_producto("+cod_producto+")'><i class='fa fa-close'></i></button></td>";
                html+="</tr>";
            }
        }
        
        $("#total").text((suma_totales).toFixed(2));
        $("#cuerpo_tabla_listado").html(html);
        
        
    }
    
    function cargar_productos()
    {
        if(productos_cargados == false)
        {
            var fecha = $("#fecha_agregar_pedido").val();
            var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
            var cliente = $("#cliente_agregar_pedido").val();
            
            if(fecha == ""){activar_error("fecha_agregar_pedido");}
            else{desactivar_error("fecha_agregar_pedido");};

            if(fecha_entrega == ""){activar_error("fecha_entrega_agregar_pedido");}
            else{desactivar_error("fecha_entrega_agregar_pedido");};

            if(fecha != "" && fecha_entrega != "")
            {
                $.ajax({
                    url: "<?php echo base_url()?>index.php/Response_Ajax/get_listado_productos_segun_usuario",
                    type: "POST",
                    data:{
                        cliente:cliente,
                    },
                    success: function(data)
                    {
                       data= JSON.parse(data);
                       
                       if(data)
                       {
                           var html = "";
                           
                            for(var i=0; i < data.length;i++)
                            {
                                html+="<tr>";
                                    html+="<td>"+data[i]["id"]+"</td>";
                                    html+="<td>"+data[i]["descripcion"]+"</td>";
                                    html+="<td>"+data[i]["stock"]+"</td>";
                                    html+="<td>"+data[i]["precio"]+"</td>";
                                    html+="<td>";
                                        html+="<button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Agregar' onClick='agregar_detalle("+data[i]["id"]+",&#34;"+data[i]["descripcion"]+"&#34;,"+data[i]["precio"]+")'><i class='fa fa-plus'></i></button>";
                                    html+="</td>";
                                html+="</tr>";
                            }    
                           
                           
                            $("#fecha_agregar_pedido").attr("disabled","");
                            $("#fecha_entrega_agregar_pedido").attr("disabled","");
                            $("#estado_agregar_pedido").attr("disabled","");
                            $("#cliente_agregar_pedido").attr("disabled","");
                            $("#btn_cargar_productos").text("Reiniciar");
                            
                            $("#cuerpo_listado_productos").html(html);
                            productos_cargados=true;
                            
                            

                             $('#tabla_listado_productos').DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "ordering": true,
                                "info": true,
                                "autoWidth": true
                             });

                             $("#contenedor_tabla_productos").css("display","block"); 
                       }
                    },
                    error: function(event){alert(event.responseText);
                    },
                });
            }
        }
        else
        {
           location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/registro_de_pedidos_agregar"; 
        }
        
    }
    
    function agregar_pedido_y_detalle()
    {
        var seguir = !$("#btn_guardar").hasClass("disabled");
        
        if(seguir)
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
       
        
        var fecha = $("#fecha_agregar_pedido").val();
        var fecha_entrega = $("#fecha_entrega_agregar_pedido").val();
        var cliente = $("#cliente_agregar_pedido").val();
        var estado = $("#estado_agregar_pedido").val();
        
        $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_pedido_y_detalle",
            type: "POST",
            data:{
                fecha:fecha,
                fecha_entrega:fecha_entrega,
                cliente:cliente,
                estado:estado,
                detalle:arreglo_detalles,
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


