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
        Usuarios
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>MENU DE NAVEGACION</a></li>
        <li class="active">ABM USUARIOS</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <button class="btn btn-danger" onClick="$('#modal_agregar_usuario').modal('show');"><i class='fa fa-plus'></i> Agregar Usuario</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Controles</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($usuarios as $value)
                      {
                        echo "
                        <tr>
                            <td>".$value["apellido"]."</td>
                            <td>".$value["correo"]."</td>
                            <td>".$value["fecha_registro"]."</td>
                            <td>".$value["desc_tipo"]."</td>
                            <td>
                                <button class='btn btn-success' data-toggle='tooltip' title='' data-original-title='Editar' onClick='modal_editar_usuario(".$value["id"].")'><i class='fa fa-edit'></i></button>
                                <a href='".base_url()."index.php/Administrador/administrar_modulos_de_usuario/".$value["id"]."' class='btn btn-danger' data-toggle='tooltip' title='' data-original-title='Modulos' onClick='adm_modulos_usuario(".$value["id"].")'><i class='fa fa-cubes'></i></a>
                            </td>
                        </tr>";
                      }?>
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

<!-- MODALES DE ABM USUARIOS-->
<div class="modal modal-danger" id="modal_agregar_usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Agregar un nuevo usuario:</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="formulario_agregar_usuario">
                <div class="col-md-12">
                    <p style="font-size: 16px;font-weight: bold;color: #F00;" id="mensaje_error"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_agregar_usuario">Usuario*</label>
                        <input class="form-control" id="usuario_agregar_usuario" name="usuario_agregar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo_agregar_usuario">Correo*</label>
                        <input class="form-control" id="correo_agregar_usuario" name="correo_agregar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre_agregar_usuario">Nombre*</label>
                        <input class="form-control" id="nombre_agregar_usuario" name="nombre_agregar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido_agregar_usuario">Apellido*</label>
                        <input class="form-control" id="apellido_agregar_usuario" name="apellido_agregar_usuario" value="" type="text">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_agregar_usuario">Contraseña*</label>
                        <input class="form-control" id="password_agregar_usuario" name="password_agregar_usuario" value="" type="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmar_agregar_usuario">Confirmar contraseña*</label>
                        <input class="form-control" id="password_confirmar_agregar_usuario" name="password_confirmar_agregar_usuario" value="" type="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_registro_agregar_usuario">Fecha registro*</label>
                        <input class="form-control datetimepicker" id="fecha_registro_agregar_usuario" name="fecha_registro_agregar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_agregar_usuario">Estado</label>
                        <select class="form-control" id="estado_agregar_usuario" name="estado_agregar_usuario">
                            <?php foreach($estados_usuarios as $value){
                                echo "<option value='".$value["id"]."'>".$value["estado"]."</option>";      
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_agregar_usuario">Tipo de usuario</label>
                        <select class="form-control" id="tipo_agregar_usuario" name="tipo_agregar_usuario">
                            <?php foreach($tipos_usuarios as $value){
                                echo "<option value='".$value["id"]."'>".$value["tipo"]."</option>";      
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foto_perfil_agregar_usuario">Foto de perfil</label>
                        <input type="file" id="foto_perfil_agregar_usuario" name="foto_perfil_agregar_usuario"/>
                    </div>
                </div>
                <div class='clearfix'></div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="form-group" style="text-align: center;">
                        <button class="btn btn-outline" onClick="agregar_usuario()"><i class='fa fa-save'></i> Guardar Usuario</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-danger" id="modal_editar_usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar usuario:</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="formulario_editar_usuario">
                    <input type="text" id="id_editar_usuario" name="id_editar_usuario" value="" hidden="true">
                <div class="col-md-12">
                    <p style="font-size: 16px;font-weight: bold;color: #F00;" id="mensaje_error_editar"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario_editar_usuario">Usuario*</label>
                        <input class="form-control" id="usuario_editar_usuario" name="usuario_editar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo_editar_usuario">Correo*</label>
                        <input class="form-control" id="correo_editar_usuario" name="correo_editar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre_editar_usuario">Nombre*</label>
                        <input class="form-control" id="nombre_editar_usuario" name="nombre_editar_usuario" value="" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido_editar_usuario">Apellido*</label>
                        <input class="form-control" id="apellido_editar_usuario" name="apellido_editar_usuario" value="" type="text">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_editar_usuario">Contraseña*</label>
                        <input class="form-control" id="password_editar_usuario" name="password_editar_usuario" value="" type="text" disabled>
                    </div>
                </div>
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nueva_password_editar_usuario">Nueva contraseña</label>
                        <input class="form-control" id="nueva_password_editar_usuario" name="nueva_password_editar_usuario" value="" type="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nueva_password2_editar_usuario">Confirmar contraseña</label>
                        <input class="form-control" id="nueva_password2_editar_usuario" name="nueva_password2_editar_usuario" value="" type="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_registro_editar_usuario">Fecha registro</label>
                        <input type="text" class="form-control datetimepicker" id="fecha_registro_editar_usuario" name="fecha_registro_editar_usuario">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_editar_usuario">Estado</label>
                        <select class="form-control" id="estado_editar_usuario" name="estado_editar_usuario">
                            <?php foreach($estados_usuarios as $value){
                                echo "<option value='".$value["id"]."'>".$value["estado"]."</option>";      
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_editar_usuario">Tipo de usuario</label>
                        <select class="form-control" id="tipo_editar_usuario" name="tipo_editar_usuario">
                            <?php foreach($tipos_usuarios as $value){
                                echo "<option value='".$value["id"]."'>".$value["tipo"]."</option>";      
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="foto_perfil_editar_usuario">Foto de perfil</label>
                        <p class="text-center"><img height="200" id="imagen_perfil_editar_usuario"/></p>
                        <input type="file" id="foto_perfil_editar_usuario" name="foto_perfil_editar_usuario"/>
                    </div>
                </div>
                <div class='clearfix'></div>
                
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="form-group" style="text-align: center;">
                        <button class="btn btn-outline" onClick="editar_usuario()"><i class='fa fa-save'></i> Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal modal-default" id="modal_modulos_usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modulos usuario:</h4>
            </div>
            <div class="modal-body">
                <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tabla_modulos_usuario" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Modulo</th>
                        <th>Activo</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpo_tabla_modulos_usuario">
                        
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

<!-- PERTENECIENTE A ABM_USUARIOS-->

<script>
   
    function adm_modulos_usuario(id)
    {
        $.ajax({
            url: "<?php echo base_url()?>index.php/Administrador/get_modulos_usuario",
            type: "POST",
            data:{id:id},
            success: function(data)
            {
                data= JSON.parse(data);
                var modulos_existentes = data[0];
                var modulos_faltantes = data[1];
                
                var html = "";
                
                for(var i=0; i < modulos_existentes.length;i++)
                {
                    html+="<tr>";
                        html+="<td>"+modulos_existentes[i]["id_modulo"]+"</td>";
                        html+="<td>"+modulos_existentes[i]["desc_modulo"]+"</td>";
                        html+="<td><button class='btn btn-success'>Activo</button></td>";
                    html+="</tr>";
                }
                
                for(var i=0; i < modulos_faltantes.length;i++)
                {
                    html+="<tr>";
                        html+="<td>"+modulos_faltantes[i]["id"]+"</td>";
                        html+="<td>"+modulos_faltantes[i]["modulo"]+"</td>";
                        html+="<td><button class='btn btn-danger'>No activo</button></td>";
                    html+="</tr>";
                }
                $("#cuerpo_tabla_modulos_usuario").html(html);
                $("#modal_modulos_usuario").modal("show");
            },
            error: function(event){
            },
        });    
    }
    
    function agregar_usuario()
    {
        var d = $("#formulario_agregar_usuario");
        formdata = new FormData();
        
        // En el formdata colocamos todos los archivos que vamos a subir
        for (var i = 0; i < (d.find('input[type=file]').length); i++) { 
            // buscará todos los input con el valor "file" y subirá cada archivo. Serán diferenciados en el PHP gracias al "name" de cada uno.
            formdata.append((d.find('input[type="file"]').eq(i).attr("name")),((d.find('input[type="file"]:eq('+i+')')[0]).files[0]));            
        }
                
        for (var i = 0; i < (d.find('input').not('input[type=file]').not('input[type=submit]').length); i++) { 
            // buscará todos los input menos el valor "file" y "sumbit . Serán diferenciados en el PHP gracias al "name" de cada uno.
            formdata.append( (d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).attr("name")),(d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).val()) );            
            formdata.append( (d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).attr("name")),(d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).val()) );            
        
        }
          
         
        var usuario = $("#usuario_agregar_usuario").val();
        var correo = $("#correo_agregar_usuario").val();
        var nombre = $("#nombre_agregar_usuario").val();
        var apellido = $("#apellido_agregar_usuario").val();
        var fecha_registro= $("#fecha_registro_agregar_usuario").val();
        var password = $("#password_agregar_usuario").val();
        var password2 = $("#password_confirmar_agregar_usuario").val();
        
        if(usuario !="" && 
           correo != "" && nombre != "" && apellido != "" 
           && password != "" && password2!="" && fecha_registro!= "")
        {
            if(password != password2)
            {
               $("#mensaje_error").text("Las contraseñas no coinciden");
            }
            else if(!validarEmail(correo))
            {
                $("#mensaje_error").text("Ingrese un correo valido");
            }
            else
            {
               $.ajax({
                    url: "<?php echo base_url()?>index.php/Administrador/agregar_usuario",
                    type: "POST",
                    contentType: false,
                    data:formdata,
                    processData:false,
                    success: function(data)
                    {
                       data= JSON.parse(data);
                       
                       if(data)
                       {
                           location.href="<?php echo base_url()?>index.php/Administrador/abm_usuarios";
                       }
                       else
                       {
                         $("#mensaje_error").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                       }
                    },
                    error: function(event){
                       $("#mensaje_error").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                    },
                });  
            }
        }
        else
        {
           $("#mensaje_error").text("Por favor complete todos los campos");
        }
    }
    
    function modal_editar_usuario(id)
    {
        $.ajax({
            url: "<?php echo base_url()?>index.php/Administrador/get_usuario",
            type: "POST",
            data:{id:id},
            success: function(data)
            {
                data= JSON.parse(data);
                
                if(data)
                {
                    $("#id_editar_usuario").val(data["id"]);
                    $("#usuario_editar_usuario").val(data["usuario"]);
                    $("#correo_editar_usuario").val(data["correo"]);
                    $("#password_editar_usuario").val(data["pass"]);
                    $("#nombre_editar_usuario").val(data["nombre"]);
                    $("#apellido_editar_usuario").val(data["apellido"]);
                    $("#estado_editar_usuario").val(data["estado"]);
                    $("#tipo_editar_usuario").val(data["tipo_usuario"]);
                    $("#fecha_registro_editar_usuario").val(data["fecha_registro"]);
                    $("#imagen_perfil_editar_usuario").attr("src","<?php echo base_url()?>recursos/images/foto_perfil/"+data["foto_perfil"]);
                    $("#modal_editar_usuario").modal("show");
                }
                else
                {
                    $("#mensaje_error").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                }
            },
            error: function(event){
                $("#mensaje_error").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
            },
        });    
    }
    
    function editar_usuario()
    {
        var id = $("#id_editar_usuario").val();
        var usuario = $("#usuario_editar_usuario").val();
        var correo = $("#correo_editar_usuario").val();
        var password= $("#password_editar_usuario").val();
        var password_nueva= $("#nueva_password_editar_usuario").val();
        var password_nueva2= $("#nueva_password2_editar_usuario").val();
        var nombre = $("#nombre_editar_usuario").val();
        var apellido = $("#apellido_editar_usuario").val();
        var fecha_registro = $("#fecha_registro_editar_usuario").val();
        var estado= $("#estado_editar_usuario").val();
        var tipo_usuario= $("#tipo_editar_usuario").val();
        
        var d = $("#formulario_editar_usuario");
        formdata = new FormData();
        
        // En el formdata colocamos todos los archivos que vamos a subir
        for (var i = 0; i < (d.find('input[type=file]').length); i++) { 
            // buscará todos los input con el valor "file" y subirá cada archivo. Serán diferenciados en el PHP gracias al "name" de cada uno.
            formdata.append((d.find('input[type="file"]').eq(i).attr("name")),((d.find('input[type="file"]:eq('+i+')')[0]).files[0]));            
        }
                
        for (var i = 0; i < (d.find('input').not('input[type=file]').not('input[type=submit]').length); i++) { 
            // buscará todos los input menos el valor "file" y "sumbit . Serán diferenciados en el PHP gracias al "name" de cada uno.
            formdata.append( (d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).attr("name")),(d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).val()) );            
            formdata.append( (d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).attr("name")),(d.find('select').not('select[type=file]').not('select[type=submit]').eq(i).val()) );            
        
        }
        
        if(!isNaN(id) && usuario != "" && correo != "" && password != ""
           && nombre != "" && apellido != "" && fecha_registro!= "")
        {
            if(password_nueva != "" && password_nueva != password_nueva2)
            {
               $("#mensaje_error_editar").text("Las contraseñas no coinciden");
            }
            else if(!validarEmail(correo))
            {
                $("#mensaje_error_editar").text("Ingrese un correo valido");
            }
            else
            {
               $.ajax({
                    url: "<?php echo base_url()?>index.php/Administrador/editar_usuario",
                    type: "POST",
                    contentType: false,
                    data:formdata,
                    processData:false,
                    success: function(data)
                    {
                       data= JSON.parse(data);
                       
                       if(data)
                       {
                           location.href="<?php echo base_url()?>index.php/Administrador/abm_usuarios";
                       }
                       else
                       {
                         $("#mensaje_error_editar").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                       }
                    },
                    error: function(event){
                       $("#mensaje_error_editar").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                    },
                });  
            }
        }
        else
        {
           $("#mensaje_error_editar").text("Por favor complete todos los campos");
        }
        
        $("#modal_editar_usuario").modal("show");
    }
    
    
    
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        
        $('#tabla_modulos_usuario').DataTable({
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
    </script>
</body>
</html>


