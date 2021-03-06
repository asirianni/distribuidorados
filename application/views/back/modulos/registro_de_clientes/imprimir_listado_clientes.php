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
        <p><img src="<?=base_url()?>recursos/images/log_4.jpg" width="200"></p>
        <h2>Listado de clientes</h2>
        <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>CUIL-DNI-CUIT</th>
                            <th>RAZON SOCIAL</th>
                            <th>LOCALIDAD</th>
                            <th>TELEFONO</th>
                            <th>TIPO INSCRIPCION</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                <tbody>
                <?php


                foreach($listado_clientes as $value)
                {

                    echo               
                    "<tr>
                        <td>".$value["dni_cuit_cuil"]."</td>
                        <td>".$value["razon_social"]."</td>
                        <td>".$value["desc_localidad"]."</td>
                        <td>".$value["telefono"]."</td>
                        <td>".$value["desc_inscripcion"]."</td>
                        <td>".$value["desc_estado"]."</td>   
                    </tr>";

                }
                ?>
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


