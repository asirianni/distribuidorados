<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_pedidos_cliente_pendientes($id)
    {
        $r = $this->db->query("SELECT * FROM pedidos where cliente = $id and estado ='pendiente'");
        return $r->result_array();
    }
    
    public function get_remitos_cliente_pendientes($id)
    {
        $r = $this->db->query("SELECT * FROM remito where cliente = $id and estado ='pendiente'");
        return $r->result_array();
    }
    
    public function get_condiciones_de_venta()
    {
        $r = $this->db->query("SELECT * FROM condicion_de_venta");
        return $r->result_array();
    }
    
    public function get_puntos_de_venta()
    {
        $r = $this->db->query("SELECT * FROM punto_venta");
        return $r->result_array();
    }
    
    public function get_tipos_factura()
    {
        $r = $this->db->query("SELECT * FROM tipo_factura");
        return $r->result_array();
    }
    
    public function get_detalle_remito_sin_cobrar($numero_remito)
    {
        $r = $this->db->query("SELECT remito_detalle.*, productos.descripcion as desc_producto FROM remito_detalle INNER JOIN productos on productos.id = remito_detalle.cod_producto where remito_detalle.estado <> 'cobrado' and remito_detalle.numero_remito = $numero_remito");
        return $r->result_array();
    }
    
    public function get_detalle_pedido_sin_cobrar($numero_pedido)
    {
        $r = $this->db->query("SELECT pedido_detalle.*, productos.descripcion as desc_producto FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where pedido_detalle.estado <> 'cobrado'  and pedido_detalle.num_pedido = $numero_pedido");
        return $r->result_array();
    }
    
    public function get_proximo_numero_factura()
    {
        $r = $this->db->query("select max(numero) as numero from factura");
        $r= $r->row_array();
        return 1 + (int)$r["numero"];
    }
    
    public function crear_factura($punto_venta,$fecha,$cliente,$remito_o_pedido,$numero_remito_pedido,$tipo_factura,$condicion_venta,$estado,$total,$detalle)
    {
        $datos = array(
            "punto_venta"=>$punto_venta,
            "fecha"=>$fecha,
            "cliente"=>$cliente,
            "tipo_factura"=>$tipo_factura,
            "condicion_venta"=>$condicion_venta,
            "estado"=>$estado,
            "total"=>$total,
            "usuario"=>$this->session->userdata("id"),
        );
        
        if($remito_o_pedido == "pedido")
        {
            $datos["pedido"]=$numero_remito_pedido;
        }
        else if($remito_o_pedido == "remito")
        {
            $datos["remito"]=$numero_remito_pedido;
        }
        
        $insertado= $this->db->insert("factura",$datos);
        
        if($insertado)
        {
            $numero_factura = $this->get_proximo_numero_factura() -1;
            
            foreach($detalle as $value)
            {
                $datos = Array(
                    "num_factura"=>$numero_factura,
                    "cod_prod"=>$value["cod_producto"],
                    "cantidad"=>$value["cantidad"],
                    "precio"=>$value["precio"],
                    "descuento"=>$value["descuento"],
                );
                
                $this->db->insert("factura_detalle",$datos);
            }
        }
        
        return $insertado;
    }
}
