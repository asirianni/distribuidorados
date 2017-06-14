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
        Reporte de Caja
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-bar-chart"></i> Reportes</a></li>
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
                    <div class="pull-right">
                        <button  class="btn btn-warning" onClick="$('#formulario_impresion').submit();return false;" ><i class="fa fa-print"></i> Imprimir</button>
                        <button  class="btn btn-success" onclick="exportar_a_excel();return false;"><i class="fa fa-file-excel-o"></i> Exportar a Excel</button>
                    </div>      
                    <div class="col-md-12" style="margin-top: 10px;">
                        <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/reporte_de_caja" method="post" id="formulario_consultar_remito">
                            <div class="col-md-12">
                                <p style="color: #333;font-size: 19px;font-weight: bold;margin-bottom: 12px;">CONSULTE HISTORIAL</p>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="desde_consultar">Desde</label>
                                    <?php
                                        if($desde_consultar != null)
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='desde_consultar' name='desde_consultar' value='".$desde_consultar."'>";
                                        }
                                        else
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='desde_consultar' name='desde_consultar' value='".Date('Y-m')."-01'>";
                                        }
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="hasta_consultar">Hasta</label>
                                    <?php
                                        if($hasta_consultar != null)
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='hasta_consultar' name='hasta_consultar' value='".$hasta_consultar."'>";
                                        }
                                        else
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='hasta_consultar' name='hasta_consultar' value='".Date('Y-m-d')."'>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button  class="form-control btn btn-primary" id="btn_consultar" ><i class="fa fa-search-minus"></i> Consultar</button>
                                </div>
                            </div>
                                
                            
                        </form>
                    </div>
                </div><!-- /.box-header -->
                
                <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/exportar_reporte_caja" method="post" target="_blank" id="FormularioExportacion" hidden="">
                    <input type="text" name="desde_imprimir" value="<?php echo $desde_consultar?>">
                    <input type="text" name="hasta_imprimir" value="<?php echo $hasta_consultar?>">
                    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                </form>

                <!-- FORMULARIO PARA IMPRIMIR LISTA -->
                <form id="formulario_impresion" action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/imprimir_reporte_caja" method="post" target="_blank" style="display: none;">
                    <input type="text" name="desde_imprimir" value="<?php echo $desde_consultar?>">
                    <input type="text" name="hasta_imprimir" value="<?php echo $hasta_consultar?>">
                </form>
                <!-- FIN FORMULARIO PARA IMPRIMIR LISTA-->
                
                
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>ENTRADAS</th>
                        <th>SALIDAS</th>
                        <th>SALDO</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $suma_entradas = 0.0;
                            $suma_salidas = 0.0;
                            $suma_saldos = 0.0;
                            
                            foreach($listado_caja as $value)
                            {
                                $suma_entradas+= (float)$value["entradas"];
                                $suma_salidas+= (float)$value["salidas"];
                                $suma_saldos+= (float)$value["saldo"];
                                echo "
                                <tr>
                                    <td>".$value["fecha"]."</td>
                                    <td>".$value["entradas"]."</td>
                                    <td>".$value["salidas"]."</td>
                                    <td>".$value["saldo"]."</td>
                                    <td>".$value["estado"]."</td>
                                </tr>";
                            }
                        ?>  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <th><?php echo $suma_entradas?></th>
                            <th><?php echo $suma_salidas?></th>
                            <th><?php echo $suma_saldos?></th>
                            <td></td>
                        </tr>
                      
                    </tfoot>
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

<div class="modal modal-warning" id="modal_agregar_remito">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un remito:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""></label>
                        <input class="form-control" type="text" id=""/>
                    </div>
                </div>
                
                
                
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="agregar_remito()"><i class='fa fa-save'></i> Guardar Remito</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-warning" id="modal_editar_chofer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar chofer:</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_editar_chofer" hidden=""/>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cuit_editar_chofer">Cuit: </label>
                        <input class="form-control" type="text" id="cuit_editar_chofer"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre_editar_chofer">Nombre: </label>
                        <input class="form-control" type="text" id="nombre_editar_chofer"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido_editar_chofer">Apellido: </label>
                        <input class="form-control" type="text" id="apellido_editar_chofer"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion_editar_chofer">Direccion: </label>
                        <input class="form-control" type="text" id="direccion_editar_chofer"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono_editar_chofer">Telefono: </label>
                        <input class="form-control" type="text" id="telefono_editar_chofer"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_editar_chofer">Estado: </label>
                        <select class="form-control" type="text" id="estado_editar_chofer">
                            <option value="operativo">operativo</option>
                            <option value="cancelado">cancelado</option>
                            <option value="suspendido">suspendido</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localidad_editar_chofer">Localidad: </label>
                        <select class="form-control" type="text" id="localidad_editar_chofer" disabled>
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
                        <label for="localidad2_editar_chofer">Seleccione nueva localidad: </label>
                        <select class="form-control select2" style="width: 100%;" type="text" id="localidad2_editar_chofer">
                            <option value="0">Seleccione</option>
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
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-warning" onClick="editar_chofer()"><i class='fa fa-save'></i> Guardar Cambios</button>
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
    
    function exportar_a_excel()
    {
	$("#datos_a_enviar").val( $("<div>").append( $("#tabla_listado").eq(0).clone()).html());
	$("#FormularioExportacion").submit();
    }


    $("#btn_consultar").click(function(event){
        var respuesta = false;
        
        var desde = $("#desde_consultar").val();
        var hasta = $("#hasta_consultar").val();
        
        if(desde != "" && hasta != "")
        {
            respuesta = true;
        }
        else
        {
            gestiona_errores_consultar();
        }
        
        return respuesta;
    });
    
    function gestiona_errores_consultar()
    {
        var desde = $("#desde_consultar").val();
        var hasta = $("#hasta_consultar").val();
        
        if(desde==""){activar_error("desde_consultar");}
        else{desactivar_error("desde_consultar");}
        
        if(hasta==""){activar_error("hasta_consultar");}
        else{desactivar_error("hasta_consultar");}
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
      
</script>
</body>
</html>


