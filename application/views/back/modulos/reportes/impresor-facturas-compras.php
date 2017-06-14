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
    <div class="row">
        
        <table id="tabla_listado" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>FECHA</th>
                        <th>FACTURA</th>
                        <th>TIPO</th>
                        <th>IMPORTE</th>
                        <th>ESTADO</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $suma_total=0.0;
                        
                            foreach($listado_facturas as $value)
                            {
                                $suma_total+= (float)$value["total"];
                                
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
                                    <td>".$value["numero"]."</td>
                                    <td>".$value["desc_tipo_factura"]."</td>
                                    <td>$".$value["total"]."</td>
                                    <td>".$value["desc_estado"]."</td>     
                                       
                                </tr>";
                            }
                        ?>  
                    </tbody>
                    <?php
                        if($proveedor != 0)
                        {
                            echo 
                            "
                                <tfood>
                                    <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>$".$suma_total."</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                                </tfood>
                            ";
                            
                        }
                    ?>
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


