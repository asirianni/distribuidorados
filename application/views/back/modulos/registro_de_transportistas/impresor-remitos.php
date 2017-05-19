<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nutrilog</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/bootstrap.min.css">
  <!-- EDICION Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url()?>recursos/bootstrap/css/edicion_bootstrap.css">
  
</head>
<body onload="window.print()">
    <table id="tabla_listado" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Transporte</th>
                        <th>Chofer</th>
                        <th>Kilos</th>
                        <th>Estado</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listado_remitos as $value)
                            {
                                echo "<tr>";
                                echo 
                                "   <td>".$value["fecha"]."</td>
                                    <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>
                                    <td>".$value["desc_transporte"]."</td>
                                    <td>".$value["chofer_cuit"]." - ".$value["chofer_nombre"]." ".$value["chofer_apellido"]."</td>
                                    <td>".$value["total_kg"]."</td>
                                    <td>".$value["estado"]."</td>     
                                      
                                </tr>";
                            }
                        ?>  
                    </tbody>
                  </table>
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


