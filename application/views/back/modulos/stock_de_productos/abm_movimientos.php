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
        Movimientos
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
                    <a href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_movimientos_agregar" class="btn btn-danger" ><i class='fa fa-plus'></i> Nuevo Movimiento</a>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <form action="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_consultar" method="post">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="desde_consultar">Desde</label>
                                    <?php 
                                        if($desde_consultar == null)
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='desde_consultar' name ='desde_consultar' value='".Date('Y-m-d')."'/>";
                                        }
                                        else
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='desde_consultar' name ='desde_consultar' value='".$desde_consultar."'/>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="hasta_consultar">Hasta</label>
                                    <?php 
                                        if($hasta_consultar == null)
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='hasta_consultar' name='hasta_consultar' value='".Date('Y-m-d')."'/>";
                                            
                                        }
                                        else
                                        {
                                            echo "<input type='text' class='form-control datetimepicker' id='hasta_consultar' name='hasta_consultar' value='".$hasta_consultar."'/>";
                                            
                                        }
                                    ?>
                                    </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="concepto_consultar">Concepto</label>
                                    <select class="form-control" id="concepto_consultar" name="concepto_consultar">
                                        <option value='entrada'>entrada</option>
                                        <?php /*
                                            if($concepto_consultar == null)
                                            {
                                                echo 
                                                "<option value='todos'>todos</option>
                                                <option value='entrada'>entrada</option>
                                                <option value='salida'>salida</option>";
                                                
                                            }
                                            else
                                            {
                                                $opciones = Array("todos","entrada","salida");
                                                
                                                for($i=0;$i < count($opciones);$i++)
                                                {
                                                    if($opciones[$i] == $concepto_consultar )
                                                    {
                                                        echo "<option value='".$opciones[$i]."' selected>".$opciones[$i]."</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='".$opciones[$i]."'>".$opciones[$i]."</option>";
                                                    }
                                                }
                                            }*/
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="tipo_consultar">Tipo</label>
                                    <select class="form-control" id="tipo_comprobante" name="tipo_comprobante">
                                        <option value="2">COMPROBANTE INTERNO</option>
                                        <!--<option value="todos">todos</option>-->
                                        <?php /*
                                            if($tipo_comprobante == null)
                                            {
                                                foreach($tipos_comprobantes as $value)
                                                {
                                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                                }
                                            }
                                            else
                                            {
                                                foreach($tipos_comprobantes as $value)
                                                {
                                                    if($value["id"] == $tipo_comprobante)
                                                    {
                                                        echo "<option value='".$value["id"]."' selected>".$value["descripcion"]."</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                                    }
                                                }
                                            }*/
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <select class="form-control select2" style="width: 100%" id="usuario" name="usuario">
                                        <option value="todos">todos</option>
                                        <?php
                                            foreach($usuarios as $value)
                                            {
                                                if($usuario == $value["id"] )
                                                {
                                                    echo "<option value='".$value["id"]."' selected>".$value["usuario"]."</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='".$value["id"]."'>".$value["usuario"]."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="">Producto</label>
                                    <select class="form-control select2" style="width: 100%" id="producto" name="producto">
                                        <option value="todos">todos</option>
                                        <?php
                                            foreach($lista_productos as $value)
                                            {
                                                if($producto == $value["id"])
                                                {
                                                    echo "<option value='".$value["id"]."' selected>".$value["descripcion"]."</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="submit" class="form-control btn btn-danger" id="" value="Consultar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Comprobante</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_movimientos as $value)
                            {
                                if($value["concepto"] == "entrada")
                                {
                                    echo "<tr class='bg-success'>";
                                }
                                else
                                {
                                    echo "<tr class='bg-danger'>";
                                }
                                echo 
                                "
                                    <td>".$value["fecha"]."</td>
                                    <td>".$value["desc_tipo_comprobante"]."</td>
                                    <td>".$value["desc_usuario"]."</td>
                                    <td>".$value["desc_producto"]."</td>";
                                    if($value["concepto"] == "entrada")
                                    {
                                        echo "<td>".$value["cantidad"]."</td>
                                              <td></td>";
                                    }
                                    else
                                    {
                                       echo "<td></td>
                                             <td>".$value["cantidad"]."</td>"; 
                                    }
                               echo "<td>".$value["numero_comprobante"]."</td>
                                    <td>
                                        <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Ver Detalle de Movimiento' onClick='abrir_modal_editar_unidad_de_medida()'><i class='fa fa-eye'></i></button>
                                        <!--<button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Eliminar' onClick='abrir_modal_eliminar_precio_vigente()'>X</button>-->
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


<!---->
<div class="modal modal-danger" id="modal_editar_unidad_de_medida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar unidad de medida:</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="id_unidad_de_medida_para_editar" hidden="true"/>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_editar_unidad_de_medida">Descripcion: </label>
                        <input class="form-control" type="text" id="descripcion_editar_unidad_de_medida" name="descripcion_editar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cantidad_editar_unidad_de_medida">Cantidad: </label>
                        <input class="form-control" type="text" id="cantidad_editar_unidad_de_medida" name="cantidad_editar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="unidad_de_medida_editar_unidad_de_medida">Unidad de medida: </label>
                        <input class="form-control" type="text" id="unidad_de_medida_editar_unidad_de_medida" name="unidad_de_medida_editar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="editar_unidad_de_medida()">Guardar Unidad de Medida</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_agregar_unidad_de_medida">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar una unidad de medida:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion_agregar_unidad_de_medida">Descripcion: </label>
                        <input class="form-control" type="text" id="descripcion_agregar_unidad_de_medida" name="descripcion_agregar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cantidad_agregar_unidad_de_medida">Cantidad: </label>
                        <input class="form-control" type="text" id="cantidad_agregar_unidad_de_medida" name="cantidad_agregar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="unidad_de_medida_agregar_unidad_de_medida">Unidad de medida: </label>
                        <input class="form-control" type="text" id="unidad_de_medida_agregar_unidad_de_medida" name="unidad_de_medida_agregar_unidad_de_medida" value=""/>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_unidad_de_medida()">Guardar Ubicacion</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
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
    
    function abrir_modal_editar_unidad_de_medida(id,descripcion,cantidad,medida)
    {
        $("#id_unidad_de_medida_para_editar").val(id);
        $("#descripcion_editar_unidad_de_medida").val(descripcion);
        $("#cantidad_editar_unidad_de_medida").val(cantidad);
        $("#unidad_de_medida_editar_unidad_de_medida").val(medida);
        $("#modal_editar_unidad_de_medida").modal("show");
    }
    
    function editar_unidad_de_medida()
    {
        var id= $("#id_unidad_de_medida_para_editar").val();
        var descripcion= $("#descripcion_editar_unidad_de_medida").val();
        var cantidad= parseFloat($("#cantidad_editar_unidad_de_medida").val());
        var unidad_de_medida= $("#unidad_de_medida_editar_unidad_de_medida").val();
        
        if(descripcion != "" && !isNaN(id) && cantidad != "" && !isNaN(cantidad) && unidad_de_medida != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_unidad_de_medida",
                type: "POST",
                data:{id:id,descripcion:descripcion,cantidad:cantidad,unidad_de_medida:unidad_de_medida},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_medidas";
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
        }
    }
    
   
    function gestiona_errores_editar()
    {
        var descripcion= $("#descripcion_editar_unidad_de_medida").val();
        var cantidad= parseFloat($("#cantidad_editar_unidad_de_medida").val());
        var unidad_de_medida= $("#unidad_de_medida_editar_unidad_de_medida").val();
        
        if(descripcion==""){activar_error("descripcion_editar_ubicacion");}
        else{desactivar_error("descripcion_editar_ubicacion");}
        
        if(cantidad=="" || isNaN(cantidad)){activar_error("cantidad_editar_unidad_de_medida");}
        else{desactivar_error("cantidad_editar_unidad_de_medida");}
        
        if(unidad_de_medida==""){activar_error("unidad_de_medida_editar_unidad_de_medida");}
        else{desactivar_error("unidad_de_medida_editar_unidad_de_medida");}
    }
    
    function agregar_unidad_de_medida()
    {
        var descripcion= $("#descripcion_agregar_unidad_de_medida").val();
        var cantidad= parseFloat($("#cantidad_agregar_unidad_de_medida").val());
        var unidad_de_medida= $("#unidad_de_medida_agregar_unidad_de_medida").val();
        
        
        if(descripcion != "" && cantidad != "" && !isNaN(cantidad) && unidad_de_medida != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_unidad_de_medida",
                type: "POST",
                data:{descripcion:descripcion,cantidad:cantidad,unidad_de_medida:unidad_de_medida},
               success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data > 0)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_medidas";
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
        }
    }
    
    function gestiona_errores_agregar()
    {
        var descripcion= $("#descripcion_agregar_unidad_de_medida").val();
        var cantidad= parseFloat($("#cantidad_agregar_unidad_de_medida").val());
        var unidad_de_medida= $("#unidad_de_medida_agregar_unidad_de_medida").val();
        
        if(descripcion==""){activar_error("descripcion_agregar_unidad_de_medida");}
        else{desactivar_error("descripcion_agregar_unidad_de_medida");}
        
        if(cantidad=="" || isNaN(cantidad)){activar_error("cantidad_agregar_unidad_de_medida");}
        else{desactivar_error("cantidad_agregar_unidad_de_medida");}
        
        if(unidad_de_medida==""){activar_error("unidad_de_medida_agregar_unidad_de_medida");}
        else{desactivar_error("unidad_de_medida_agregar_unidad_de_medida");}
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
        $('#tabla_listado').DataTable({
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


