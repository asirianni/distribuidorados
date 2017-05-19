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
        Mi Perfil
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <!--<div class="box-header with-border">
                  <h3 class="box-title">Collapsible Accordion</h3>
                </div>-->
                <div class="box-body">
                  <p style="font-size: 16px;font-weight: bold;color: #F00;"><?php //echo validation_errors(); ?></p>
                    <form action="#" method="post" id="formulario_editar_perfil">
                        <div class="col-md-12" style="text-align: center;">
                                <img height="200" class="" src="<?php echo base_url()?>recursos/images/foto_perfil/<?php echo $mi_perfil["foto_perfil"];?>" alt="User profile picture">
                        </div>
                       <div class="col-md-12" style="text-align: center;">
                            Seleccione una foto de perfil <input type="file" name="foto_perfil">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario_editar_perfil">Usuario*</label>
                                <input type="text" class="form-control" name="usuario_editar_perfil" id="usuario_editar_perfil" value="<?php echo $mi_perfil["usuario"]?>"/>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="pass_editar_perfil">Contraseña</label>
                            <input type="text" class="form-control" name="pass_editar_perfil" id="pass_editar_perfil" value="<?php echo $mi_perfil["pass"]?>"/>
                        </div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_editar_perfil">Contraseña <input type="button" style="color: #000;" id="btn_cambiar_password" value="Modificar" onClick="btn_modificar()"/></label>
                                <input type="text" class="form-control" id="password_editar_perfil" name="password_editar_perfil" value="<?php echo $mi_perfil["pass"]?>" readonly=""/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="modificar_password" hidden="true">
                                <div class="form-group">
                                    <label for="password_editar_perfil">Nueva contraseña:</label>
                                    <input type="password" class="form-control" style="border-color: #F00;border-width: 2px;border-style: solid;" id="nueva_password" name="nueva_password" value=""/>
                                </div>
                                <div class="form-group">
                                    <label for="password_editar_perfil">Repetir nueva contraseña:</label>
                                    <input type="password" class="form-control" style="border-color: #F00;border-width: 2px;border-style: solid;" id="nueva_password2" name="nueva_password2" value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_editar_perfil">Nombre*</label>
                                <input type="text" class="form-control" name="nombre_editar_perfil" id="nombre_editar_perfil" value="<?php echo $mi_perfil["nombre"]?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_editar_perfil">Apellido*</label>
                                <input type="text" class="form-control" name="apellido_editar_perfil" id="apellido_editar_perfil" value="<?php echo $mi_perfil["apellido"]?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo_editar_perfil">Correo*</label>
                                <input type="email" class="form-control" name="correo_editar_perfil" id="correo_editar_perfil" value="<?php echo $mi_perfil["correo"]?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_editar_perfil">Tipo de usuario*</label>
                                <select name="tipo_editar_perfil" class="form-control" id="tipo_editar_perfil">
                                <?php 
                                foreach($tipos_usuarios as $value)
                                {
                                    if($mi_perfil["tipo_usuario"]==$value["id"]){
                                        echo "<option value='".$value["id"]."' selected>".$value["tipo"]."</option>";
                                    }
                                    else 
                                    {
                                        echo "<option value='".$value["id"]."'>".$value["tipo"]."</option>";
                                    }
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_registro_editar_perfil">Fecha Registro*</label>
                            <input type="text" class="form-control datetimepicker" name="fecha_registro_editar_perfil" id="fecha_registro_editar_perfil" value="<?php echo $mi_perfil["fecha_registro"]?>"/>
                        </div>
                        <div class="col-md-6">
                            <label for="estado_editar_perfil">Estado*</label>
                            <select name="estado_editar_perfil" class="form-control" id="estado_editar_perfil">
                            <?php 
                            foreach($estados_usuarios as $value)
                            {
                                if($mi_perfil["estado"]==$value["id"]){
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
                        <div class="col-md-12" style="text-align:center;">
                            <p style="font-size: 16px;font-weight: bold;color: #F00;" id="mensaje_error_editar"></p>
                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top: 20px;">
                            <input type="button" class="btn btn-danger" value="Guardar Cambios" onClick="guardar_cambios()"/>
                        </div>
                    </form>
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
<!-- bootstrap datepicker -->
<script src="<?php echo base_url()?>recursos/plugins/datetimepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url()?>recursos/plugins/datetimepicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url()?>recursos/plugins/datetimepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url()?>recursos/plugins/datetimepicker/jquery.datetimepicker.js"></script>  
<!--FUNCIONES GLOBALES -->
<script src="<?php echo base_url()?>recursos/js/global.js"></script>
<?php
    echo $js;
?>
<script>
    function guardar_cambios()
    {
        var usuario = $("#usuario_editar_perfil").val();
        var nueva_password = $("#nueva_password").val();
        var nueva_password2 = $("#nueva_password2").val();
        var nombre = $("#nombre_editar_perfil").val();
        var apellido = $("#apellido_editar_perfil").val();
        var correo = $("#correo_editar_perfil").val();
        var tipo_editar_perfil= $("#tipo_editar_perfil").val();
        var fecha_registro = $("#fecha_registro_editar_perfil").val();
        var estado= $("#estado_editar_perfil").val();
        
        if(usuario !="" && nombre !="" && apellido != "" && correo != ""
           && fecha_registro != "")
        {
            if(!validarEmail(correo))
            {
                $("#mensaje_error_editar").text("Por favor ingrese un correo valido");
            }
            else if(nueva_password != "" && nueva_password != nueva_password2)
            {
                $("#mensaje_error_editar").text("Las contraseñas no coinciden");
            }
            else
            {
                var d = $("#formulario_editar_perfil");
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
                
                $.ajax({
                    url: "<?php echo base_url()?>index.php/Administrador/actualizar_perfil",
                    type: "POST",
                    contentType: false,
                    data:formdata,
                    processData:false,
                    success: function(data)
                    {
                       data= JSON.parse(data);
                       
                       if(data)
                       {
                           location.href="<?php echo base_url()?>index.php/Administrador/mi_perfil";
                       }
                       else
                       {
                         $("#mensaje_error_editar").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                       }
                    },
                    error: function(event){
                        //alert(event.responseText);
                       $("#mensaje_error_editar").text("Ha ocurrido un error: asegurese que el usuario y correo no se encuentre agregado y el archivo seleccionado sea una imagen");
                    },
                });  
            }
        }
        else
        {
            $("#mensaje_error_editar").text("Por favor complete todos los campos");
        }
    }
    
    function btn_modificar(){
                var texto = $("#btn_cambiar_password").val();
                
                if(texto == "Modificar")
                {
                    $("#modificar_password").removeAttr("hidden");
                    $("#modificacion_password").val("true");
                    $("#btn_cambiar_password").val("Cancelar modificacion");
                }
                else
                {
                    $("#modificacion_password").val("false");
                    $("#modificar_password").attr("hidden","true");
                    $("#btn_cambiar_password").val("Modificar");
                }
        }
        
        
        
        function validarEmail( email ) 
        {
            for(var i=0; i < email.length;i++)
            {
                if(email.substr(i,1) == "ñ" || email.substr(i,1) == "Ñ" )
                {
                    email= email.substr(0,i)+email.substr(i+1,email.length);
                }
            }
            
           
            var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if ( !expr.test(email) )
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        
        $("#nueva_password").blur(function(){
            var valor =$("#nueva_password").val();
            
            if(valor == "")
            {
                $("#nueva_password").css("border-color","F00");
                $("#nueva_password").css("border-width","2px");
                $("#nueva_password").css("border-style","solid");
            }
            else
            {
                $("#nueva_password").css("border","none");
            }
        });
        $("#nueva_password2").blur(function(){
            
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



