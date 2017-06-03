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
  <?php echo $css?>
</head>
<body>
    <?php 
        echo $menu;
    ?>
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h2>Detalle del Pedido N°: <?php echo $pedido["numero"];?></h2>
            <p>A continuacion se detalla los datos de su pedido, y el detalle del mismo</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_agregar_pedido">FECHA DE CREACION: </label>
                            <input class="form-control" type="text" id="fecha_agregar_pedido" value="<?php echo $pedido["fecha"]?>" readonly=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_entrega_agregar_pedido">FECHA DE ENTREGA: </label>
                            <input class="form-control" type="text" id="fecha_entrega_agregar_pedido" value="<?php echo $pedido["fecha_entrega"]?>" readonly=""/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="estado_agregar_pedido">Estado: </label>
                            <input class="form-control" type="text" id="estado_agregar_pedido" value="<?php echo $pedido["estado"]?>" readonly=""/>
                            
                        </div>
                    </div>
                    
            
            
            <div class="col-md-12" style="margin-top: 20px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>PRODUCTO</th>     
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>DESCUENTO</th>
                            <th>TOTAL</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total = 0.0;
                            
                            foreach($detalle as $value)
                            {
                                $total_producto= (float)$value["precio"] * (float)$value["cantidad"];
                                $total_producto= ($total_producto * (float)$value["descuento"] / 100) + $total_producto;
                              echo "<tr>
                                        <td>".$value["desc_producto"]."</td>
                                        <td>".$value["cantidad"]."</td>
                                        <td>$".$value["precio"]."</td>
                                        <td>".$value["descuento"]."%</td>
                                        <td>$".$total_producto."</td>";
                                        
                                        if($value["estado"] == "pendiente")
                                        {
                                            echo "<td style='color: #dd4b39;'>".$value["estado"]."</td>";
                                        }
                                        else if($value["estado"] == "cumplido")
                                        {
                                            echo "<td style='color: #449d44;'>".$value["estado"]."</td>";
                                        }
                                        
                                echo"</tr>";
                                
                                $total+=$total_producto;
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>     
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>$<?php echo $total_producto?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php
        echo $footer;
    ?>
     
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>recursos/plugins/jQuery/jQuery-2.1.4.min.js"></script> 
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
<?php echo $js?>

<script>
    
    var productos_agregados = new Array();
        
    function reiniciar()
    {
        $("#table_body").html("");
        $("#total_final").text("0");
        $("#total_final_menu").text("0");
        $("#fecha_de_entrega").val("");
        $("#mensaje_error_confirmar").text("");
        productos_agregados= new Array();
    }
    
    function mostrarModal()
    {
        $("#modalCarrito").modal("show");
    }
    
    function guardar_pedido()
    {
        var fecha_entrega = $("#fecha_de_entrega").val();
        
        if(fecha_entrega == ""){activar_error("fecha_de_entrega");}
        else{desactivar_error("fecha_de_entrega");}
        
        if(productos_agregados.length > 0 && fecha_entrega != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Welcome/agregar_pedido",
                type: "POST",
                data:{detalle:productos_agregados,fecha_entrega:fecha_entrega},
                success: function(data)
                {
                    alert(data);
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        reiniciar();
                        alert("Pedido agregado correctamente");
                    }
                    else
                    {
                        alert("No se ha podido agregar");
                    }
                },
                error: function(event){alert(event.responseText);},
             });    
        }
        else
        {
            var mensaje= "";
            
            if(productos_agregados.length == 0)
            {
                mensaje+=" - Por favor agrege productos al carrito de compras<br/>";
            }
            
            if(fecha_entrega == "")
            {
                mensaje+=" - Ingrese una fecha de entrega";
            }
            
            $("#mensaje_error_confirmar").text(mensaje);
        }
    }
    
    function agregar_producto(codigo,descripcion,precio)
    {
        if(!buscar_codigo_en_arreglo(codigo))
        {
            var producto = {"codigo":parseInt(codigo),"descripcion":descripcion,"precio":parseFloat(precio),"cantidad":1};
            productos_agregados.push(producto);
            
            
            var html = $("#table_body").html();
                
            html+="<tr>";
                html+="<td>"+producto["descripcion"]+"</td>";
                html+="<td><input type='number' step='0.5' id='cantidad_"+codigo+"' value='1' onChange='cambio_valor("+codigo+")'/></td>";
                html+="<td id='precio_"+codigo+"'>"+precio+"</td>";
                html+="<td id='subtotal_"+codigo+"'>"+precio+"</td>";
                html+="<td><button class='btn btn-danger' onClick='eliminar_producto("+codigo+")'><i class='fa fa-close'></i></button></td>";
            
            html+="</tr>";
                
            $("#table_body").html(html);
                
        }
        else
        {
            var posicion = get_posicion_codigo_en_arreglo(codigo);
            
            var producto = productos_agregados[posicion];
            
            producto["cantidad"]+= 1;
        }
        
        actualizar_html();
    }
    
    function cambio_valor(codigo_producto)
    {
        var posicion = get_posicion_codigo_en_arreglo(codigo_producto);
        
        var cantidad = parseFloat($("#cantidad_"+codigo_producto).val());
        
        
        var producto = productos_agregados[posicion];
        
        producto["cantidad"]=cantidad;
        
        productos_agregados[posicion]=producto;
        actualizar_html();
    }
    
    function actualizar_html()
    {
        var suma_total_carrito = 0.0;
        var html = "";
        
        for(var i=0; i < productos_agregados.length;i++)
        {
            if(productos_agregados[i] != undefined)
            {
                var producto = productos_agregados[i];
                
                var codigo = producto["codigo"];
                var precio = producto["precio"];
                var cantidad = producto["cantidad"];
                total_producto = producto["cantidad"] * producto["precio"];
                
                
                
                html+="<tr>";
                    html+="<td>"+producto["descripcion"]+"</td>";
                    html+="<td><input type='number' step='0.5' id='cantidad_"+codigo+"' value='"+cantidad+"' onChange='cambio_valor("+codigo+")'/></td>";
                    html+="<td id='precio_"+codigo+"'>"+precio+"</td>";
                    html+="<td id='subtotal_"+codigo+"'>"+total_producto.toFixed(2)+"</td>";
                    html+="<td><button class='btn btn-danger' onClick='eliminar_producto("+codigo+")'><i class='fa fa-close'></i></button></td>";
                html+="</tr>";
                
                suma_total_carrito+= total_producto;
            }
        }
        
        $("#table_body").html(html);
        $("#total_final").text(suma_total_carrito.toFixed(2));
        $("#total_final_menu").text(suma_total_carrito.toFixed(2));
    }
    
    function eliminar_producto(codigo_producto)
    {
        var posicion = get_posicion_codigo_en_arreglo(codigo_producto);
        delete productos_agregados[posicion];
        ccleaner_arreglo_detalle();
        actualizar_html();
    }
    
    function ccleaner_arreglo_detalle()
    {
        var aux=new Array();
        
        for(var i=0; i < productos_agregados.length;i++)
        {
            if(productos_agregados[i] != undefined)
            {
                aux.push(productos_agregados[i]);
            }
        }
        
        productos_agregados=aux;
        
    }
    
    function get_posicion_codigo_en_arreglo(cod_producto)
    {
        var i=0;
        var valor = -1;
        
        while( i < productos_agregados.length)
        {
            if(productos_agregados[i] != undefined)
            {
                if(productos_agregados[i]["codigo"] == cod_producto)
                {
                    valor = i;
                    i= productos_agregados.length;
                }
            }
            i++;
        }
        
        return valor;
    }
    
    function buscar_codigo_en_arreglo(cod_producto)
    {
        var i=0;
        var respuesta = false;
        
        while( i < productos_agregados.length)
        {
            if(productos_agregados[i] != undefined)
            {
                if(productos_agregados[i]["codigo"] == cod_producto)
                {
                    respuesta= true;
                    i= productos_agregados.length;
                }
            }
            
            i++;
        }
        
        return respuesta;
    }
    
    $(function () {
        $('#listado').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
      
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

         format:'d-m-Y'
    });
</script>

</body>
</html>


