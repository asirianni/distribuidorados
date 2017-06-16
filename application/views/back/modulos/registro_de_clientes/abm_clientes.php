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
        Listado de Clientes
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Registro de clientes</a></li>
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
                    <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/generar_excel_clientes" method="post" target="_blank" id="FormularioExportacion">
                        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    </form>
                    <button class="btn btn-danger" onClick="$('#modal_agregar_cliente').modal('show');return false;"><i class='fa fa-plus'></i> Agregar Cliente</button>
                    <p class="pull-right">
                        <button id="btn_exportar_excel" type="button" class="btn btn-success botonExcel" onClick="exportar_excel()" ><i class="fa fa-file-excel-o"></i> Exportar</button>&nbsp;&nbsp;
                        <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/imprimir_listado_clientes" target="_blank" class="btn btn-danger"><i class="fa  fa-print"></i> Imprimir</a>
                    </p>
                </div><!-- /.box-header -->
                <div class="box-body">
            
                        
                  <table id="Exportar_a_Excel" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>CUIL-DNI-CUIT</th>
                        <th>RAZON SOCIAL</th>
                        <th>LISTA</th>
                        <th>LOCALIDAD</th>
                        <th>TELEFONO</th>
                        <th>TIPO INSCRIPCION</th>
                        <th>LIMITE CUENTA</th>
                        <th>ESTADO</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_clientes as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["dni_cuit_cuil"]."</td>
                                    <td>".$value["razon_social"]."</td>
                                    <td>".$value["lista"]."</td>
                                    <td>".$value["desc_localidad"]."</td>
                                    <td>".$value["telefono"]."</td>
                                    <td>".$value["desc_inscripcion"]."</td>
                                    <td>".$value["limite_cuenta"]."</td>
                                    <td>".$value["desc_estado"]."</td>
                                    <td>
                                        <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' onClick='modal_editar_cliente(".$value["id"].")'><i class='fa fa-edit'></i></button>
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

<!-- MODALES DE ABM CLIENTES-->
<div class="modal modal-danger" id="modal_editar_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar cliente:</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" id="id_editar_cliente" hidden="true"/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dni_cuit_cuil_editar_cliente">Dni - Cuit - Cuil: </label>
                            <input class="form-control" type="number" id="dni_cuit_cuil_editar_cliente" name="dni_cuit_cuil_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="razon_social_editar_cliente">Razon Social: </label>
                            <input class="form-control" type="text" id="razon_social_editar_cliente" name="razon_social_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre_editar_cliente">Nombre: </label>
                            <input class="form-control" type="text" id="nombre_editar_cliente" name="nombre_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido_editar_cliente">Apellido: </label>
                            <input class="form-control" type="text" id="apellido_editar_cliente" name="apellido_editar_cliente" value=""/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_editar_cliente">Telefono: </label>
                            <input class="form-control" type="number" id="telefono_editar_cliente" name="telefono_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correo_editar_cliente">Correo: </label>
                            <input class="form-control" type="text" id="correo_editar_cliente" name="correo_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="limite_cuenta_editar_cliente">Limite Cuenta: </label>
                            <input class="form-control" type="number" step="0.5" value="0" id="limite_cuenta_editar_cliente" name="limite_cuenta_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lista_editar_cliente">Lista: </label>
                            <select class="form-control" id="lista_editar_cliente" name="lista_editar_cliente">
                                <option value="lista_1">lista_1</option>
                                <option value="lista_2">lista_2</option>
                                <option value="lista_3">lista_3</option>
                                <option value="lista_4">lista_4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion_editar_cliente">Direccion: </label>
                            <input class="form-control" type="text" id="direccion_editar_cliente" name="direccion_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contrasenia_editar_cliente">Contraseña web (OP)</label>
                            <input class="form-control" type="text" id="contrasenia_editar_cliente" name="contrasenia_editar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descuento_gral_editar_cliente">Descuento General</label>
                            <select class="form-control" id="descuento_gral_editar_cliente" name="descuento_gral_editar_cliente">
                                <?php 
                                foreach($listado_de_descuentos as $value)
                                {
                                    echo "<option value='".$value["valores"]."'>".$value["valores"]."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ingresos_brutos_editar_cliente">Ing. Brutos: </label>
                            <input type="text" class="form-control" id="ingresos_brutos_editar_cliente" name="ingresos_brutos_editar_cliente">
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localidad_editar_cliente">Localidad: </label>
                            <select class="form-control" id="localidad_editar_cliente" name="localidad_editar_cliente" disabled>
                                <?php
                                    foreach($listado_localidades as $value)
                                    {
                                        echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localidad2_editar_cliente">Cambiar localidad: </label>
                            <select class="form-control select2" style="width: 100% !important;" id="localidad2_editar_cliente" name="localidad2_editar_cliente">
                                <option value="0">Seleccione nueva localidad</option>
                                <?php
                                    foreach($listado_localidades as $value)
                                    {
                                        echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_inscripcion_editar_cliente">Tipo Inscripcion: </label>
                            <select class="form-control" id="tipo_inscripcion_editar_cliente" name="tipo_inscripcion_editar_cliente" disabled>
                                <?php
                                    foreach($lista_tipos_inscripciones as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["inscripcion"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_inscripcion2_editar_cliente">Cambiar Tipo Inscripcion: </label>
                            <select class="select2" style="width: 100% !important;" id="tipo_inscripcion2_editar_cliente" name="tipo_inscripcion2_editar_cliente" >
                                <option value="0">Seleccione nueva inscripcion</option>
                                <?php
                                    foreach($lista_tipos_inscripciones as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["inscripcion"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado_editar_cliente">Estado</label>
                            <select class="form-control" id="estado_editar_cliente" name="estado_editar_cliente" disabled>
                                <?php
                                    foreach($lista_estados_cliente as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["estado"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado2_editar_cliente">Cambiar el estado</label>
                            <select class="select2" style="width: 100% !important;" id="estado2_editar_cliente" name="estado2_editar_cliente">
                                <option value="0">Seleccione nuevo estado</option>
                                <?php
                                    foreach($lista_estados_cliente as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["estado"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p id="mensaje_error_editar_cliente" style="font-weight: bold;color: #00F;font-size: 15px;"></p>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="editar_cliente()"><i class='fa fa-save'></i> Guardar Cambios</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_agregar_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar cliente:</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dni_cuit_cuil_agregar_cliente">Dni - Cuit - Cuil: </label>
                            <input class="form-control" type="number" id="dni_cuit_cuil_agregar_cliente" name="dni_cuit_cuil_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="razon_social_agregar_cliente">Razon Social: </label>
                            <input class="form-control" type="text" id="razon_social_agregar_cliente" name="razon_social_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre_agregar_cliente">Nombre: </label>
                            <input class="form-control" type="text" id="nombre_agregar_cliente" name="nombre_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido_agregar_cliente">Apellido: </label>
                            <input class="form-control" type="text" id="apellido_agregar_cliente" name="apellido_agregar_cliente" value=""/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_agregar_cliente">Telefono: </label>
                            <input class="form-control" type="number" id="telefono_agregar_cliente" name="telefono_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correo_agregar_cliente">Correo: </label>
                            <input class="form-control" type="text" id="correo_agregar_cliente" name="correo_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="limite_cuenta_agregar_cliente">Limite Cuenta: </label>
                            <input class="form-control" type="number" step="0.5" value="0" id="limite_cuenta_agregar_cliente" name="limite_cuenta_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lista_agregar_cliente">Lista: </label>
                            <select class="form-control" id="lista_agregar_cliente" name="lista_agregar_cliente">
                                <option value="lista_1">lista_1</option>
                                <option value="lista_2">lista_2</option>
                                <option value="lista_3">lista_3</option>
                                <option value="lista_4">lista_4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion_agregar_cliente">Direccion: </label>
                            <input class="form-control" type="text" id="direccion_agregar_cliente" name="direccion_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contrasenia_agregar_cliente">Contraseña web (OP)</label>
                            <input class="form-control" type="text" id="contrasenia_agregar_cliente" name="contrasenia_agregar_cliente" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="descuento_gral_agregar_cliente">Descuento General</label>
                            <select class="form-control" id="descuento_gral_agregar_cliente" name="descuento_gral_agregar_cliente">
                            <?php 
                                foreach($listado_de_descuentos as $value)
                                {
                                    echo "<option value='".$value["valores"]."'>".$value["valores"]."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localidad_agregar_cliente">Localidad: </label>
                            <select class="form-control  select2" style="width: 100% !important;" id="localidad_agregar_cliente" name="localidad_agregar_cliente">
                                
                                <?php
                                    foreach($listado_localidades as $value)
                                    {
                                        echo "<option value='".$value["codigo"]."'>".$value["localidad"]." - ".$value["desc_provincia"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ingresos_brutos_agregar_cliente">Ing. Brutos: </label>
                            <input type="text" class="form-control" id="ingresos_brutos_agregar_cliente" name="ingresos_brutos_agregar_cliente">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_inscripcion_agregar_cliente">Tipo Inscripcion: </label>
                            <select class="form-control select2" style="width: 100% !important;" id="tipo_inscripcion_agregar_cliente" name="tipo_inscripcion_agregar_cliente">
                                <?php
                                    foreach($lista_tipos_inscripciones as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["inscripcion"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado_agregar_cliente">Estado</label>
                            <select class="form-control" id="estado_agregar_cliente" name="estado_agregar_cliente" value="1">
                                <?php
                                    foreach($lista_estados_cliente as $value)
                                    {
                                        if((int)$value["id"] == 1)
                                        {
                                            echo "<option value='".$value["id"]."' selected>".$value["estado"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$value["id"]."'>".$value["estado"]."</option>";
                                        }
                                    }
                                            
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p id="mensaje_error_agregar_cliente" style="font-weight: bold;color: #00F;font-size: 15px;"></p>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_cliente()"><i class='fa fa-save'></i> Guardar Cliente</button>
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
                $("#lista_editar_cliente").val(data["lista"]);
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
        var telefono = $("#telefono_editar_cliente").val();
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
        var lista = $("#lista_editar_cliente").val()
        var limite_cuenta = $("#limite_cuenta_editar_cliente").val();
        
        if(limite_cuenta == "")
        {
            limite_cuenta=0;
        }
        else
        {
            limite_cuenta = parseFloat($("#limite_cuenta_editar_cliente").val());
        }
        
        /*if  (dni_cuit_cuil != "" && !isNaN(dni_cuit_cuil) && !isNaN(limite_cuenta) &&
             razon_social != "" && nombre != "" && apellido != "" &&
             telefono != "" && correo != "" && validarEmail(correo) &&
             direccion !="" && localidad != "" && !isNaN(localidad) && localidad != 0 &&
             tipo_inscripcion != "" && !isNaN(tipo_inscripcion) && tipo_inscripcion != 0 && estado != "" && !isNaN(estado) && estado != 0
            )
        {*/
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
                    lista:lista,
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
                        alert("No se ha podido editar");
                    }
                },
                error: function(event){alert(event.responseText);
                },
            });    
        /*}
        else
        {
            gestiona_errores_editar();
            $("#mensaje_error_editar_cliente").text("Por favor complete todos los campos");
        }*/
    }
    
    function agregar_cliente()
    {
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_agregar_cliente").val());
        var razon_social = $("#razon_social_agregar_cliente").val();
        var nombre = $("#nombre_agregar_cliente").val();
        var apellido = $("#apellido_agregar_cliente").val();
        var telefono = $("#telefono_agregar_cliente").val();
        var correo = $("#correo_agregar_cliente").val();
        var direccion = $("#direccion_agregar_cliente").val();
        var contrasenia = $("#contrasenia_agregar_cliente").val();
        var localidad = parseInt($("#localidad_agregar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_agregar_cliente").val());
        var estado = parseInt($("#estado_agregar_cliente").val());
        var descuento_gral= $("#descuento_gral_agregar_cliente").val();
        var ingresos_brutos = $("#ingresos_brutos_agregar_cliente").val();
        var lista = $("#lista_agregar_cliente").val();
        var limite_cuenta = $("#limite_cuenta_agregar_cliente").val();
        
        if(limite_cuenta == "")
        {
            limite_cuenta =0;
        }
        else
        {
            limite_cuenta = parseFloat($("#limite_cuenta_agregar_cliente").val());
        }
        
        /*if  (dni_cuit_cuil != "" && !isNaN(dni_cuit_cuil) && !isNaN(limite_cuenta) &&
             razon_social != ""  && nombre != "" && apellido != "" &&
             telefono != "" && correo != "" && validarEmail(correo) &&
             direccion !="" && localidad != "" && !isNaN(localidad) && localidad != 0 &&
             tipo_inscripcion != "" && !isNaN(tipo_inscripcion) && tipo_inscripcion != 0 && estado != "" && !isNaN(estado) && estado != 0
            )
        {*/
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
                    lista:lista,
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
                error: function(event){alert("Error: Asegurese que el cliente no haya sido agregado");
                },
            });    
        /*}
        else
        {
            gestiona_errores_agregar();
            $("#mensaje_error_agregar_cliente").text("Por favor complete todos los campos");
        }*/
    }
    
    function gestiona_errores_agregar()
    {
        
        var razon_social = $("#razon_social_agregar_cliente").val();
        var nombre = $("#nombre_agregar_cliente").val();
        var apellido = $("#apellido_agregar_cliente").val();
        var telefono = $("#telefono_agregar_cliente").val();
        var correo = $("#correo_agregar_cliente").val();
        var direccion = $("#direccion_agregar_cliente").val();
        
        var localidad = parseInt($("#localidad_agregar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_agregar_cliente").val());
        var estado = parseInt($("#estado_agregar_cliente").val());
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_agregar_cliente").val());
        var limite_cuenta = parseFloat($("#limite_cuenta_agregar_cliente").val());
         
        if(razon_social==""){activar_error("razon_social_agregar_cliente");}
        else{desactivar_error("razon_social_agregar_cliente");}
        
        
        if(nombre==""){activar_error("nombre_agregar_cliente");}
        else{desactivar_error("nombre_agregar_cliente");}
        
        if(apellido==""){activar_error("apellido_agregar_cliente");}
        else{desactivar_error("apellido_agregar_cliente");}
        
        if(telefono==""){activar_error("telefono_agregar_cliente");}
        else{desactivar_error("telefono_agregar_cliente");}
        
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
        
        if(isNaN(limite_cuenta) ){activar_error("limite_cuenta_agregar_cliente");}
        else{desactivar_error("limite_cuenta_agregar_cliente");}
    }
    
    function gestiona_errores_editar()
    {
        
        var razon_social = $("#razon_social_editar_cliente").val();
        var nombre = $("#nombre_editar_cliente").val();
        var apellido = $("#apellido_editar_cliente").val();
        var telefono = $("#telefono_editar_cliente").val();
        var correo = $("#correo_editar_cliente").val();
        var direccion = $("#direccion_editar_cliente").val();
        
        var localidad = parseInt($("#localidad_editar_cliente").val());
        var tipo_inscripcion = parseInt($("#tipo_inscripcion_editar_cliente").val());
        var estado = parseInt($("#estado_editar_cliente").val());
        var dni_cuit_cuil = parseInt($("#dni_cuit_cuil_editar_cliente").val());
        var limite_cuenta = parseFloat($("#limite_cuenta_editar_cliente").val());
         
        if(razon_social==""){activar_error("razon_social_editar_cliente");}
        else{desactivar_error("razon_social_editar_cliente");}
        
        
        
        if(nombre==""){activar_error("nombre_editar_cliente");}
        else{desactivar_error("nombre_editar_cliente");}
        
        if(apellido==""){activar_error("apellido_editar_cliente");}
        else{desactivar_error("apellido_editar_cliente");}
        
        if(telefono==""){activar_error("telefono_editar_cliente");}
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
        
        if(isNaN(limite_cuenta)){activar_error("limite_cuenta_editar_cliente");}
        else{desactivar_error("limite_cuenta_editar_cliente");}
    }
    //
    
   
    
    
    
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


