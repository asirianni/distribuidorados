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
      .linea
      {
          border-width: 3px;
          border-bottom: 0px;
          border-top: 3px;
          border-color: #999;
          border-style: solid;
      }
      
      .lineas
      {
          border-width: 3px;
          border-color: #999;
          border-style: solid;
      }
  </style>
</head>
<body onload="window.print()">
<div class="col-xs-offset-1 col-xs-10"> 
    
    
    <!-- DETALLE -->
    <?php

        

        foreach ($detalle_pedido as $value)
        {
            $cantidad = (float)$value["cantidad"];
            $unitario = (float)$value["precio"];
            $descuento = (int)$value["descuento"];

            $descuento_en_pesos=0;

            if($descuento != 0)
            {
                $descuento_en_pesos = ($unitario * ($descuento / 100));
            }

            $subtotal =$unitario-$descuento_en_pesos;
            $total=$subtotal*$cantidad;

            echo 
            "<div class='row'>
                <div class='col-xs-12'>
                        <div class='col-xs-2'>
                            ".$cantidad."
                        </div>
                        <div class='col-xs-2'>
                            <strong>".$value["desc_producto"]."</strong>
                        </div>
                        <div class='col-xs-2'>
                            $".number_format($unitario,2,".",",")."
                        </div>
                        <div class='col-xs-2'>
                            ".$descuento."%
                        </div>
                        <div class='col-xs-2'>
                            $".number_format($subtotal,2,".",",")."
                        </div>
                        <div class='col-xs-2'>
                            $".number_format($total,2,".",",")."
                        </div>
                </div>
            </div>";

            
        }
    ?>

    <!-- FIN DETALLE -->

    


    
</div> 

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>recursos/plugins/jQuery/jquery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
    $(document).ready(function()
    {
        var numero_pedido = JSON.parse('<?php echo json_encode($numero_pedido)?>');
        var numero_pagina = JSON.parse('<?php echo json_encode((int)$numero_pagina)?>');
        var ultimo_codigo = JSON.parse('<?php echo json_encode($ultimo_codigo)?>');
        var cantidad_paginas = JSON.parse('<?php echo json_encode($cantidad_paginas)?>');
        
        
            var url = "<?php echo base_url()?>index.php/Administrador/imprimir_pedido_paginado/"+numero_pedido+"/"+(numero_pagina+1)+"/"+ultimo_codigo+"/"+cantidad_paginas;

            window.open(url);
        
        
    });
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>recursos/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


