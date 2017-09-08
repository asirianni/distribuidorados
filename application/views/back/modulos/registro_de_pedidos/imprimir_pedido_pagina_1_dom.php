<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Distribuidores</title>
 
  <style>
      body{
          font-size: 13px;
      }
      
      tr{
          padding-top: 100px;
      }
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
<body>
<div style="width: 500px;display:inline-block;">
    <div>
        <div style="width: 150px;display:inline-block;">
            <img src="<?=base_url()?>recursos/images/log_4.jpg" width="100">
        </div>
        <div style="width: 250px;display:inline;">
            PEDIDO N° <?php echo $pedido["numero"]?>
            FECHA <?php $date = date_create($pedido["fecha"]);echo date_format($date, 'd-m-Y');?>
        </div>
    </div>
    <div>
        <p>Cliente:</p>
        <p>Razon social: <?php echo $cliente["razon_social"]?>  Direccion: <?php echo $cliente["direccion"]." - ".$cliente["desc_localidad"]?></p>
        <p>Provincia: <?php echo $cliente["desc_provincia"]?> Dni-Cuit-Cuil: <?php echo $cliente["dni_cuit_cuil"]?> Ing. Brutos: <?php echo $cliente["ingresos_brutos"]?></p>
    </div>
    <div style="font-size: 10px;">
        <table cellpadding="5"> 
            <thead>
                <tr>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCIÓN</th>
                    <th>UNITARIO</th>
                    <th>DESCUENTO</th>
                    <th>SUBTOTAL</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
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
            "<tr style='padding-top: 10px;'>
                <td>".$cantidad."</td>
                <td>".$value["desc_producto"]."</td>
                <td>$".number_format($unitario,2,".",",")."</td>
                <td>".$descuento."</td>
                <td>$".number_format($subtotal,2,".",",")."</td>
                <td>$".number_format($total,2,".",",")."</td>
            </tr>";

            
        }
    ?>

    <!-- FIN DETALLE -->
            </tbody>
        </table>
    </div>   
</div>
    
    
<div style="width: 500px;display:inline-block;">
    <div>
        <div style="width: 150px;display:inline-block;">
            <img src="<?=base_url()?>recursos/images/log_4.jpg" width="100">
        </div>
        <div style="width: 250px;display:inline;">
            PEDIDO N° <?php echo $pedido["numero"]?>
            FECHA <?php $date = date_create($pedido["fecha"]);echo date_format($date, 'd-m-Y');?>
        </div>
    </div>
    <div>
        <p>Cliente:</p>
        <p>Razon social: <?php echo $cliente["razon_social"]?>  Direccion: <?php echo $cliente["direccion"]." - ".$cliente["desc_localidad"]?></p>
        <p>Provincia: <?php echo $cliente["desc_provincia"]?> Dni-Cuit-Cuil: <?php echo $cliente["dni_cuit_cuil"]?> Ing. Brutos: <?php echo $cliente["ingresos_brutos"]?></p>
    </div>
    <div style="font-size: 10px;">
        <table cellpadding="5"> 
            <thead>
                <tr>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCIÓN</th>
                    <th>UNITARIO</th>
                    <th>DESCUENTO</th>
                    <th>SUBTOTAL</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
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
            "<tr style='padding-top: 10px;'>
                <td>".$cantidad."</td>
                <td>".$value["desc_producto"]."</td>
                <td>$".number_format($unitario,2,".",",")."</td>
                <td>".$descuento."</td>
                <td>$".number_format($subtotal,2,".",",")."</td>
                <td>$".number_format($total,2,".",",")."</td>
            </tr>";

            
        }
    ?>

    <!-- FIN DETALLE -->
            </tbody>
        </table>
    </div>   
</div>
    
</body>
</html>


