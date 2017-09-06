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
    
<div class="row">
    <div class="col-xs-offset-1 col-xs-10">
        <p><img src="<?=base_url()?>recursos/images/log_4.jpg" width="200"></p>
        <table class='table table-striped'> 
                <tr>
                    <th>Fecha desde</th>
                    <th>Fecha Hasta</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Localidad</th>
                    <th>Usuario</th>
                </tr>
                <tr>
                    <td><?php echo $desde_consultar?></td>
                    <td><?php echo $hasta_consultar?></td>
                    <td><?php echo $tipo_consultar?></td>
                    <td><?php echo $cliente_consultar?></td>
                    <td><?php echo $localidad_consultar?></td>
                    <td><?php echo $usuario_consultar?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                </tr>
            </table>
        <table class='table table-striped'>
                <thead>
                     <tr>
                        <th>FECHA</th>
                        <th>CLIENTE</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                      </tr>
                </thead>
            <tbody>
            <?php
            
            $suma_entradas=0.0;
            $suma_salidas=0.0;
            
            foreach($listado_cuentas_clientes as $value)
                            {
                                echo
                                "<tr>
                                    <td>".$value["fecha"]."</td>
                                    <td>".$value["cliente_dni_cuit_cuil"]." - ".$value["cliente_nombre"]." ".$value["cliente_apellido"]."</td>
                                    ";
                                    if((float)$value["importe_recibo"] != 0)
                                    {
                                        $suma_entradas+=(float)$value["importe_recibo"];
                                        echo "<td>".$value["importe_recibo"]."</td>";
                                        echo "<td></td>";
                                    }
                                    else if((float)$value["importe_factura"] != 0)
                                    {
                                        $suma_salidas+=(float)$value["importe_factura"];
                                        echo "<td></td>";
                                        echo "<td>".$value["importe_factura"]."</td>";
                                    }
                                    else
                                    {
                                        echo "<td></td>";
                                        echo "<td></td>";
                                    }
                                         
                                    echo "</tr>";
                            }
            ?>
            </tbody>
            <?php if($cliente_consultar != 0){ ?>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><?php echo $suma_entradas?></th>
                        <th><?php echo $suma_salidas?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            <?php } ?>
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


