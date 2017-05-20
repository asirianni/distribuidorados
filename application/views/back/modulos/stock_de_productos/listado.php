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
        Listado de productos
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
                    <button class="btn btn-danger" onClick="$('#modal_agregar_producto').modal('show');"><i class='fa fa-plus'></i> Agregar Producto</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>List 1</th>
                        <th>List 2</th>
                        <th>List 3</th>
                        <th>List 4</th>
                        <!--<th>Stock</th>
                        <th>Punto Critico</th>
                        <th>Rubro</th>
                        <th>Unidad de medida</th>-->
                        <th>Controles</th>
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
                                    <td>$".$value["costo"]."</td>
                                    <td>$".$value["lista_1"]."</td>
                                    <td>$".$value["lista_2"]."</td>
                                    <td>$".$value["lista_3"]."</td>
                                    <td>$".$value["lista_4"]."</td>
                                    <!--<td>".$value["stock"]."</td>
                                    <td>".$value["punto_critico"]."</td>
                                    <td>".$value["desc_rubro"]."</td>
                                   <td>".$value["medida_desc"]."</td>-->
                                    <td>
                                        <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' onClick='modal_editar_producto(".$value["id"].",&#34;".$value["descripcion"]."&#34;,".$value["stock"].",".$value["punto_critico"].",".$value["rubro"].",".$value["unidad_medida"].",".$value["costo"].",".$value["margen_1"].",".$value["lista_1"].",".$value["margen_2"].",".$value["lista_2"].",".$value["margen_3"].",".$value["lista_3"].",".$value["margen_4"].",".$value["lista_4"].")'><i class='fa fa-edit'></i></button>
                                        <a href='".base_url()."index.php/".$controller_usuario."/precios_vigentes_de_producto/".$value["id"]."' class='btn btn-primary' data-toggle='tooltip' title='' data-original-title='Precios vigentes'><i class='fa fa-dollar'></i></a>
                                        <a href='".base_url()."index.php/".$controller_usuario."/ubicaciones_de_producto/".$value["id"]."' class='btn btn-default' data-toggle='tooltip' title='' data-original-title='Ubicaciones'><i class='fa fa-send-o'></i></a>
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
<div class="modal modal-danger" id="modal_agregar_producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un nuevo producto:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_agregar_producto">Descripcion</label>
                        <input class="form-control" type="text" id="descripcion_agregar_producto" name="descripcion_agregar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rubro_agregar_producto">Rubro</label>
                        <select class="form-control select2" style="width: 100%;" type="text" id="rubro_agregar_producto" name="rubro_agregar_producto">
                            <?php
                                foreach($rubros as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unidad_medida_agregar_producto">Unidad de medida</label>
                        <select class="form-control select2" style="width: 100%;" id="unidad_medida_agregar_producto" name="unidad_medida_agregar_producto">
                        <?php
                            foreach ($unidades_medidas as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["descripcion"]." - ".$value["cantidad"]." - ".$value["medida"]."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stock_agregar_producto">Stock</label>
                        <input class="form-control" type="text" id="stock_agregar_producto" name="stock_agregar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="punto_critico_agregar_producto">Punto Critico</label>
                        <input class="form-control" type="text" id="punto_critico_agregar_producto" name="punto_critico_agregar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="costo_agregar_producto">Costo</label>
                        <input class="form-control" type="number" step="0.5" id="costo_agregar_producto" name="costo_agregar_producto" value="0" onchange="cambio_valor_agregar()"/>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_1_agregar">Margen 1</label>
                        <input class="form-control" type="number" step="0.5" id="margen_1_agregar" name="margen_1_agregar" value="0" onchange="cambio_valor_agregar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_1_agregar">Lista 1</label>
                        <input class="form-control" type="text" id="lista_1_agregar" name="lista_1_agregar" value="0" disabled/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_2_agregar">Margen 2</label>
                        <input class="form-control" type="number" step="0.5" id="margen_2_agregar" name="margen_2_agregar" value="0" onchange="cambio_valor_agregar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_2_agregar">Lista 2</label>
                        <input class="form-control" type="text" id="lista_2_agregar" name="lista_2_agregar" value="0" disabled/>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_3_agregar">Margen 3</label>
                        <input class="form-control" type="number" step="0.5" id="margen_3_agregar" name="margen_3_agregar" value="0" onchange="cambio_valor_agregar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_3_agregar">Lista 3</label>
                        <input class="form-control" type="text" id="lista_3_agregar" name="lista_3_agregar" value="0" disabled/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_4_agregar">Margen 4</label>
                        <input class="form-control" type="number" step="0.5" id="margen_4_agregar" name="margen_4_agregar" value="0" onchange="cambio_valor_agregar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_4_agregar">Lista 4</label>
                        <input class="form-control" type="text" id="lista_4_agregar" name="lista_4_agregar" value="0" disabled/>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_producto()"><i class='fa fa-save'></i> Guardar Producto</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_editar_producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulo_modal_editar_producto"></h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_producto_a_editar" hidden="true">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_editar_producto">Descripcion</label>
                        <input class="form-control" type="text" id="descripcion_editar_producto" name="descripcion_editar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rubro_editar_producto">Rubro</label>
                        <select class="form-control" type="text" id="rubro_editar_producto" name="rubro_editar_producto" disabled>
                            <?php
                                foreach($rubros as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rubro2_editar_producto">Seleccione nuevo rubro:</label>
                        <select class="select2 form-control" id="rubro2_editar_producto" name="rubro2_editar_producto" style="width: 100%;">
                            <option value="0">Seleccione si desea cambiar</option>
                            <?php
                                foreach($rubros as $value)
                                {
                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unidad_medida_editar_producto">Unidad de medida</label>
                        <select class="form-control" id="unidad_medida_editar_producto" name="unidad_medida_editar_producto" disabled>
                        <?php
                            foreach ($unidades_medidas as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["descripcion"]." - ".$value["cantidad"]." - ".$value["medida"]."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unidad2_medida_editar_producto">Unidad de medida</label>
                        <select class="form-control select2" id="unidad2_medida_editar_producto" name="unidad2_medida_editar_producto" style="width: 100%;">
                            <option value="0">Seleccione si desea cambiar</option>
                        <?php
                            foreach ($unidades_medidas as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["descripcion"]." - ".$value["cantidad"]." - ".$value["medida"]."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stock_editar_producto">Stock</label>
                        <input class="form-control" type="text" id="stock_editar_producto" name="stock_editar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="punto_critico_editar_producto">Punto Critico</label>
                        <input class="form-control" type="text" id="punto_critico_editar_producto" name="punto_critico_editar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="costo_editar_producto">Costo</label>
                        <input class="form-control" type="text" id="costo_editar_producto" name="costo_editar_producto" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_1_editar">Margen 1</label>
                        <input class="form-control" type="number" step="0.5" id="margen_1_editar" name="margen_1_editar" value="0" onchange="cambio_valor_editar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_1_editar">Lista 1</label>
                        <input class="form-control" type="text" id="lista_1_editar" name="lista_1_editar" value="0" disabled/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_2_editar">Margen 2</label>
                        <input class="form-control" type="number" step="0.5" id="margen_2_editar" name="margen_2_editar" value="0" onchange="cambio_valor_editar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_2_editar">Lista 2</label>
                        <input class="form-control" type="text" id="lista_2_editar" name="lista_2_editar" value="0" disabled/>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_3_editar">Margen 3</label>
                        <input class="form-control" type="number" step="0.5" id="margen_3_editar" name="margen_3_editar" value="0" onchange="cambio_valor_editar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_3_editar">Lista 3</label>
                        <input class="form-control" type="text" id="lista_3_editar" name="lista_3_editar" value="0" disabled/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="margen_4_editar">Margen 4</label>
                        <input class="form-control" type="number" step="0.5" id="margen_4_editar" name="margen_4_editar" value="0" onchange="cambio_valor_editar()"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lista_4_editar">Lista 4</label>
                        <input class="form-control" type="text" id="lista_4_editar" name="lista_4_editar" value="0" disabled/>
                    </div>
                </div>
                
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="editar_producto()"><i class='fa fa-save'></i> Guardar Cambios</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- MODALES DE ABM PRODUCTOS-->
<div class="modal modal-default" id="modal_producto_agregado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Producto agregado</h4>
            </div>
            <div class="modal-body">
                <p class="text-center" style="font-size: 18px;color:#000;font-weight: bold;">PRODUCTO AGREGADO CORRECTAMENTE:</p>
                <input type="text" id="id_ultimo_producto_agregado" hidden="true"/>
                <div class="col-md-6">
                    <div class="small-box bg-green" style="cursor:pointer" onClick="ir_a_ubicaciones_producto_agregado()">
                        <div class="inner">
                          <h3><i class="fa fa-plus" style="font-size: 20px"></i></h3>

                          <p>Administrar Ubicaciones</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-send-o"></i>
                        </div>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="small-box bg-green" style="cursor:pointer" onClick="ir_a_precios_producto_agregado()">
                        <div class="inner">
                          <h3><i class="fa fa-plus" style="font-size: 20px"></i></h3>

                          <p>Precios Vigentes</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-dollar"></i>
                        </div>
                      </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="location.href='<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_listado'">Cerrar</button>
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
    
    function cambio_valor_agregar()
    {
        var costo = parseFloat($("#costo_agregar_producto").val());
        var margen_1_agregar = parseFloat($("#margen_1_agregar").val());
        var margen_2_agregar = parseFloat($("#margen_2_agregar").val());
        var margen_3_agregar = parseFloat($("#margen_3_agregar").val());
        var margen_4_agregar = parseFloat($("#margen_4_agregar").val());
        
        if(isNaN(costo))
        {
            costo=0;
            $("#costo_agregar_producto").val(0);
        };
        
        if(isNaN(margen_1_agregar))
        {
            margen_1_agregar=0;
            $("#margen_1_agregar").val(0);
        };
        
        if(isNaN(margen_2_agregar))
        {
            margen_2_agregar=0;
            $("#margen_2_agregar").val(0);
        };
        
        if(isNaN(margen_3_agregar))
        {
            margen_3_agregar=0;
            $("#margen_3_agregar").val(0);
        };
        
        if(isNaN(margen_4_agregar))
        {
            margen_4_agregar=0;
            $("#margen_4_agregar").val(0);
        };
        
        var lista_1_agregar = costo*margen_1_agregar;
        var lista_2_agregar = costo*margen_2_agregar;
        var lista_3_agregar = costo*margen_3_agregar;
        var lista_4_agregar = costo*margen_4_agregar;
        
        $("#lista_1_agregar").val(lista_1_agregar);
        $("#lista_2_agregar").val(lista_2_agregar);
        $("#lista_3_agregar").val(lista_3_agregar);
        $("#lista_4_agregar").val(lista_4_agregar);
        
    }
    
    function cambio_valor_editar()
    {
        var costo = parseFloat($("#costo_editar_producto").val());
        var margen_1_editar = parseFloat($("#margen_1_editar").val());
        var margen_2_editar = parseFloat($("#margen_2_editar").val());
        var margen_3_editar = parseFloat($("#margen_3_editar").val());
        var margen_4_editar = parseFloat($("#margen_4_editar").val());
        
        if(isNaN(costo))
        {
            costo=0;
            $("#costo_editar_producto").val(0);
        };
        
        if(isNaN(margen_1_editar))
        {
            margen_1_editar=0;
            $("#margen_1_editar").val(0);
        };
        
        if(isNaN(margen_2_editar))
        {
            margen_2_editar=0;
            $("#margen_2_editar").val(0);
        };
        
        if(isNaN(margen_3_editar))
        {
            margen_3_editar=0;
            $("#margen_3_editar").val(0);
        };
        
        if(isNaN(margen_4_editar))
        {
            margen_4_editar=0;
            $("#margen_4_editar").val(0);
        };
        
        var lista_1_editar = costo*margen_1_editar;
        var lista_2_editar = costo*margen_2_editar;
        var lista_3_editar = costo*margen_3_editar;
        var lista_4_editar = costo*margen_4_editar;
        
        $("#lista_1_editar").val(lista_1_editar);
        $("#lista_2_editar").val(lista_2_editar);
        $("#lista_3_editar").val(lista_3_editar);
        $("#lista_4_editar").val(lista_4_editar);
        
    }
    
    function modal_editar_producto(id,descripcion,stock,punto_critico,rubro,unidad_medida,costo,margen_1,lista_1,margen_2,lista_2,margen_3,lista_3,margen_4,lista_4)
    {
        $("#titulo_modal_editar_producto").text(descripcion);
        $("#id_producto_a_editar").val(id);
        $("#descripcion_editar_producto").val(descripcion);
        $("#stock_editar_producto").val(stock);
        $("#punto_critico_editar_producto").val(punto_critico);
        $("#rubro_editar_producto").val(rubro);
        $("#unidad_medida_editar_producto").val(unidad_medida);
        $("#costo_editar_producto").val(costo);
        
        $("#margen_1_editar").val(margen_1);
        $("#lista_1_editar").val(lista_1);
        $("#margen_2_editar").val(margen_2);
        $("#lista_2_editar").val(lista_2);
        $("#margen_3_editar").val(margen_3);
        $("#lista_3_editar").val(lista_3);
        $("#margen_4_editar").val(margen_4);
        $("#lista_4_editar").val(lista_4);
        
        $("#modal_editar_producto").modal("show");
    }
    
    function editar_producto()
    {
        var id_producto = $("#id_producto_a_editar").val();
        var descripcion = $("#descripcion_editar_producto").val();
        var stock = parseFloat($("#stock_editar_producto").val());
        var punto_critico = parseFloat($("#punto_critico_editar_producto").val());
        var rubro= parseInt($("#rubro_editar_producto").val());
        var rubro2= parseInt($("#rubro2_editar_producto").val());
        var unidad_medida= parseInt($("#unidad_medida_editar_producto").val());
        var unidad_medida2= parseInt($("#unidad2_medida_editar_producto").val());
        var costo = parseFloat($("#costo_editar_producto").val());
        var margen_1_editar = parseFloat($("#margen_1_editar").val());
        var margen_2_editar = parseFloat($("#margen_2_editar").val());
        var margen_3_editar = parseFloat($("#margen_3_editar").val());
        var margen_4_editar = parseFloat($("#margen_4_editar").val());
        
        if(descripcion != "" && stock != "" && !isNaN(stock)  && 
           punto_critico != "" && !isNaN(punto_critico) 
           && !isNaN(rubro) && !isNaN(unidad_medida) 
           && costo !="" && !isNaN(costo) && costo != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_producto",
                type: "POST",
                data:{id_producto:id_producto,descripcion:descripcion,stock:stock,punto_critico:punto_critico,rubro:rubro,unidad_medida:unidad_medida,rubro2:rubro2,unidad_medida2:unidad_medida2,costo:costo,margen_1:margen_1_editar,margen_2:margen_2_editar,margen_3:margen_3_editar,margen_4:margen_4_editar},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_listado";
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
            gestiona_error_edicion();
        }
    }
    
    function gestiona_error_edicion()
    {
        var descripcion = $("#descripcion_editar_producto").val();
        var stock = parseFloat($("#stock_editar_producto").val());
        var punto_critico = parseFloat($("#punto_critico_editar_producto").val());
        var rubro= parseInt($("#rubro_editar_producto").val());
        var unidad_medida= parseInt($("#unidad_medida_editar_producto").val());
        var costo = parseFloat($("#costo_editar_producto").val());
        
        if(descripcion == ""){activar_error("descripcion_editar_producto")}
        else{desactivar_error("descripcion_editar_producto")}
        
        if(stock != "" || isNaN(stock)){activar_error("stock_editar_producto")}
        else{desactivar_error("stock_editar_producto")}
        
        if(punto_critico == "" || isNaN(punto_critico)){activar_error("punto_critico_editar_producto")}
        else{desactivar_error("punto_critico_editar_producto")}
        
        if(isNaN(rubro) || rubro == ""){activar_error("rubro_editar_producto")}
        else{desactivar_error("rubro_editar_producto")}
        
        if(isNaN(unidad_medida) || unidad_medida==""){activar_error("unidad_medida_editar_producto")}
        else{desactivar_error("unidad_medida_editar_producto")}
        
        if(costo == "" || isNaN(costo)){activar_error("costo_editar_producto")}
        else{desactivar_error("costo_editar_producto")}
    }
    
    function agregar_producto()
    {
        var descripcion = $("#descripcion_agregar_producto").val();
        var stock = parseFloat($("#stock_agregar_producto").val());
        var punto_critico = parseFloat($("#punto_critico_agregar_producto").val());
        var rubro= parseInt($("#rubro_agregar_producto").val());
        var unidad_medida= parseInt($("#unidad_medida_agregar_producto").val());
        var costo = parseFloat($("#costo_agregar_producto").val());
        var margen_1_agregar = parseFloat($("#margen_1_agregar").val());
        var margen_2_agregar = parseFloat($("#margen_2_agregar").val());
        var margen_3_agregar = parseFloat($("#margen_3_agregar").val());
        var margen_4_agregar = parseFloat($("#margen_4_agregar").val());
        
        if(descripcion != "" && stock != "" && !isNaN(stock) &&
           punto_critico != "" && !isNaN(punto_critico) 
           && !isNaN(rubro) && !isNaN(unidad_medida) && costo !="" && !isNaN(costo))
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_producto",
                type: "POST",
                data:{descripcion:descripcion,stock:stock,punto_critico:punto_critico,rubro:rubro,unidad_medida:unidad_medida,costo:costo,margen_1_agregar:margen_1_agregar,margen_2_agregar:margen_2_agregar,margen_3_agregar:margen_3_agregar,margen_4_agregar:margen_4_agregar},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        $("#id_ultimo_producto_agregado").val(data);
                        $("#modal_agregar_producto").modal("hide");
                        $("#modal_producto_agregado").modal("show");
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
            gestiona_error_agregado();
        }
    }
    
    function ir_a_precios_producto_agregado()
    {
        var id= $("#id_ultimo_producto_agregado").val();
        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/precios_vigentes_de_producto/"+id;
    }
    
    function ir_a_ubicaciones_producto_agregado()
    {
        var id= $("#id_ultimo_producto_agregado").val();
        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/ubicaciones_de_producto/"+id;
    }
    
    function gestiona_error_agregado()
    {
        var descripcion = $("#descripcion_agregar_producto").val();
        var stock = parseFloat($("#stock_agregar_producto").val());
        var punto_critico = parseFloat($("#punto_critico_agregar_producto").val());
        var rubro= parseInt($("#rubro_agregar_producto").val());
        var unidad_medida= parseInt($("#unidad_medida_agregar_producto").val());
        var costo = parseFloat($("#costo_agregar_producto").val());
        
        if(descripcion == ""){activar_error("descripcion_agregar_producto")}
        else{desactivar_error("descripcion_agregar_producto")}
        
        if(isNaN(stock)){activar_error("stock_agregar_producto")}
        else{desactivar_error("stock_agregar_producto")}
        
        if(punto_critico == "" || isNaN(punto_critico)){activar_error("punto_critico_agregar_producto")}
        else{desactivar_error("punto_critico_agregar_producto")}
        
        if(isNaN(rubro) || rubro == ""){activar_error("rubro_agregar_producto")}
        else{desactivar_error("rubro_agregar_producto")}
        
        if(isNaN(unidad_medida) || unidad_medida =="" ){activar_error("unidad_medida_agregar_producto")}
        else{desactivar_error("unidad_medida_agregar_producto")}
        
        if(isNaN(costo) || costo == ""){activar_error("costo_agregar_producto")}
        else{desactivar_error("costo_agregar_producto")}
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
        
        $(".select2").select2();
      });
</script>
</body>
</html>


