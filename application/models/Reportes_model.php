<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function lista_reporte_de_compra()
    {
        $r= $this->db->query("select pedido_detalle.cod_producto,productos.descripcion,productos.costo,productos.stock, sum(cantidad) as cantidad_a_pedir from pedido_detalle INNER JOIN pedidos on pedidos.numero = pedido_detalle.num_pedido INNER JOIN productos on productos.id = pedido_detalle.cod_producto where pedidos.estado = 'pendiente' and pedido_detalle.estado = 'pendiente' group by pedido_detalle.cod_producto");
        return $r->result_array();
    }
}