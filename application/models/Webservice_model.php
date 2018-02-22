<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function agregar_pedido_y_detalle($fecha,$fecha_entrega,$cliente,$detalle,$usuario)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$cliente,
            "estado"=>"pendiente",
            "usuario"=>$usuario,
        );
        
        $respuesta=$this->db->insert("pedidos2",$datos);
        
        if($respuesta)
        {
            $numero = $this->db->query("SELECT max(pedidos2.numero) as numero FROM pedidos2");
            $numero= $numero->row_array();
            $numero= (int)$numero["numero"];
            
            for($i=0; $i < count($detalle);$i++)
            {
                $datos = Array(
                    "num_pedido"=>$numero,
                    "cod_producto"=>$detalle[$i]["cod_producto"],
                    "cantidad"=>$detalle[$i]["cantidad"],
                    "precio"=>$detalle[$i]["precio"],
                    "descuento"=>$detalle[$i]["descuento"],
                    "estado"=>"pendiente",
                );
                
                $this->db->insert("pedido_detalle2",$datos);
            }
        }
        
        return $respuesta;
    }
    
}

