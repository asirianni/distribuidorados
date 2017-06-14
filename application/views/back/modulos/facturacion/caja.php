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
        Caja Diaria
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-calculator"></i> Facturacion</a></li>
        <!--<li class="active">Dashboard</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class='row'>
                    <div class='col-md-4 col-sm-4'>
                        <div class='box box-default'>
                            <div class='box-body'>
                                <div class='alert alert-info alert-dismissable'>
                                    <div class='margin'>
                                        <div class='btn-group'>
                                            <label class='control-label'>Fecha</label>
                                            <input type='text' class='form-control fecha' name='fecha' value='<?php echo $fecha?>' id='datepicker' >
                                            <button type='button' class='btn btn-info' onclick='listar();'> Listar </button>
                                            
                                            <button type='button' class='btn btn-info' onclick='modal_movimiento_caja();'>
                                                Movimiento (+ / -) 
                                            </button>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-8 col-sm-8'>
                        <div class='box box-default'>
                            <div class='box-body'>
                                <div class='col-lg-4 col-sm-4 col-xs-8'>
                                    <!-- small box -->
                                    <div class='small-box bg-green'>
                                      <div class='inner'>
                                        <h3><?php echo $entradas?><sup style='font-size: 20px'>$</sup></h3>
                                        <p>Entradas</p>
                                      </div>
                                      <div class='icon'>
                                        <i class='ion ion-stats-bars'></i>
                                      </div>
                                      <a href='#' class='small-box-footer'><i class='fa fa-arrow-circle-right'></i> de caja</a>
                                    </div>
                                </div>
                                <div class='col-lg-4 col-sm-4 col-xs-8'>
                                    <!-- small box -->
                                    <div class='small-box bg-red'>
                                      <div class='inner'>
                                        <h3><?php echo $salidas?><sup style='font-size: 20px'>$</sup></h3>
                                        <p>Salidas</p>
                                      </div>
                                      <div class='icon'>
                                        <i class='ion ion-stats-bars'></i>
                                      </div>
                                       <a href='#' class='small-box-footer'><i class='fa fa-arrow-circle-right'></i> de caja</a>
                                    </div>
                                </div>
                                <div class='col-lg-4  col-sm-4 col-xs-8'>
                                    <!-- small box -->
                                    <div class='small-box bg-yellow'>
                                      <div class='inner'>
                                        <h3><?php echo $total?><sup style='font-size: 20px'>$</sup></h3>
                                        <p>Saldos</p>
                                      </div>
                                      <div class='icon'>
                                        <i class='ion ion-pie-graph'></i>
                                      </div>
                                      <a href='#' class='small-box-footer'><i class='fa fa-arrow-circle-right'></i> de caja</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class='row'>
                  <div class='col-md-12'>
                        <div class='box box-default'>
                            <div class='box-header'>
                                <h3 class='box-title'>Detalle de caja</h3>
                            </div>
                            <div class='box-body'>
                                <div class='row'>
                                <div class='col-sm-12'>
                                    <table class='table table-bordered table-hover dataTable'>
                                        <thead>
                                                <tr>
                                                      <th>Fecha</th>
                                                      <th>Tipo</th>
                                                      <th>Comprobante</th>
                                                      <th>Entrada</th>
                                                      <th>Salida</th>
                                                      <th>Acciones</th>
                                                </tr>
                                        </thead>   
                                        <tbody>
                                            <?php foreach ($listado_entradas as $e) {?>
                                                    
                                                <tr>
                                                        <td><?php echo $e["fecha"]?></td>
                                                        <td><?php echo $e["tipo"]?></td>
                                                        <td><?php echo $e["comprobante"]?></td>
                                                        <td><?php echo $e["importe"]?></td>
                                                        <td></td>
                                                        <td>
                                                            <a class='btn btn-success' href='#' onclick='acciones_sobre_registro(1, <?php echo $e["tipo_cod_comp"]?>, <?php echo $e["comprobante"]?> );'>
                                                                <i class='fa fa-search'></i>                                          
                                                            </a>
                                                            <?php if($fecha == Date("Y-m-d")){
                                                                    echo "<a class='btn btn-danger' href='#' onclick='acciones_sobre_registro(2,".$e["tipo_cod_comp"].",".$e["comprobante"].");'>
                                                                            <i class='fa fa-trash-o'></i> 
                                                                    </a>";
                                                            }?>
                                                            <a class='btn btn-warning' href='#' onclick='acciones_sobre_registro(3,<?php echo $e["tipo_cod_comp"]?>,<?php echo $e["comprobante"]?>);'>
                                                                <i class='fa fa-print'></i>                                          
                                                            </a>
                                                        </td>
                                                </tr>
                                            <?php }?>
                                            <?php foreach ($listado_salidas as $s) { 
                                                echo "<tr>
                                                        <td>".$s["fecha"]."</td>
                                                        <td>".$s["tipo"]."</td>
                                                        <td>".$s["comprobante"]."</td>
                                                        <td></td>
                                                        <td>".$s["importe"]."</td>
                                                        <td>
                                                            <a class='btn btn-success' href='#' onclick='acciones_sobre_registro(1, ".$s["tipo_cod_comp"].", ".$s["comprobante"]." );'>
                                                                <i class='fa fa-search'></i>                                               
                                                            </a>";
                                                            if($fecha == Date("Y-m-d")){
                                                                echo "
                                                                            <a class='btn btn-danger' href='#' onclick='acciones_sobre_registro(2, ".$s["tipo_cod_comp"].", ".$s["comprobante"]." );'>
                                                                                <i class='fa fa-trash-o'></i> 
                                                                            </a>
                                                                          ";
                                                            }
                                                            echo "<a class='btn btn-warning' href='#' onclick='acciones_sobre_registro(3, ".$s["tipo_cod_comp"].", ".$s["comprobante"]." );'>
                                                                <i class='fa fa-print'></i>                                          
                                                            </a>
                                                        </td>
                                                </tr>";
                                            }?>

                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
               </div><!-- /.row -->
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
 <!-- MODALES -->
    <div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <p class="text-center" style="font-size: 20px; color: #0073b7;" id="mensaje-alert"></p>
                        </div>
                  <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModalMovimientoCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="box">
                        <div class="box-header">
                            <h3>Moviento de Caja</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="">
                            <?php
                                $attributes = array('id' => 'registrar_gasto', 'name' => 'formulario_registrar_gasto');
                                echo form_open("$controller_usuario/registrar_movimiento", $attributes);
                                    echo "<label>Fecha</label>";
                                    echo "<input type='text' id='fecha_agregar_mov' name='fecha' class='form-control fecha'>";
                                    echo "<br/>";
                                    echo "<select name='concepto' class='form-group' required='required'>";
                                    echo "	<option value ='e'>Entrada de Caja</option>";
                                    echo "	<option value ='s'>Salida de caja</option>";
                                    echo "</select>";
                                    echo "<input type='number' step='any' name='importe' class='form-control' required='required' placeholder='importe'/>";
                                    echo "<input type='text' name='detalle' class='form-control' required='required' placeholder='detalle'/>";
                                    echo "<input type='submit' class='btn btn-medium btn-default btn-square' value='Registrar'/>";
                                echo form_close();
                            ?>
                    </div>
                  <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- FIN DE MODAL-->	
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

<?php
    echo $js;
?>

 <script>
        jQuery('.fecha').datetimepicker({
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
                    
        function modal_movimiento_caja()
        {
            $("#fecha_agregar_mov").val($("#datepicker").val());
            $("#myModalMovimientoCaja").modal("show");
        }
        
        function listar(){
            if(validarFecha()){
                location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/caja/"+document.getElementById('datepicker').value;
            }
        }
    
        function validarFecha(){
            var fecha=document.getElementById('datepicker').value;
            if(fecha===""){
                alert("Ingrese fecha de caja a consultar");
                return false;
            }else{
                return true;
            }
        }
    
        function acciones_sobre_registro (tipo_accion, tipo_comp, num_comp){
        //si es 1 es ver detalle sino es eliminar. las 2 posibles acciones sobre el registro.
        if(tipo_accion==1)
        {
          if(tipo_comp == 1)
          {
              location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/ver_factura/"+num_comp;
          }
          else if(tipo_comp == 5)
          {
            $.ajax({
                 type:"POST",
                 url: "<?php echo base_url()?>index.php/Response_Ajax/mostrar_datos_movimiento_caja",
                 data:{comprobante:num_comp},

                 beforeSend: function(event){},
                 success: function(data){
                     alert(data);
                     data = JSON.parse(data);

                     $("#cuerpo-modal").html(data);
                     $("#modal").modal("show");

                 },
                 error: function(event){alert("error");},
             });   
          }
        }
        else if (tipo_accion==2)
        {

            if (confirm('¿ELIMINAR DE LA CAJA??')) { 
                
              
               $.ajax({
                    type: "POST",
                    url: "<?php echo base_url()?>index.php/Response_Ajax/eliminar_movimiento",
                    data: {codigo:num_comp},

                    beforeSend: function (event){
                    },

                    success: function (data) {
                        listar();
                    },

                    error: function (event){
                        alert("Error");
                    },

                  });  
           }
        }
        else if (tipo_accion==3)
        {
            if(tipo_comp == 1)
            {
                window.open("<?php echo base_url();?>index.php/<?php echo $controller_usuario?>/imprimir_factura/"+num_comp);
            }
            else if(tipo_comp == 7)
            {
                window.open("<?php echo base_url();?>index.php/<?php echo $controller_usuario?>/imprimir_datos_movimiento_caja/"+num_comp);
            }
        }
    }
        function alert2(mensaje)
        {
            $("#mensaje-alert").text(mensaje);
            $("#modal-alert").modal("show");
            
        }
        
         $(function () {
            $("#example1").DataTable();
            $("#example2").DataTable();
          });
    </script>
</body>
</html>


