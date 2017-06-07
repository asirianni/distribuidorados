<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_cliente_inicio_sesion($correo,$password)
    {
        $r= $this->db->query("SELECT cliente.* from cliente where cliente.correo = '".$correo."' and cliente.contrasenia = '".$password."'");
        return $r->row_array();
    }
    
    public function get_cliente_por_correo($correo)
    {
        $r= $this->db->query("SELECT cliente.* from cliente where cliente.correo = '".$correo."'");
        return $r->row_array();
    }
    
    public function get_lista_productos($lista_cliente)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.$lista_cliente as precio from productos where productos.$lista_cliente > 0");
        return $r->result_array();
    }
    
    public function get_mi_lista_pedidos()
    {
        $r = $this->db->query("SELECT * from pedidos where cliente = ".$this->session->userdata("id")." order by fecha desc");
        return $r->result_array();
    }
    
    public function get_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral, cliente.lista FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente where pedidos.numero = $numero_pedido and pedidos.cliente = ".$this->session->userdata("id"));
        return $r->row_array();
    }
    
    public function get_detalle_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedido_detalle.*,productos.descripcion as desc_producto FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido");
        return $r->result_array();
    }
    
    public function agregar_pedido_y_detalle($fecha_entrega,$detalle)
    {
        $datos = Array(
            "fecha"=>Date("Y-m-d"),
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$this->session->userdata("id"),
            "estado"=>"pendiente",
        );
        
        $respuesta=$this->db->insert("pedidos",$datos);
        
        $numero = 0;
        
        if($respuesta)
        {
            $numero = $this->db->query("SELECT max(pedidos.numero) as numero FROM pedidos");
            $numero= $numero->row_array();
            $numero= (int)$numero["numero"];
            
            for($i=0; $i < count($detalle);$i++)
            {
                $datos = Array(
                    "num_pedido"=>$numero,
                    "cod_producto"=>$detalle[$i]["codigo"],
                    "cantidad"=>$detalle[$i]["cantidad"],
                    "precio"=>$detalle[$i]["precio"],
                    "descuento"=>0,
                    "estado"=>"pendiente",
                );
                
                $this->db->insert("pedido_detalle",$datos);
            }
        }
        
        return $numero;
    }
}

