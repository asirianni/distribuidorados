<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_productos_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function consulta_generica($sql)
    {
        $r= $this->db->query($sql);
        return $r->result_array();
    }
    public function get_listado_productos()
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida ");
        return $r->result_array();
    }
    
    public function get_producto($id_producto)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.costo,productos.rubro,productos.stock,productos.punto_critico,productos.unidad_medida,rubros.descripcion as desc_rubro,unidad_medida.descripcion as medida_desc from productos INNER JOIN rubros on rubros.id = productos.rubro INNER JOIN unidad_medida on unidad_medida.id = productos.unidad_medida where productos.id = $id_producto");
        return $r->row_array();
    }
    
    public function get_rubros()
    {
        $r = $this->db->query("select * from rubros");
        return $r->result_array();
    }
    
    public function get_unidades_medidas()
    {
        $r = $this->db->query("SELECT * FROM unidad_medida");
        return $r->result_array();
    }
    
    public function agregar_producto($descripcion,$stock,$punto_critico,$rubro,$unidad_medida,$costo)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
            "stock"=>$stock,
            "punto_critico"=>$punto_critico,
            "rubro"=>$rubro,
            "unidad_medida"=>$unidad_medida,
            "costo"=>$costo,
        );
        
        $this->db->insert("productos",$datos);
        
        $r = $this->db->query("SELECT max(id) as id FROM productos");
        $r = $r->row_array();
        return (int)$r["id"];
        
    }
    
    public function editar_producto($id_producto,$descripcion,$stock,$punto_critico,$rubro,$unidad_medida,$costo)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
            "stock"=>$stock,
            "punto_critico"=>$punto_critico,
            "rubro"=>$rubro,
            "unidad_medida"=>$unidad_medida,
            "costo"=>$costo,
        );
        
        $this->db->where("id",$id_producto);
        return $this->db->update("productos",$datos); 
    }
    
    public function get_precios_vigentes_de_producto($id_producto)
    {
        $r = $this->db->query("SELECT * FROM precios where precios.id_producto = $id_producto order by fecha_vigente_desde");
        return $r->result_array();
    }
    
    public function agregar_precio_vigente($id_producto,$precio,$fecha_vigente_desde)
    {
        $datos = Array(
            "id_producto"=>$id_producto,
            "precio"=>$precio,
            "fecha_vigente_desde"=>$fecha_vigente_desde,
        );
        
        return $this->db->insert("precios",$datos);
    }
    
    public function editar_precio_vigente($id,$precio,$fecha_vigente_desde)
    {
        $datos = Array(
            "precio"=>$precio,
            "fecha_vigente_desde"=>$fecha_vigente_desde,
        );
        
        $this->db->where("id",$id);
        return $this->db->update("precios",$datos);
    }
    
    public function eliminar_precio_vigente($id)
    {
        $this->db->where("id",$id);
        return $this->db->delete("precios");
    }
    
    public function get_ubicaciones_de_producto($id_producto)
    {
        $r = $this->db->query("select ubicacion_productos.id,ubicacion_productos.id_productos,ubicacion_productos.id_ubicacion, ubicaciones.descripcion as desc_ubicacion from ubicacion_productos INNER JOIN ubicaciones on ubicaciones.id = ubicacion_productos.id_ubicacion where ubicacion_productos.id_productos = $id_producto");
        return $r->result_array();
    }
    
    public function eliminar_ubicacion_de_producto($id_ubicacion)
    {
        $this->db->where("id",$id_ubicacion);
        return $this->db->delete("ubicacion_productos");
    }
    
    public function get_ubicaciones_faltantes_de_producto($id_producto)
    {
        $r = $this->db->query("select * from ubicaciones where ubicaciones.id not in(select ubicacion_productos.id_ubicacion from ubicacion_productos where ubicacion_productos.id_productos = $id_producto)");
        return $r->result_array();
    }
    
    public function agregar_ubicacion_a_producto($id_producto,$id_ubicacion)
    {
        $datos = Array(
            "id_productos"=>$id_producto,
            "id_ubicacion"=>$id_ubicacion,
        );
        
        return $this->db->insert("ubicacion_productos",$datos);
    }
    
    public function editar_rubro($id_rubro,$descripcion)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
        );
        $this->db->where("id",$id_rubro);
        return $this->db->update("rubros",$datos);
    }
    
    public function agregar_rubro($descripcion)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
        );
        return $this->db->insert("rubros",$datos);
    }
    
    public function get_ubicaciones()
    {
        $r = $this->db->query("select * from ubicaciones");
        return $r->result_array();
    }
    
    public function agregar_ubicacion($descripcion)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
        );
        return $this->db->insert("ubicaciones",$datos);
    }
    
    public function editar_ubicacion($id_ubicacion,$descripcion)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
        );
        $this->db->where("id",$id_ubicacion);
        return $this->db->update("ubicaciones",$datos);
    }
    
    public function get_unidades_de_medidas()
    {
        $r = $this->db->query("SELECT * FROM unidad_medida");
        return $r->result_array();
    }
    
    public function editar_unidad_de_medida($id,$descripcion,$cantidad,$medida)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
            "cantidad"=>$cantidad,
            "medida"=>$medida
        );
        $this->db->where("id",$id);
        return $this->db->update("unidad_medida",$datos);
    }
    
    public function agregar_unidad_de_medida($descripcion,$cantidad,$medida)
    {
        $datos = Array(
            "descripcion"=>$descripcion,
            "cantidad"=>$cantidad,
            "medida"=>$medida
        );
        
        return $this->db->insert("unidad_medida",$datos);
    }
    
    public function get_movimientos()
    {
        $r = $this->db->query("select movimiento_detalle.*, tipo_comprobante.descripcion as desc_tipo_comprobante,usuarios.usuario as desc_usuario,productos.descripcion as desc_producto,movimientos.concepto,movimientos.numero_comprobante,movimientos.fecha from movimiento_detalle INNER JOIN movimientos on movimientos.id = movimiento_detalle.id_movimientos INNER JOIN tipo_comprobante on tipo_comprobante.id = movimientos.tipo_comprobante INNER JOIN usuarios on usuarios.id = movimientos.cod_usuario INNER JOIN productos on productos.id = movimiento_detalle.cod_producto");
        return $r->result_array();
    }
    
    public function get_movimientos_filtro($desde_consultar,$hasta_consultar,$concepto_consultar,$tipo_comprobante,$usuario,$producto)
    {
        // LOGICA QUE ARMA EL SQL PARA ENVIAR
            
            $sql = "select movimiento_detalle.*, tipo_comprobante.descripcion as desc_tipo_comprobante,usuarios.usuario as desc_usuario,productos.descripcion as desc_producto,movimientos.concepto,movimientos.numero_comprobante,movimientos.fecha from movimiento_detalle INNER JOIN movimientos on movimientos.id = movimiento_detalle.id_movimientos INNER JOIN tipo_comprobante on tipo_comprobante.id = movimientos.tipo_comprobante INNER JOIN usuarios on usuarios.id = movimientos.cod_usuario INNER JOIN productos on productos.id = movimiento_detalle.cod_producto where movimientos.fecha >='".$desde_consultar."' and movimientos.fecha <= '".$hasta_consultar."'";
            
            if($concepto_consultar != "todos")
            {
                $sql.= " and movimientos.concepto = '".$concepto_consultar."'";
            }
            
            if($tipo_comprobante != "todos")
            {
                $sql.= " and movimientos.tipo_comprobante = $tipo_comprobante";
            }
            
            if($usuario != "todos")
            {
                $sql.= " and movimientos.cod_usuario = $usuario";
            }
            
            if($producto != "todos")
            {
                $sql.= " and movimiento_detalle.cod_producto = $producto";
            }
            
        $r = $this->db->query($sql);
        return $r->result_array();
    }
    
    public function get_tipos_de_comprobantes()
    {
        $r = $this->db->query("select * from tipo_comprobante");
        return $r->result_array();
    }
    
    public function get_proximo_numero_comprobante()
    {
        // SACAR NUM DE COMPROBANTE
        $r= $this->db->query("SELECT max(numero_comprobante) as numero FROM movimientos");
        $r= $r->row_array();
        return (int)$r["numero"] + 1;
    }
    public function agregar_movimiento_y_detalle($fecha,$tipo_comprobante,$concepto,$usuario,$detalle)
    {
        // SACAR NUM DE COMPROBANTE
        $r= $this->db->query("SELECT max(numero_comprobante) as numero FROM movimientos");
        $r= $r->row_array();
        $numero_comprobante = (int)$r["numero"] + 1;
        //
        
        $datos = Array(
            "fecha"=>$fecha,
            "tipo_comprobante"=>$tipo_comprobante,
            "concepto"=>$concepto,
            "cod_usuario"=>$usuario,
            "numero_comprobante"=>$numero_comprobante,
        );
        
        $respuesta_mov= $this->db->insert("movimientos",$datos);
        $respuesta = false;
        
        // OBTENER ULTIMO ID DE MOV
            $r= $this->db->query("SELECT max(id) as id FROM movimientos");
            $r= $r->row_array();
            $id_movimiento = (int)$r["id"];
        //
            
        if($respuesta_mov)
        {
            for($i= 0; $i < count($detalle);$i++)
            {
                $datos = Array(
                    "id_movimientos"=>$id_movimiento,
                    "cod_producto"=>$detalle[$i][0],
                    "cantidad"=>$detalle[$i][1],
                );
                
                $producto = $this->get_producto($detalle[$i][0]);
                $stock = (int)$producto["stock"];
                
                if($concepto == "entrada")
                {
                    $stock = $stock + (int)$detalle[$i][1];
                }
                else
                {
                    $stock = $stock - (int)$detalle[$i][1];
                }

                $this->actualizar_stock_producto($detalle[$i][0], $stock);
                $respuesta = $this->db->insert("movimiento_detalle",$datos);
            }
        }
        
        return $respuesta;
    }
    
    
    public function actualizar_stock_producto($id,$stock)
    {
        $datos = Array("stock"=>$stock);
        $this->db->where("id",$id);
        return $this->db->update("productos",$datos);
    }
}


