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
    
    public function get_suma_totales_por_mes($mes)
    {
        $r = $this->db->query("SELECT sum(factura.total) as total from factura where factura.fecha >= '2017/$mes/01' and fecha <= '2017/$mes/31'");
        $r = $r->row_array();
        return (int)$r["total"];
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
    
    public function crear_factura($punto_venta,$fecha,$cliente,$remito_o_pedido,$numero_remito_pedido,$tipo_factura,$condicion_venta,$estado,$total,$descuento_general,$detalle)
    {
        $datos = array(
            "punto_venta"=>$punto_venta,
            "fecha"=>$fecha,
            "cliente"=>$cliente,
            "tipo_factura"=>$tipo_factura,
            "condicion_venta"=>$condicion_venta,
            "estado"=>$estado,
            "total"=>$total,
            "descuento_general"=>$descuento_general,
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
        
        
        if($insertado){
            $insertado = $this->get_factura(($this->get_proximo_numero_factura()-1));
        }
        
        if($insertado)
        {
            
            $numero_factura = $this->get_proximo_numero_factura() -1;
            
            foreach($detalle as $value)
            {
                $this->descuenta_stock($value["cod_producto"], $value["cantidad"]);
                
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
    
    public function descuenta_stock($cod_producto,$cantidad)
    {
        // CODIGO DESCUENTA STOCK
            $producto = $this->db->query("select * from productos where id = $cod_producto");
            $producto= $producto->row_array();
            $stock = (int)$producto["stock"];
            
            $stock= $stock - $cantidad;
            
            $this->db->where("id",$cod_producto);
            $this->db->update("productos",Array("stock"=>$stock));
        //
    }
    
    public function suma_stock($cod_producto,$cantidad)
    {
        // CODIGO SUMA STOCK
            $producto = $this->db->query("select * from productos where id = $cod_producto");
            $producto= $producto->row_array();
            $stock = (int)$producto["stock"];
            
            $stock= $stock + $cantidad;
            
            $this->db->where("id",$cod_producto);
            $this->db->update("productos",Array("stock"=>$stock));
        //
    }
    
    public function get_factura($numero)
    {
        $r= $this->db->query("SELECT factura.*, punto_venta.punto as desc_punto_venta, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, cliente.ingresos_brutos as cliente_ingresos_brutos, cliente.direccion as cliente_direccion, localidades.localidad as cliente_desc_localidad, cliente.razon_social as cliente_razon_social, provincias.provincia as cliente_desc_provincia,tipo_inscripcion.inscripcion as desc_cliente_tipo_de_inscripcion, tipo_factura.tipo as desc_tipo_factura,condicion_de_venta.condicion as desc_condicion,estado_factura.estado as desc_estado FROM factura INNER JOIN punto_venta on punto_venta.codigo = factura.punto_venta INNER JOIN cliente on cliente.id = factura.cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia INNER JOIN tipo_factura on tipo_factura.codigo = factura.tipo_factura INNER JOIN condicion_de_venta on condicion_de_venta.id = factura.condicion_venta INNER JOIN estado_factura on estado_factura.codigo = factura.estado INNER JOIN tipo_inscripcion on tipo_inscripcion.id = cliente.tipo_inscripcion where factura.numero= $numero");
        return $r->row_array();
    }
    
    public function get_factura_compra($numero)
    {
        $r= $this->db->query("SELECT factura_compra.*, punto_venta.punto as desc_punto_venta, proveedor.cuil as proveedor_cuil, proveedor.ingresos_brutos as proveedor_ingresos_brutos, proveedor.direccion as proveedor_direccion, localidades.localidad as proveedor_desc_localidad, proveedor.razon_social as proveedor_razon_social, provincias.provincia as proveedor_desc_provincia,tipo_inscripcion.inscripcion as desc_proveedor_tipo_de_inscripcion, tipo_factura.tipo as desc_tipo_factura,condicion_de_venta.condicion as desc_condicion,estado_factura.estado as desc_estado FROM factura_compra INNER JOIN punto_venta on punto_venta.codigo = factura_compra.punto_venta INNER JOIN proveedor on proveedor.id = factura_compra.proveedor INNER JOIN localidades on localidades.codigo = proveedor.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia INNER JOIN tipo_factura on tipo_factura.codigo = factura_compra.tipo_factura INNER JOIN condicion_de_venta on condicion_de_venta.id = factura_compra.condicion_venta INNER JOIN estado_factura on estado_factura.codigo = factura_compra.estado INNER JOIN tipo_inscripcion on tipo_inscripcion.id = proveedor.tipo_inscripcion where factura_compra.numero = $numero");
        return $r->row_array();
    }
    
    public function get_detalle_factura($numero_factura)
    {
        $r= $this->db->query("SELECT factura_detalle.*,productos.descripcion FROM factura_detalle INNER JOIN productos on productos.id = factura_detalle.cod_prod where num_factura = $numero_factura");
        return $r->result_array();
    }
    
    public function get_detalle_factura_compra($numero_factura)
    {
        $r= $this->db->query("SELECT factura_compra_detalle.*,productos.descripcion FROM factura_compra_detalle INNER JOIN productos on productos.id = factura_compra_detalle.cod_prod where factura_compra_detalle.num_factura= $numero_factura");
        return $r->result_array();
    }
    
    public function get_estados_factura()
    {
        $r = $this->db->query("SELECT * FROM estado_factura");
        return $r->result_array();
    }
    
    public function get_facturas_con_consultas($desde,$hasta,$cliente,$estado)
    {
        $sql = "SELECT factura.*, punto_venta.punto as desc_punto_venta, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, cliente.ingresos_brutos as cliente_ingresos_brutos, cliente.direccion as cliente_direccion, localidades.localidad as cliente_desc_localidad, cliente.razon_social as cliente_razon_social, provincias.provincia as cliente_desc_provincia,tipo_inscripcion.inscripcion as desc_cliente_tipo_de_inscripcion, tipo_factura.tipo as desc_tipo_factura,condicion_de_venta.condicion as desc_condicion,estado_factura.estado as desc_estado, usuarios.usuario as desc_usuario FROM factura INNER JOIN punto_venta on punto_venta.codigo = factura.punto_venta INNER JOIN cliente on cliente.id = factura.cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia INNER JOIN tipo_factura on tipo_factura.codigo = factura.tipo_factura INNER JOIN condicion_de_venta on condicion_de_venta.id = factura.condicion_venta INNER JOIN estado_factura on estado_factura.codigo = factura.estado INNER JOIN tipo_inscripcion on tipo_inscripcion.id = cliente.tipo_inscripcion INNER JOIN usuarios on factura.usuario = usuarios.id where factura.fecha >= '".$desde."' and factura.fecha <= '".$hasta."'";
        
        if($cliente != 0)
        {
            $sql.=" and factura.cliente = $cliente";
        }
        
        if($estado != 0)
        {
            $sql.=" and factura.estado = $estado";
        }
        
        $r = $this->db->query($sql);
        return $r->result_array();
    }
    
    public function get_proximo_numero_factura_compra()
    {
        $r = $this->db->query("select max(numero) as numero from factura_compra");
        $r= $r->row_array();
        return 1 + (int)$r["numero"];
    }
    
    public function crear_factura_compra($punto_venta,$fecha,$proveedor,$tipo_factura,$condicion_venta,$estado,$total,$descuento_general,$detalle)
    {
        $datos = array(
            "punto_venta"=>$punto_venta,
            "fecha"=>$fecha,
            "proveedor"=>$proveedor,
            "tipo_factura"=>$tipo_factura,
            "condicion_venta"=>$condicion_venta,
            "estado"=>$estado,
            "total"=>$total,
            "descuento_general"=>$descuento_general,
            "usuario"=>$this->session->userdata("id"),
        );
        
        
        
        $insertado= $this->db->insert("factura_compra",$datos);
        
        
        if($insertado){
            $insertado = $this->get_factura(($this->get_proximo_numero_factura_compra()-1));
        }
        
        if($insertado)
        {
            
            $numero_factura = $this->get_proximo_numero_factura_compra() -1;
            
            foreach($detalle as $value)
            {
                $this->suma_stock($value["cod_producto"], $value["cantidad"]);
                
                $datos = Array(
                    "num_factura"=>$numero_factura,
                    "cod_prod"=>$value["cod_producto"],
                    "cantidad"=>$value["cantidad"],
                    "precio"=>$value["precio"],
                    "descuento"=>$value["descuento"],
                );
                
                $this->db->insert("factura_compra_detalle",$datos);
            }
        }
        
        
        
        return $insertado;
    }
}
