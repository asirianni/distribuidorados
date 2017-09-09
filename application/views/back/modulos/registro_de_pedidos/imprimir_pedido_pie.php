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
        $suma_totales = 0;
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
            $suma_totales+=$total;
        }
    ?>
    <br/><br/>
    <!-- OBTENIENDO TOTALES -->
    <?php
        $suma_totales = 0;
        foreach ($detalle_pedido_todo as $value)
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
            $suma_totales+=$total;
        }
    ?>

    <!-- FIN DETALLE -->

    <div class="row">
        <div class="col-xs-offset-8 col-xs-4">
            <p>SUBTOTAL: $<?php echo $suma_totales?></p>
        </div>
        <div class="col-xs-offset-8 col-xs-4">
            <?php 
                $descuento_general = (int)$pedido["descuento_gral"];
                $descuento_general_pesos =0;
                if($descuento_general != 0)
                {
                    $descuento_general_pesos = $suma_totales * ($descuento_general / 100);
                }
                $suma_totales-= $descuento_general_pesos;
                //$impuestos = $suma_totales * 0.21;
            ?>
            <p>DESC. GRAL: <?php echo $pedido["descuento_gral"]?> - $<?php echo number_format($descuento_general_pesos,2,".",",")?></p>
        </div>

        <!--<div class="col-xs-offset-8 col-xs-4">
            <p>IMPUESTOS: $</p>
        </div>-->
        <div class="col-xs-offset-8 col-xs-4">
            <p>TOTAL: $<?php echo number_format($suma_totales,2,".",",");?></p>
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


