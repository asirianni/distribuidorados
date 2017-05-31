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
        Listado de Cuentas Clientes
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
      <!-- FORMULARIO PARA IMPRIMIR-->
      <form id="formulario_imprimir_lista" target="_blank" action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/imprimir_cuentas_clientes" method="post" hidden="">
          <input type="text" id="desde_imprimir" name="desde_imprimir" value="<?php echo $desde_consultar?>">
          <input type="text" id="hasta_imprimir" name="hasta_imprimir" value="<?php echo $hasta_consultar?>">
          <input type="text" id="tipo_imprimir" name="tipo_imprimir" value="<?php echo $tipo_consultar?>">
          <input type="text" id="cliente_imprimir" name="cliente_imprimir" value="<?php echo $cliente_consultar?>">
      </form>
      <!-- FIN FORMULARIO PARA IMPRIMIR -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/generar_excel_cuentas_clientes" method="post" target="_blank" id="FormularioExportacion" hidden>
                        <input type="text" id="desde_imprimir" name="desde_imprimir" value="<?php echo $desde_consultar?>">
                        <input type="text" id="hasta_imprimir" name="hasta_imprimir" value="<?php echo $hasta_consultar?>">
                        <input type="text" id="tipo_imprimir" name="tipo_imprimir" value="<?php echo $tipo_consultar?>">
                        <input type="text" id="cliente_imprimir" name="cliente_imprimir" value="<?php echo $cliente_consultar?>">
                        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    </form>
                    <p class="pull-right">
                        <button id="btn_exportar_excel" type="button" class="btn btn-success botonExcel" onClick="exportar_excel()" ><i class="fa fa-file-excel-o"></i> Exportar</button>&nbsp;&nbsp;
                        <button  class="btn btn-danger" onclick="$('#formulario_imprimir_lista').submit();"><i class="fa  fa-print"></i> Imprimir</button>
                    </p>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <form action='<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/estados_de_cuentas' method='post'>
                            <div class="col-md-2">
                                <label>Fecha desde</label>
                                <input type="text" class="form-control datetimepicker" name="desde_consultar" value="<?php echo $desde_consultar?>"/>
                            </div>
                            <div class="col-md-2">
                                <label>Fecha hasta</label>
                                <input type="text" class="form-control datetimepicker" name="hasta_consultar" value="<?php echo $hasta_consultar?>"/>
                            </div>
                            <div class="col-md-2">
                                <label>Tipo</label>
                                <select class="form-control" name="tipo_consultar">
                                    
                                    <?php
                                        $opciones = Array("todos","entrada","salida");
                                        
                                        for($i=0; $i < count($opciones);$i++)
                                        {
                                            if($opciones[$i] == $tipo_consultar)
                                            {
                                                echo "<option value='".$opciones[$i]."' selected>".$opciones[$i]."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$opciones[$i]."'>".$opciones[$i]."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Cliente</label>
                                <select class="form-control select2" style="width: 100%" name="cliente_consultar" value="">
                                    <option value="todos">Todos</option>
                                    <?php
                                    foreach($listado_clientes as $value)
                                    {
                                        if($cliente_consultar == $value["id"])
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
                            <div class="col-md-3">
                                <label></label>
                                <button class="form-control btn btn-danger" id="btn_consultar"><i class="fa fa-search-minus"></i> Consultar</button>
                            </div>
                        </form>
                    </div>
                        
            <div style="margin-top: 20px;">&nbsp;</div>
            <div class="col-md-12">
                <p style="margin-bottom: 20px;"><button class="btn btn-danger" onClick="$('#modal_agregar_movimiento').modal('show');"><i class="fa fa-plus"></i> Agregar Movimiento</button></p>
                  <table id="Exportar_a_Excel" class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>CLIENTE</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                        <th>USUARIO</th>
                        <th>OPERACIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_cuentas_clientes as $value)
                            {
                                $importe_recibo = (float)$value["importe_recibo"];
                                $importe_factura = (float)$value["importe_factura"];
                                
                                echo 
                                "<tr>
                                    <td>".$value["fecha"]."</td>
                                    <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>";
                                    if($importe_recibo != 0)
                                    {
                                        echo "<td>".$importe_recibo."</td>";
                                        echo "<td>0</td>";
                                    }
                                    else if($importe_factura != 0)
                                    {
                                        echo "<td>0</td>";
                                        echo "<td>".$importe_factura."</td>";
                                    }
                                        
                              echo "<td>".$value["desc_usuario"]."</td>";
                              
                                    // OPERACIONES
                                    echo "<td>";
                                        if($importe_factura != 0 && (int)$value["numero_factura"] != 0)
                                        {
                                            echo "<a class='btn btn-danger'  data-toggle='tooltip' title='' data-original-title='Ver factura' href='".base_url()."index.php/".$controller_usuario."/ver_factura/".$value["numero_factura"]."'>Ver Factura</a>";
                                        }
                                            echo "&nbsp;<a target='_blank' data-toggle='tooltip' title='' data-original-title='Imprimir' class='btn btn-danger' href='".base_url()."index.php/".$controller_usuario."/imprimir_cuenta_cliente/".$value["id"]."'><i class='fa fa-print'></i></a>";
                                    echo "</td>
                                </tr>";
                            }
                        ?>  
                    </tbody>
                  </table>
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

<div class="modal modal-danger" id="modal_agregar_movimiento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar movimiento:</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cliente_agregar_movimiento">Cliente: </label>
                            <select class="form-control select2" style="width: 100%;" id="cliente_agregar_movimiento">
                                <?php
                                    foreach($listado_clientes as $value)
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["dni_cuit_cuil"]." - ".$value["nombre"]." ".$value["apellido"]."</option>";
                                    }
                                            
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="concepto_agregar_movimiento">Concepto: </label>
                            <select class="form-control select2" style="width: 100%;" id="concepto_agregar_movimiento">
                                <option value="entrada">entrada</option>
                                <option value="salida">salida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="importe_agregar_movimiento">Importe: </label>
                            <input class="form-control" type="number" step="0.5" value="0" id="importe_agregar_movimiento">
                       </div>
                    </div>
                    
                </div> 
                <div class="clearfix"></div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="guardar_movimiento()"><i class='fa fa-save'></i> Guardar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div>
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
    
    function guardar_movimiento()
    {
        var cliente = parseInt($("#cliente_agregar_movimiento").val());
        var concepto = $("#concepto_agregar_movimiento").val();
        var importe= parseFloat($("#importe_agregar_movimiento").val());
        
        var seguir = true;
        
        if(cliente=="" || isNaN(cliente)){activar_error("cliente_agregar_movimiento");seguir=true;}
        else{desactivar_error("cliente_agregar_movimiento");}
        
        if(concepto==""){activar_error("concepto_agregar_movimiento");seguir=true;}
        else{desactivar_error("concepto_agregar_movimiento");}
        
        if(importe=="" || isNaN(importe)){activar_error("importe_agregar_movimiento");seguir=true;}
        else{desactivar_error("importe_agregar_movimiento");}
        
        
        if(seguir)
        {
            var importe_recibo = null;
            var importe_factura=null;
            
            if(concepto == "entrada")
            {
                importe_recibo=importe;
            }
            else
            {
                importe_factura = importe;
            }
            
            $.ajax({
            url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_movimiento_cuenta_cliente",
            type: "POST",
            data:{cliente:cliente,importe_recibo:importe_recibo,numero_factura:null,tipo_factura:null,importe_factura:importe_factura},
            success: function(data)
            {
                data= JSON.parse(data);
                
                if(data)
                {
                    location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/estados_de_cuentas";
                }
            },
            error: function(event){alert(event.responseText);
            },
        });    
        }
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
        $('#Exportar_a_Excel').DataTable({
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


