<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Distribuidores | Ingresar</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/css/login.css">
</head>
<body class="hold-transition login-page" style="background-color: #dd4b39;">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url()?>index.php/Welcome"><strong style="color: #fff;">Bienvenido cliente</strong></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <!--<p class="login-box-msg">
                <a href="<?php echo base_url()?>">
                    <img width="200" src="<?php echo base_url()?>recursos/images/login/logo-empresa.png"/>
                </a>
            </p>-->
            <p class="login-box-msg">Inicio de sesion de Clientes</p>

            <form action="<?php echo base_url()?>index.php/Welcome/index" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="correo" class="form-control" placeholder="Correo o Usuario">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!--<div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>-->
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <?php for($i=0;$i < count($mensajes_error);$i++)
                        {
                           echo "<p class='mensaje_error'>".$mensajes_error[$i]."</p>";
                        }?>
                    </div>
                    <div class="col-xs-12">
                        <p class='mensaje_success'><?php echo $mensaje_success?></p>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!--
            <div class="social-auth-links text-center">
                <p> Siguenos en</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
            </div>-->
            <!-- /.social-auth-links -->
            <br/>
            <a href="<?php echo base_url()?>index.php/Welcome/olvide_mis_datos">Olvide mi datos</a><br>
            <!--<a href="register.html" class="text-center">Register a new membership</a>-->
        </div>
    <!-- /.login-box-body -->
    </div>
<!-- /.login-box -->

<script src="<?php echo base_url()?>recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url()?>recursos/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>recursos/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
