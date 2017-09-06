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
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
  <style>
  </style>
</head>
<body onload="window.print()">
<div class="col-xs-offset-1 col-xs-10"> 
    
    <div class="col-xs-12">
        <p><img src="<?=base_url()?>recursos/images/log_4.jpg" width="200"></p>
    </div>
    
    <div class='row'>
        <div class='col-md-offset-1 col-md-4'>
            <h3>Movimiento: 17</h3>
            <table class='table table-striped'>
                <tr>
                    <td>Fecha: </td>
                    <td><?php echo $comprobante["fecha"]?></td>
                </tr>
                <tr>
                    <td>Concepto: </td>
                    <td><?php echo $comprobante["concepto"]?></td>
                </tr>
                <tr>
                    <td>Empleado: </td>
                    <td><?php echo $comprobante["nombre_empleado"]?></td>
                </tr>
                <tr>
                    <td>Tipo de movimiento: </td>
                    <td><?php echo $comprobante["tipo_mov"]?></td>
                </tr>
                <tr>
                    <td>Importe: </td>
                    <td><?php echo $comprobante["importe"]?></td>
                </tr>
            </table>
        </div>
    </div>   
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
</body>
</html>


