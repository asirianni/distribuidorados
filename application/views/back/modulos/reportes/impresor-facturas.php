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
    <div class="col-xs-12">
        <p><img src="<?=base_url()?>recursos/images/log_4.jpg" width="200"></p>
    </div>
    <div class="row">
        <table class="table table-bordered">
                    <tr>
                        <th>DESDE</th>
                        <th>HASTA</th>
                        <th>CLIENTE</th>
                        <th>ESTADO</th>
                        <th>USUARIO</th>
                    </tr>
                    <tr>
                        <td><?php echo $desde;?></td>
                        <td><?php echo $hasta;?></td>
                        <td><?php echo $cliente;?></td>
                        <td><?php echo $estado;?></td>
                        <td><?php echo $usuario;?></td>
                    </tr>
        </table>
        <table id="tabla_listado" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>CLIENTE</th>
                        <th>FACTURA</th>
                        <th>TIPO</th>
                        <th>IMPORTE</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $suma_importe = 0.0;
                            foreach($listado_facturas as $value)
                            {
                                $suma_importe+= (float)$value["total"];
                                
                                if((int)$value["estado"] == 1)
                                {
                                    echo "<tr class='bg-success'>";
                                }
                                else if((int)$value["estado"] == 2)
                                {
                                    echo "<tr class='bg-warning'> ";
                                }
                                else if((int)$value["estado"] == 3)
                                {
                                    echo "<tr class='bg-danger'>";
                                }
                                else
                                {
                                    echo "<tr>";
                                }
                                echo "
                                    <td>".$value["fecha"]."</td>
                                    <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>
                                    <td>".$value["numero"]."</td>
                                    <td>".$value["desc_tipo_factura"]."</td>
                                    <td>$".$value["total"]."</td>
                                    <td>".$value["desc_estado"]."</td>     
                                       
                                </tr>";
                            }
                        ?>  
                    </tbody>
                    <tfood>
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>$<?php echo $suma_importe?></th>
                        <th></th>
                      </tr>
                    </tfood>
                  </table>
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


