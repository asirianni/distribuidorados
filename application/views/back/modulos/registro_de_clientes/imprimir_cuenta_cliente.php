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
  
</head>
<body onload="window.print()">
    <div class="col-xs-offset-1 col-xs-10">
        <h2>Cuenta cliente N° <?php echo $cuenta_cliente["id"]?></h2>
        <table class='table table-striped'>
            <tr>
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <td><?php echo $cuenta_cliente["fecha"]?></td>
                        </tr>
                        <tr>
                            <th>CLIENTE</th>
                            <td><?php echo $cuenta_cliente["cliente_dni_cuit_cuil"]." - ".$cuenta_cliente["cliente_nombre"]." ".$cuenta_cliente["cliente_apellido"]?></td>
                        </tr>
                        <tr>
                        <?php
                            if((float)$cuenta_cliente["importe_recibo"] != 0)
                            {
                                echo "<th>ENTRADA</th>";
                                echo "<td>".$cuenta_cliente["importe_recibo"]."</td>";
                            }
                            else
                            {
                                echo "<th>SALIDA</th>";
                                echo "<td>".$cuenta_cliente["importe_factura"]."</td>";
                            }
                        ?>
                        </tr>
                        <tr>
                            <th>USUARIO</th>
                            <td><?php echo $cuenta_cliente["desc_usuario"]?></td>
                        </tr>
                    </thead>
                <tbody>
                
                </tbody>
        </table>
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


