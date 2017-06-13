<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function lista_reporte_de_pedidos()
    {
        $r= $this->db->query("select pedido_detalle.cod_producto,productos.descripcion,productos.costo,productos.stock, sum(cantidad) as cantidad_a_pedir from pedido_detalle INNER JOIN pedidos on pedidos.numero = pedido_detalle.num_pedido INNER JOIN productos on productos.id = pedido_detalle.cod_producto where pedidos.estado = 'pendiente' and pedido_detalle.estado = 'pendiente' group by pedido_detalle.cod_producto");
        return $r->result_array();
    }
    
    
    public function get_caja_fecha_min()
    {
        $r= $this->db->query("select min(caja.fecha) as fecha from caja");
        $r= $r->row_array();
        return $r["fecha"];
    }
    
    public function get_caja_fecha_max()
    {
        $r= $this->db->query("select max(caja.fecha) as fecha from caja");
        $r= $r->row_array();
        return $r["fecha"];
    }
    
    public function get_listado_caja($desde,$hasta)
    {
        $r= $this->db->query("select * from caja where fecha >= '".$desde."' and fecha <= '".$hasta."'");
        return $r->result_array();
    }
}