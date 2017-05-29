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
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
  <?php
    echo $css;
  ?>
  
  <style>
      .fila{
          margin-top: 20px;
      }
      
      .marco
      {
          width: 99%;
          border-width: 2px;
          border-color: #000;
          border-style: solid;
          margin: 2px 2px 2px 2px;
          padding: 10px 10px 20px 10px;
          background-color: #fff;
      }
  </style>
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
        Factura de Compra
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-bar-chart"></i> Compras</a></li>
        <!--<li class="active">Dashboard</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
          
        <div class="col-md-12">
            <div class="col-md-12 marco">
                <div class="col-md-4">
                    <div class="col-md-12">
                            
                            
                    </div>
                </div>
               
                <div class="col-md-8">
                    <div class="col-md-12">
                            <div class="col-md-3">
                               <label>TIPO DE FACTURA</label>
                               <select id="tipo_factura" class="form-control" onchange="cambio_tipo_factura()">
                                   <option value="0">Seleccione</option>
                                   <?php
                                       foreach($tipos_factura as $value)
                                       {
                                           echo "<option value='".$value["codigo"]."'>".$value["tipo"]."</option>";
                                       }
                                   ?>
                               </select>
                           </div>
                            <div class="col-md-3">
                                <label>Punto</label>
                                <select class="form-control" id="punto_de_venta" disabled>
                                    <?php
                                        foreach($puntos_de_venta as $value)
                                        {
                                            echo "<option value='".$value["codigo"]."'>".$value["punto"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Numero</label>
                                <input type="text" class="form-control" id="numero" value="<?php echo $numero_proximo?>" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha</label>
                                <input type="text" class="form-control datetimepicker"  id="fecha" value="<?php echo Date("Y-m-d")?>" disabled>
                            </div>
                        </div>
                </div>
            </div>
        </div>
          
          
          
       <div class="col-md-12">
           <div class="col-md-12 marco">
                <div class="col-md-12 fila">
                    <div class="col-md-4">
                         <label>Proveedor Seleccionado</label>
                         <select type="text" class="form-control"  id="proveedor_seleccionado" disabled>
                             <option value="0">Ninguno</option>
                             <?php
                                 foreach($listado_proveedores as $value)
                                 {
                                     echo "<option value='".$value["id"]."'>".$value["cuil"]." - ".$value["razon_social"]."</option>";
                                 }
                             ?> 
                         </select>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <button class="btn btn-primary form-control disabled" id="btn_buscar_proveedor" onClick="abrir_modal_buscar_proveedor()"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <button class="btn btn-primary form-control disabled" id="btn_nuevo_proveedor" onClick="abrir_modal_nuevo_proveedor()"><i class="fa  fa-user-plus"></i>Nuevo</button>
                    </div>
                    <div class="col-md-4">
                         <label>Direccion</label>
                         <input type="text" class="form-control"  id="direccion" value="Seleccione proveedor" disabled>
                     </div>
                    <div style="margin-top: 10px;">&nbsp;</div>
                    <div class="col-md-4">
                         <label>Localidad</label>
                         <select class="form-control" id="localidad" name="localidad" disabled>
                             <option value="0">Seleccione proveedor</option>
                             <?php 
                                 foreach($listado_localidades as $value)
                                 {
                                     echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                 }
                             ?>
                         </select>
                    </div>
                    <div class="col-md-4">
                         <label>Cuit</label>
                         <input type="text" class="form-control"  id="cuil" value="Seleccione proveedor" disabled>
                     </div>
                     <div class="col-md-4">
                         <label>Ingresos Brutos</label>
                         <input type="text" class="form-control"  id="ingresos_brutos" value="Seleccione proveedor" disabled>
                     </div>
                 </div>
            </div>
       </div>
          
        <div class="col-md-12">
            <div class="col-md-12 marco">
                <div class="col-md-12 fila">
                    <span><strong>DETALLES DE PRODUCTO</strong></span> <button class="btn btn-danger disabled" id='btn_agregar_producto_detalle' onClick="ver_modal_lista_productos()"><i class="fa fa-plus"></i>Agregar</button>
                </div>
                <div class="col-md-12 fila">
                    <div class="box">
                        <div class="box-header">
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tabla_listado" class="table table-bordered table-hover">
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
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        <div class="col-md-12" >
            <div class="col-md-offset-6 col-md-6">
                <div class="marco" style="font-size: 18px;">
                    <p>SUB-TOTAL: $<span id='subtotal'>0</span></p>
                    <p>DESC. GRAL: <input type="number"  class=""  id="descuento_general" value="Seleccione proveedor" onChange='generar_html_tabla_listado()' disabled> -$<span id="pesos_de_descuento">0</span></p>
                    <!--<p>IMPUESTOS: $<span id='impuestos'>0</span></p>-->
                    <p>TOTAL: $<span id='total'>0</span></p>
                    <label>CONDICION DE VENTA:</label>
                    <select id="condicion_de_venta">
                        <option value="1">Contado</option>
                        <option value="2">Cuenta Corriente</option>
                    </select>
                    <p style="text-align: center;margin-top: 20px;"><button class="btn btn-warning disabled" id="btn_guardar" onclick="abrir_modal_guardar();"><i class="fa fa-save"></i><br/>GUARDAR</button></p>
                </div>
            </div>
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
<div class="modal modal-default" id="modal_agregar_proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un proveedor:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="razon_social_agregar_proveedor">Razon social: </label>
                        <input class="form-control" type="text" id="razon_social_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono_agregar_proveedor">Telefono: </label>
                        <input class="form-control" type="text" id="telefono_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo_agregar_proveedor">Correo: </label>
                        <input class="form-control" type="text" id="correo_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion_agregar_proveedor">Direccion: </label>
                        <input class="form-control " type="text" id="direccion_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cuil_agregar_proveedor">cuil: </label>
                        <input class="form-control " type="text" id="cuil_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ingresos_brutos_agregar_proveedor">Ingresos Brutos: </label>
                        <input class="form-control" type="text" id="ingresos_brutos_agregar_proveedor"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Localidad</label>
                    <select class="form-control select2" style="width: 100%;" id="localidad_agregar_proveedor">
                        <?php 
                            foreach($listado_localidades as $value)
                            {
                                echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_alta_agregar_proveedor">Fecha de alta: </label>
                        <input class="form-control datetimepicker" type="text" id="fecha_alta_agregar_proveedor" value="<?php echo Date("Y-m-d")?>"/>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_proveedor()"><i class="fa fa-save"></i></i> Guardar Proveedor</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal modal-default" id="modal_buscar_proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    Seleccione un proveedor
                    <button class="btn btn-danger pull-right" onClick="$('#modal_buscar_proveedor').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                    
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="listado_buscar_proveedor" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>CUIL-DNI-CUIT</th>
                                <th>RAZON SOCIAL</th>
                                <th>TELEFONO</th>
                                <th style="display: none;">CORREO</th>
                                <th>DIRECCION</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($listado_proveedores as $value)
                                    {
                                        echo 
                                        "<tr>
                                            <td>".$value["cuil"]."</td>
                                            <td>".$value["razon_social"]."</td>
                                            <td>".$value["telefono"]."</td>
                                            <td style='display: none;'>".$value["correo"]."</td>
                                            <td>".$value["direccion"]."</td>
                                            <td>                                                                                                       
                                                <button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Seleccionar' onClick='seleccionar_proveedor(".$value["id"].",&#34;".$value["razon_social"]."&#34;,".$value["telefono"].",&#34;".$value["correo"]."&#34;,&#34;".$value["direccion"]."&#34;,".$value["cuil"].",&#34;".$value["fecha_alta"]."&#34;,&#34;".$value["ingresos_brutos"]."&#34;,".$value["localidad"].")'><i class='fa fa-plus'></i></button>
                                            </td>    
                                        </tr>";
                                    }
                                ?>  
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-default" id="modal_asociar_pedido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    Seleccionar Pedido
                    <button class="btn btn-danger pull-right" onClick="$('#modal_asociar_pedido').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="lista_pedidos_proveedor" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Numero</th>
                                <th>Fecha</th>
                                <th>F. de Entrega</th>
                                <th>ESTADO</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_lista_pedidos_proveedor">
                               
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-default" id="modal_asociar_remito">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    Seleccionar Remito
                    <button class="btn btn-danger pull-right" onClick="$('#modal_asociar_remito').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
               
                </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="lista_remitos_proveedor" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Numero</th>
                                <th>Fecha</th>
                                <th>Chasis</th>
                                <th>Acoplado</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_lista_remitos_proveedor">
                               
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal modal-default" id="modal_agregar_detalle_remito">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>SELECCIONE PRODUCTOS</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla_lista_detalles_remitos_proveedor" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_lista_detalles_remitos_proveedor">
                               
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="$('#modal_agregar_detalle_remito').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-default" id="modal_agregar_detalle_pedido">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>SELECCIONE PRODUCTOS</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla_lista_detalles_pedidos_proveedor" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_lista_detalles_pedidos_proveedor">
                               
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="$('#modal_agregar_detalle_pedido').modal('hide');"><i class='fa fa-close'></i> Cerrar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


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
                            <tbody>
                            <?php 
                                foreach($lista_productos as $value)
                                {
                                    echo 
                                    "
                                        <tr>
                                            <td>".$value["id"]."</td>
                                            <td>".$value["descripcion"]."</td>
                                            <td>".$value["stock"]."</td>
                                            <td>".$value["costo"]."</td>
                                            <td><button class='btn btn-danger' onclick='agregar_detalle(".$value["id"].",&#34;".$value["descripcion"]."&#34;,".$value["stock"].",".$value["costo"].")'>Seleccionar</button></td>
                                        </tr>
                                    ";
                                }
                            ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal modal-danger" id="modal_imprimir_factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Imprimir</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style='text-align: center;'>
                        <p style="color: #fff;font-weight: bold;font-size: 17px;">¿Desea imprimir la factura?</p>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
        <div class="modal-footer">
           <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-outline" onClick="no_imprimir();"><i class='fa fa-close'></i> No</button>
                <button class="btn btn-outline" onClick="si_imprimir();"><i class='fa fa-print'></i> Si</button>
           </div>
       </div>
    </div><!-- /.modal-dialog -->
</div>


<div class="modal modal-danger" id="modal_guardar_factura">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Guardar</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style='text-align: center;'>
                        <p style="color: #fff;font-weight: bold;font-size: 17px;">¿Desea guardar la factura?</p>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
        <div class="modal-footer">
           <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-outline" onClick="$('#modal_guardar_factura').modal('hide');"><i class='fa fa-close'></i> No</button>
                <button class="btn btn-outline" onClick="si_guardar();"><i class='fa fa-save'></i> Si</button>
           </div>
       </div>
    </div><!-- /.modal-dialog -->
</div>

<form id="imprimir_factura" action='<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/imprimir_factura_compra' method="post" target="_blank" style="display: none;">
    <input type="text" id="numero_factura_imprimir" name="numero"/>
</form>
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
<script src="<?php echo base_url()?>recursos/plugins/morris/morris.min.js"></script>
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
<script src="<?php echo base_url()?>recursos/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>recursos/dist/js/demo.js"></script>
<!--FUNCIONES GLOBALES -->
<script src="<?php echo base_url()?>recursos/js/global.js"></script>

<?php
    echo $js;
?>

<script>
    
    $.fn.dataTable.ext.errMode = 'none';
    
    var arreglo_detalles= new Array();
    var imprimir = false;
    
    function no_imprimir()
    {
        imprimir= false;
        $("#modal_imprimir_factura").modal("hide");
        $("#modal_guardar_factura").modal("show");
    }
    function si_imprimir()
    {
        imprimir=true;
        $("#modal_imprimir_factura").modal("hide");
        guardar();
    }
    
    function si_guardar()
    {
        guardar();
    }
    
    
    
    
    function guardar()
    {
        
        var continuar = !$("#btn_guardar").hasClass("disabled");
        
        if(continuar)
        {
            ccleaner_arreglo_detalle();
            
            var tipo_factura = parseInt($("#tipo_factura").val());
            var punto_de_venta = parseInt($("#punto_de_venta").val());
            var fecha = $("#fecha").val();
            var proveedor = parseInt($("#proveedor_seleccionado").val());
            var condicion_venta = $("#condicion_de_venta").val();
            var detalle = arreglo_detalles;
            var descuento_general = $("#descuento_general").val();
            
            alert(proveedor);
            if(tipo_factura != 0 && fecha != "" && proveedor != 0 && detalle)
            {
                $.ajax({
                    url: "<?php echo base_url()?>index.php/Response_Ajax/crear_factura_compra",
                    type: "POST",
                    data:{
                        tipo_factura:tipo_factura,
                        punto_de_venta:punto_de_venta,
                        fecha:fecha,
                        proveedor:proveedor,
                        condicion_venta:condicion_venta,
                        descuento_general:descuento_general,
                        detalle:detalle,
                        total:$("#total").text(),

                    },
                    success: function(data)
                    {
                        data= JSON.parse(data);

                        if(data)
                        {
                            
                            if(imprimir)
                            {
                                $("#numero_factura_imprimir").val(data["numero"]);
                                $("#imprimir_factura").submit();
                            }
                            
                            location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/facturacion";
                            
                        }
                    },
                    error: function(event){alert(event.responseText);
                    },
                }); 
            }
            else
            {
                if(tipo_factura==0){activar_error("tipo_factura");}
                else{desactivar_error("tipo_factura");}
                
                if(fecha==""){activar_error("fecha");}
                else{desactivar_error("fecha");}
                
                if(proveedor==0){activar_error("proveedor_seleccionado");}
                else{desactivar_error("proveedor_seleccionado");}
                
                if(!detalle)
                {
                    alert("Cargue un detalle");
                }
            }    
        }
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
    
    function cambio_tipo_factura()
    {
        var tipo_factura = $("#tipo_factura").val();
        var id_proveedor = parseInt($("#proveedor_seleccionado").val());
        
        
        if(tipo_factura != 0)
        {
            $("#punto_de_venta").removeAttr("disabled");
            $("#fecha").removeAttr("disabled");
            $("#btn_buscar_proveedor").removeClass("disabled");
            $("#btn_nuevo_proveedor").removeClass("disabled");
            
            
            if(id_proveedor != 0)
            {
                $("#btn_agregar_producto_detalle").removeClass("disabled");
                $("#btn_guardar").removeClass("disabled");
            }
            else
            {
                $("#btn_agregar_producto_detalle").addClass("disabled");
                $("#btn_guardar").addClass("disabled");
            }
        }
        else
        {
            
            $("#punto_de_venta").attr("disabled","");
            $("#fecha").attr("disabled","");
            $("#btn_buscar_proveedor").addClass("disabled");
            $("#btn_nuevo_proveedor").addClass("disabled");
            
            if(id_proveedor == 0)
            {
                $("#btn_agregar_producto_detalle").addClass("disabled");
                $("#btn_guardar").addClass("disabled");
            }
            else
            {
                $("#btn_agregar_producto_detalle").removeClass("disabled");
                $("#btn_guardar").removeClass("disabled");
            }  
        }
    }
    
    function ver_modal_lista_productos()
    {
        var id_proveedor = parseInt($("#proveedor_seleccionado").val());
        
        if(id_proveedor != 0)
        {
            $('#modal_lista_productos').modal('show');
        }
    }
    
    function abrir_modal_buscar_proveedor()
    {
        var tipo_factura = parseInt($("#tipo_factura").val());
        
        if(tipo_factura)
        {
            $('#modal_buscar_proveedor').modal('show');
        }
    }
    
    function abrir_modal_guardar()
    {
        var tipo_factura = parseInt($("#tipo_factura").val());
        var id_proveedor = parseInt($("#proveedor_seleccionado").val());
        
        if(tipo_factura && id_proveedor)
        {
            $('#modal_imprimir_factura').modal('show');
        }
    }
    
    function abrir_modal_nuevo_proveedor()
    {
        var tipo_factura = parseInt($("#tipo_factura").val());
        
        if(tipo_factura)
        {
            $('#modal_agregar_proveedor').modal('show');
        }
        
    }
    
    function agregar_detalle(cod_producto,descripcion,precio)
    {
        $("#btn_guardar").removeClass("disabled");
        if(!buscar_codigo_en_arreglo(cod_producto))
        {
            var descuento = 0;
            var subtotal=precio;
            var total=0;
            var arreglo= {"cod_producto":cod_producto,"descripcion":descripcion,"cantidad":0,"precio":precio,"descuento":descuento,"total":total,"subtotal":subtotal};
            arreglo_detalles.push(arreglo);

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
    
    function generar_html_tabla_listado()
    {
        var html="";
        
        var suma_totales = 0;
        
        for(var i=0; i < arreglo_detalles.length;i++)
        {
            if(arreglo_detalles[i] != undefined)
            {
                var cod_producto =arreglo_detalles[i]["cod_producto"];
                var descripcion =arreglo_detalles[i]["descripcion"];
                var cantidad =arreglo_detalles[i]["cantidad"];
                var precio =arreglo_detalles[i]["precio"];
                var descuento =arreglo_detalles[i]["descuento"];
                var subtotal= arreglo_detalles[i]["subtotal"];
                var total=arreglo_detalles[i]["total"];
                
                
                suma_totales+=total;
                
                html+="<tr>";
                html+="<td style='display: none;'><input type='text' id='codigo_detalle_"+cod_producto+"' value='"+cod_producto+"'></td>";
                html+="<td>"+descripcion+"</td>";
                html+="<td><input type='number' step='0.5' id='cantidad_"+cod_producto+"' value='"+cantidad+"' onChange='cambio_valor("+cod_producto+")'></td>";
                html+="<td>$<input type='number' step='0.5' id='precio_"+cod_producto+"' value='"+precio+"' onChange='cambio_valor("+cod_producto+")'></td>";
                html+="<td><input type='number' step='0.5' id='descuento_"+cod_producto+"' value='"+descuento+"' onChange='cambio_valor("+cod_producto+")'>%</td>";
                html+="<td>$"+subtotal.toFixed(2)+"</td>";
                html+="<td id='total_"+cod_producto+"'>$"+total.toFixed(2)+"</td>";
                html+="<td><button class='btn btn-danger' onClick='eliminar_producto("+cod_producto+")'><i class='fa fa-close'></i></button></td>";
                html+="</tr>";
            }
        }
        
        
        $("#subtotal").text(suma_totales.toFixed(2));
        
        var pesos_de_descuento=0;
        
        var descuento_general= parseInt($("#descuento_general").val());
        
        if(descuento_general != 0)
        {
            pesos_de_descuento =suma_totales * descuento_general / 100;
        }
        
        $("#pesos_de_descuento").text(pesos_de_descuento.toFixed(2));
        
        var impuestos = (suma_totales - pesos_de_descuento) * 21 /100;
        $("#impuestos").text(impuestos.toFixed(2));
        //$("#total").text((suma_totales-pesos_de_descuento+impuestos).toFixed(2));
        $("#total").text((suma_totales-pesos_de_descuento).toFixed(2));
        $("#cuerpo_tabla_listado").html(html);
        
        
    }
    
    function eliminar_producto(codigo_producto)
    {
        var posicion = get_posicion_codigo_en_arreglo(codigo_producto);
        
        delete arreglo_detalles[posicion];
        generar_html_tabla_listado();
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
    
    
   
    function seleccionar_proveedor(id,razon_social,telefono,correo,direccion,cuil,fecha_alta,ingresos_brutos,localidad)
    {
        arreglo_detalles= new Array();
        
        //var html = $("#proveedor_seleccionado").html();
        
        var option = "<option value='"+id+"'>"+cuil+" - "+razon_social+"</option>";
        
        //html+= option;
        
        $("#proveedor_seleccionado").html(option);
        
        $("#proveedor_seleccionado").val(id);
        
        $("#btn_asociar_remito").removeClass("disabled");
        $("#btn_asociar_pedido").removeClass("disabled");
           
        
        $("#direccion").val(direccion);
        $("#cuil").val(cuil);
        $("#descuento_general").removeAttr("disabled");
        $("#descuento_general").val(0);
        $("#ingresos_brutos").val(ingresos_brutos);
        $("#localidad").val(localidad);
        $("#btn_agregar_producto_detalle").removeClass("disabled");
        $("#modal_buscar_proveedor").modal("hide");
        
        //cargar_listado_productos(id);
        //generar_html_tabla_listado();
    }
    
    function agregar_proveedor()
    {
        gestionar_errores_agregar();
        
        var razon_social= $("#razon_social_agregar_proveedor").val();
        var telefono = $("#telefono_agregar_proveedor").val();
        var correo = $("#correo_agregar_proveedor").val();
        var direccion = $("#direccion_agregar_proveedor").val();
        var cuil = $("#cuil_agregar_proveedor").val();
        var fecha_alta = $("#fecha_alta_agregar_proveedor").val();
        var ingresos_brutos = $("#ingresos_brutos_agregar_proveedor").val();
        var localidad = $("#localidad_agregar_proveedor").val();
        
        if( razon_social != "" && telefono != "" && !isNaN(telefono) && validarEmail(correo) 
            && direccion != "" && cuil != "" && !isNaN(cuil) && fecha_alta != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_proveedor",
                type: "POST",
                data:{
                    razon_social:razon_social,
                    telefono:telefono,
                    correo:correo,
                    direccion:direccion,
                    cuil:cuil,
                    fecha_alta:fecha_alta,
                    ingresos_brutos:ingresos_brutos,
                    localidad:localidad,
                },
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        
                        var html = $("#proveedor_seleccionado").html();
        
                        var option = "<option value='"+data["id"]+"'>"+cuil+" - "+razon_social+"</option>";

                        html+= option;
                        
                        $("#localidad").val(localidad);
                        $("#direccion").val(direccion);
                        $("#cuil").val(cuil);
                        $("#descuento_general").removeAttr("disabled");
                        $("#ingresos_brutos").val(parseFloat(ingresos_brutos));
                        
                        $("#proveedor_seleccionado").html(html);

                        $("#proveedor_seleccionado").val(data["id"]);
                        $("#btn_agregar_producto_detalle").removeClass("disabled");
                        $("#modal_agregar_proveedor").modal("hide");
                        
                        seleccionar_proveedor(data["id"],razon_social,telefono,correo,direccion,cuil,fecha_alta,ingresos_brutos,localidad);
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
    }
    
    function gestionar_errores_agregar()
    {
        var razon_social= $("#razon_social_agregar_proveedor").val();
        var telefono = $("#telefono_agregar_proveedor").val();
        var correo = $("#correo_agregar_proveedor").val();
        var direccion = $("#direccion_agregar_proveedor").val();
        var cuil = $("#cuil_agregar_proveedor").val();
        var fecha_alta = $("#fecha_alta_agregar_proveedor").val();
        
        
        if(razon_social == ""){activar_error("razon_social_agregar_proveedor");}
        else{desactivar_error("razon_social_agregar_proveedor");}
        
        if(telefono == "" || isNaN(telefono)){activar_error("telefono_agregar_proveedor");}
        else{desactivar_error("telefono_agregar_proveedor");}
        
        if(!validarEmail(correo)){activar_error("correo_agregar_proveedor");}
        else{desactivar_error("correo_agregar_proveedor");}
        
        if(direccion == ""){activar_error("direccion_agregar_proveedor");}
        else{desactivar_error("direccion_agregar_proveedor");}
        
        if(cuil == "" || isNaN(cuil)){activar_error("cuil_agregar_proveedor");}
        else{desactivar_error("cuil_agregar_proveedor");}
        
        if(fecha_alta == ""){activar_error("fecha_alta_agregar_proveedor");}
        else{desactivar_error("fecha_alta_agregar_proveedor");}
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
    
    
    
    $('#listado_buscar_proveedor').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
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


