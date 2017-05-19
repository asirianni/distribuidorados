<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_de_pedidos_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_listado_pedidos()
    {
        $r = $this->db->query("SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente ");
        return $r->result_array();
    }
    
    public function get_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente where pedidos.numero = $numero_pedido");
        return $r->row_array();
    }
    
    public function get_detalle_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedido_detalle.*,productos.descripcion as desc_producto FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido");
        return $r->result_array();
    }
    
    public function get_listado_productos_faltantes_en_pedido($numero_pedido)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.id not in (select pedido_detalle.cod_producto from pedido_detalle where pedido_detalle.num_pedido=$numero_pedido)");
        return $r->result_array();
    }
    
    public function agregar_pedido_y_detalle($fecha,$fecha_entrega,$cliente,$estado,$detalle)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$cliente,
            "estado"=>$estado,
        );
        
        $respuesta=$this->db->insert("pedidos",$datos);
        
        if($respuesta)
        {
            $numero = $this->db->query("SELECT max(pedidos.numero) as numero FROM pedidos");
            $numero= $numero->row_array();
            $numero= 1 + (int)$numero["numero"];
            
            for($i=0; $i < count($detalle);$i++)
            {
                $datos = Array(
                    "num_pedido"=>$numero,
                    "cod_producto"=>$detalle[$i][0],
                    "cantidad"=>$detalle[$i][1],
                    "precio"=>$detalle[$i][2],
                    "estado"=>"pendiente",
                );
                
                $this->db->insert("pedido_detalle",$datos);
            }
        }
        
        return $respuesta;
    }
    
    public function editar_pedido_y_detalle($numero_pedido,$fecha,$fecha_entrega,$cliente,$estado,$detalle)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$cliente,
            "estado"=>$estado,
        );
        $this->db->where("numero",$numero_pedido);
        $respuesta=$this->db->update("pedidos",$datos);
        
        if($respuesta)
        {
            $this->db->query("delete from pedido_detalle where num_pedido = $numero_pedido");
            for($i=0; $i < count($detalle);$i++)
            {
                $datos = Array(
                    "num_pedido"=>$numero_pedido,
                    "cod_producto"=>$detalle[$i][0],
                    "cantidad"=>$detalle[$i][1],
                    "precio"=>$detalle[$i][2],
                    "estado"=>$detalle[$i][3],
                );
                
                $this->db->insert("pedido_detalle",$datos);
            }
        }
        
        return $respuesta;
    }
    
    
    public function editar_pedido($numero,$fecha,$fecha_entrega,$cliente,$estado)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$cliente,
            "estado"=>$estado,
        );
        $this->db->where("numero",$numero);
        return $this->db->update("pedidos",$datos);
    }
    
    public function get_listado_productos_faltantes($numero_pedido)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.id not in (SELECT productos.id FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido)");
        return $r->result_array();
    }
    
}

