<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_de_pedidos_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    
    public function get_cantidad_pedidos_pendientes()
    {
        $r = $this->db->query("select count(pedidos.numero) as numero from pedidos where pedidos.estado = 'pendiente'");
        $r = $r->row_array();
        return (int)$r["numero"];
    }
    
    public function get_listado_pedidos()
    {
        $r = $this->db->query("SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral,cliente.razon_social,usuarios.usuario as desc_usuario FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente INNER JOIN usuarios on usuarios.id = pedidos.usuario");
        return $r->result_array();
    }
    
    public function get_fecha_min()
    {
        $r = $this->db->query("select min(fecha) as fecha from pedidos");
        $r=$r->row_array();
        return $r["fecha"];
    }
    
    public function get_fecha_max()
    {
        $r = $this->db->query("select max(fecha) as fecha from pedidos");
        $r=$r->row_array();
        return $r["fecha"];
    }
    
    public function get_listado_pedidos_consulta($fecha_desde,$fecha_hasta,$cliente,$estado,$localidad,$usuario)
    {
        $sql= "SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral, usuarios.usuario as desc_usuario FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN usuarios on usuarios.id = pedidos.usuario where pedidos.fecha >= '".$fecha_desde."' and pedidos.fecha <= '".$fecha_hasta."'";
        
        if((int)$cliente != 0)
        {
            $sql.=" and pedidos.cliente = $cliente";
        }
        else if((int)$localidad != 0)
        {
           $sql.=" and cliente.localidad = $localidad"; 
        }
        
        if($estado != "todos")
        {
            $sql.=" and pedidos.estado = '".$estado."'";
        }
        
        if($usuario != 0)
        {
            $sql.=" and pedidos.usuario = $usuario";
        }
        
        $r = $this->db->query($sql);
        return $r->result_array();
    }
    
    public function get_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedidos.*, cliente.dni_cuit_cuil,cliente.nombre,cliente.apellido,cliente.descuento_gral, cliente.lista FROM pedidos INNER JOIN cliente on cliente.id = pedidos.cliente where pedidos.numero = $numero_pedido");
        return $r->row_array();
    }
    
    public function get_detalle_pedido($numero_pedido)
    {
        $r = $this->db->query("SELECT pedido_detalle.*,productos.descripcion as desc_producto FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido");
        return $r->result_array();
    }
    
    public function get_detalle_pedido_paginado($numero_pedido,$ultimo_codigo)
    {
        $r = $this->db->query("SELECT pedido_detalle.*,productos.descripcion as desc_producto FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido and pedido_detalle.codigo > $ultimo_codigo limit 18");
        return $r->result_array();
    }
    
    
    
    public function get_listado_productos_faltantes_en_pedido($numero_pedido)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.id not in (select pedido_detalle.cod_producto from pedido_detalle where pedido_detalle.num_pedido=$numero_pedido)");
        return $r->result_array();
    }
    
    public function agregar_pedido_y_detalle($fecha,$fecha_entrega,$cliente,$estado,$detalle,$descuento_general,$usuario)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
            "cliente"=>$cliente,
            "estado"=>$estado,
            "usuario"=>$usuario,
        );
        
        $respuesta=$this->db->insert("pedidos",$datos);
        
        if($respuesta)
        {
            $numero = $this->db->query("SELECT max(pedidos.numero) as numero FROM pedidos");
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
                
                $this->db->insert("pedido_detalle",$datos);
            }
        }
        
        return $respuesta;
    }
    
    public function editar_pedido_y_detalle($numero_pedido,$fecha,$fecha_entrega,$estado,$detalle)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "fecha_entrega"=>$fecha_entrega,
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
                    "cod_producto"=>$detalle[$i]["cod_producto"],
                    "cantidad"=>$detalle[$i]["cantidad"],
                    "precio"=>$detalle[$i]["precio"],
                    "descuento"=>$detalle[$i]["descuento"],
                    "estado"=>"pendiente",
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
        $lista = $this->db->query("SELECT cliente.lista from cliente INNER JOIN pedidos on pedidos.cliente = cliente.id where pedidos.numero = $numero_pedido");
        $lista = $lista->row_array();
        $lista= $lista["lista"];
        
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,productos.$lista as precio, rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.id not in (SELECT productos.id FROM pedido_detalle INNER JOIN productos on productos.id = pedido_detalle.cod_producto where num_pedido= $numero_pedido)");
        return $r->result_array();
    }
    
    public function get_listado_productos_activos_segun_lista($lista)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.margen_1,productos.$lista as precio,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.activar = 'si'");
        return $r->result_array();
    }
    
    public function cambiar_estado_pedido($numero,$estado)
    {
        $datos = Array("estado"=>$estado);
        $this->db->where("numero",$numero);
        return $this->db->update("pedidos",$datos);
    }
    
}

