<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_pedido_fecha_entrega_min()
    {
        $r= $this->db->query("select min(pedidos.fecha_entrega) as fecha from pedidos");
        $r= $r->row_array();
        return $r["fecha"];
    }
    
    public function get_pedido_fecha_entrega_max()
    {
        $r= $this->db->query("select max(pedidos.fecha_entrega) as fecha from pedidos");
        $r= $r->row_array();
        return $r["fecha"];
    }
    
    public function lista_reporte_de_pedidos($desde,$hasta)
    {
        $r= $this->db->query("SELECT productos.id,productos.descripcion, sum(pedido_detalle.cantidad) as cantidad FROM pedidos INNER JOIN pedido_detalle on pedido_detalle.num_pedido = pedidos.numero INNER JOIN productos on productos.id = pedido_detalle.cod_producto where pedidos.estado = 'pendiente' and pedidos.fecha_entrega >= '".$desde."' and pedidos.fecha_entrega <= '".$hasta."' group by productos.id ");
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
    
    public function reporte_cuenta_clientes($desde,$hasta,$tipo,$cliente,$localidad,$usuario)
    {
        $sql = "SELECT cliente.dni_cuit_cuil, cliente.razon_social,sum(importe_recibo) as entradas, sum(importe_factura) as salidas from cuenta_cliente INNER JOIN cliente on cliente.id = cuenta_cliente.cliente INNER JOIN localidades on cliente.localidad = localidades.codigo where cuenta_cliente.fecha >= '".$desde."' and fecha <= '".$hasta."' group by cliente";
        
       
       if($tipo == "entrada")
       {
           $sql.= " and cuenta_cliente.importe_recibo != 0";
       }
       
       if($tipo == "salida")
       {
           $sql.= " and cuenta_cliente.importe_factura != 0";
       }
       
       if($cliente != "todos")
       {
           $sql.= " and cuenta_cliente.cliente = $cliente";
       }
       else if($cliente != 0)
       {
           $sql.= " and cliente.localidad = $localidad";
       }
       
       if($usuario != 0)
       {
           $sql.= " and cuenta_cliente.usuario = $usuario";
       }
        
       $r= $this->db->query($sql);
        return $r->result_array();
    }
}