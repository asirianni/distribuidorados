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
        Codigos de Barra
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
                    <button class="btn btn-danger" onClick="$('#modal_agregar_codigo_de_barra').modal('show');"><i class='fa fa-plus'></i> Agregar codigo de barra</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>CODIGO PRODUCTO</th>
                        <th>PRODUCTO</th>
                        <th>CODIGO DE BARRAS</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_codigos_de_barra as $value)
                            {
                                echo 
                                "<tr>
                                    <td>".$value["cod_producto"]."</td>
                                    <td>".$value["desc_producto"]."</td>
                                    <td>".$value["codigo_barra"]."</td>
                                    <td>
                                        <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' onClick='abrir_modal_editar_codigo_de_barras(".$value["id"].",".$value["cod_producto"].",&#34;".$value["codigo_barra"]."&#34;)'><i class='fa fa-edit'></i></button>
                                        <!--<button class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Eliminar' onClick='abrir_modal_eliminar_precio_vigente(".$value["cod_producto"].")'>X</button>-->
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
<div class="modal modal-danger" id="modal_agregar_codigo_de_barra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un codigo de barras:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="codigo_agregar_codigo_de_barras">Codigo de barras </label>
                        <input class="form-control" type="text" id="codigo_agregar_codigo_de_barras" name="codigo_agregar_codigo_de_barras" value=""/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="producto_agregar_codigo_de_barras">Producto: </label>
                        <select class="form-control select2" style="width: 100%;" id="producto_agregar_codigo_de_barras" name="rubro_agregar_subrubro">
                           <?php
                            foreach($listado_productos as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["id"]." - ".$value["descripcion"]."</option>";
                            }
                           ?>
                        </select>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="agregar_codigo_de_barras()"><i class='fa fa-save'></i> Guardar codigo de barras</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_editar_codigo_de_barra">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type='text' id='id_editar_codigo_de_barras' hidden/>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar un codigo de barras:</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="codigo_editar_codigo_de_barras">Codigo de barras </label>
                        <input class="form-control" type="text" id="codigo_editar_codigo_de_barras" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="producto_actual_editar_codigo_de_barras">Producto: </label>
                        <select class="form-control" id="producto_actual_editar_codigo_de_barras" disabled>
                           <?php
                            foreach($listado_productos as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["id"]." - ".$value["descripcion"]."</option>";
                            }
                           ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="producto__editar_codigo_de_barras">Cambiar producto: </label>
                        <select class="form-control select2" style="width: 100%;" id="producto__editar_codigo_de_barras">
                            <option value='0'>No cambiar</option>
                            <?php
                            foreach($listado_productos as $value)
                            {
                                echo "<option value='".$value["id"]."'>".$value["id"]." - ".$value["descripcion"]."</option>";
                            }
                           ?>
                        </select>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12" style="text-align: center;">
                    <button class="btn btn-danger" onClick="editar_codigo_de_barras()"><i class='fa fa-save'></i> Guardar Cambios</button>
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
    
    function abrir_modal_editar_codigo_de_barras(id,cod_producto,codigo_de_barras)
    {
        $("#id_editar_codigo_de_barras").val(id);
        $("#producto_actual_editar_codigo_de_barras").val(cod_producto);
        $("#codigo_editar_codigo_de_barras").val(codigo_de_barras);
        
        $("#modal_editar_codigo_de_barra").modal("show");
    }
    
    function editar_codigo_de_barras()
    {
        var id= $("#id_editar_codigo_de_barras").val();
        var cod_producto= parseInt($("#producto_actual_editar_codigo_de_barras").val());
        var cod_producto_cambiar = parseInt($("#producto__editar_codigo_de_barras").val());
        var codigo_de_barras= $("#codigo_editar_codigo_de_barras").val();
        
        if(codigo_de_barras==""){activar_error("codigo_editar_codigo_de_barras");}
        else{desactivar_error("codigo_editar_codigo_de_barras");}
        
        if(cod_producto_cambiar != 0)
        {
            cod_producto=cod_producto_cambiar;
        }
        
        if(codigo_de_barras != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/editar_codigo_de_barra",
                type: "POST",
                data:{id:id,cod_producto:cod_producto,codigo_barra:codigo_de_barras},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_codigos_de_barra";
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
    }
    
    
    function agregar_codigo_de_barras()
    {
       var codigo_de_barra = $("#codigo_agregar_codigo_de_barras").val(); 
       var producto = $("#producto_agregar_codigo_de_barras").val(); 
       
       if(codigo_de_barra==""){activar_error("codigo_agregar_codigo_de_barras");}
       else{desactivar_error("codigo_agregar_codigo_de_barras");}
       
       if(codigo_de_barra != "")
        {
            $.ajax({
                url: "<?php echo base_url()?>index.php/Response_Ajax/agregar_codigo_de_barra",
                type: "POST",
                data:{cod_producto:producto,codigo_barra:codigo_de_barra},
                success: function(data)
                {
                    data= JSON.parse(data);
                    
                    if(data)
                    {
                        location.href="<?php echo base_url()?>index.php/<?php echo $controller_usuario?>/stock_de_productos_codigos_de_barra";
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
    
    $(".select2").select2();
    
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
      
</script>
</body>
</html>


