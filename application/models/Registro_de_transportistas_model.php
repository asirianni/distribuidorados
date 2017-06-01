<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_de_transportistas_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }
    
    public function get_listado_transportistas()
    {
        $r = $this->db->query("select * from transporte");
        return $r->result_array();
    }
    
    public function get_listado_transportistas_no_suspendidos()
    {
        $r = $this->db->query("select * from transporte where transporte.estado <> 'suspendido'");
        return $r->result_array();
    }
    
    
    public function agregar_transportista($transporte,$cuit,$telefono,$direccion,$estado)
    {
        $datos = Array(
            "transporte"=>$transporte,
            "cuit"=>$cuit,
            "telefono"=>$telefono,
            "direccion"=>$direccion,
            "estado"=>$estado,
        );
        
        return $this->db->insert("transporte",$datos);
    }
    
    public function editar_transportista($id,$transporte,$cuit,$telefono,$direccion,$estado)
    {
        $datos = Array(
            "transporte"=>$transporte,
            "cuit"=>$cuit,
            "telefono"=>$telefono,
            "direccion"=>$direccion,
            "estado"=>$estado,
        );
        $this->db->where("id",$id);
        return $this->db->update("transporte",$datos);
    }
    
    public function get_choferes()
    {
        $r = $this->db->query("SELECT chofer.*, localidades.localidad as desc_localidad from chofer INNER JOIN localidades on localidades.codigo = chofer.localidad");
        return $r->result_array();
    }
    
    public function get_choferes_no_suspendidos()
    {
        $r = $this->db->query("SELECT chofer.*, localidades.localidad as desc_localidad from chofer INNER JOIN localidades on localidades.codigo = chofer.localidad where chofer.estado <> 'suspendido'");
        return $r->result_array();
    }
    
    public function agregar_chofer($cuit,$nombre,$apellido,$direccion,$telefono,$localidad,$estado)
    {
        $datos = Array(
            "cuit"=>$cuit,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "direccion"=>$direccion,
            "telefono"=>$telefono,
            "localidad"=>$localidad,
            "estado"=>$estado,
        );
        
        return $this->db->insert("chofer",$datos);
    }
    
    public function editar_chofer($id,$cuit,$nombre,$apellido,$direccion,$telefono,$localidad,$estado)
    {
        $datos = Array(
            "cuit"=>$cuit,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "direccion"=>$direccion,
            "telefono"=>$telefono,
            "localidad"=>$localidad,
            "estado"=>$estado,
        );
        $this->db->where("id",$id);
        return $this->db->update("chofer",$datos);
    }
    
    public function get_listado_remitos_no_cancelados()
    {
        $r = $this->db->query("select remito.*, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, transporte.transporte as desc_transporte, chofer.nombre as chofer_nombre, chofer.apellido as chofer_apellido, chofer.cuit as chofer_cuit, tipo_vehiculo.vehiculo as desc_tipo_vehiculo from remito INNER JOIN cliente on cliente.id = remito.cliente INNER JOIN transporte on transporte.id = remito.transporte INNER JOIN chofer on chofer.id = remito.chofer INNER JOIN tipo_vehiculo on tipo_vehiculo.id = remito.tipo_vehiculo where remito.estado <> 'cancelado'");
        return $r->result_array();
    }
    
    public function get_tipos_vehiculos()
    {
        $r = $this->db->query("select * from tipo_vehiculo");
        return $r->result_array();
    }
    
    public function get_listado_consulta_remitos($fecha_desde,$fecha_hasta,$transporte,$chofer,$tipo_vehiculo,$estado)
    {
        $consulta = "select remito.*, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, transporte.transporte as desc_transporte, chofer.nombre as chofer_nombre, chofer.apellido as chofer_apellido, chofer.cuit as chofer_cuit, tipo_vehiculo.vehiculo as desc_tipo_vehiculo from remito INNER JOIN cliente on cliente.id = remito.cliente INNER JOIN transporte on transporte.id = remito.transporte INNER JOIN chofer on chofer.id = remito.chofer INNER JOIN tipo_vehiculo on tipo_vehiculo.id = remito.tipo_vehiculo";
        
        $consulta.= " where remito.fecha >= '".$fecha_desde."' and remito.fecha <= '".$fecha_hasta."'";
        
        if($transporte != "todos")
        {
            $consulta.= " and remito.transporte = $transporte";
        }
        
        if($chofer != "todos")
        {
            $consulta.= " and remito.chofer = $chofer";
        }
        
        if($tipo_vehiculo != "todos")
        {
            $consulta.= " and remito.tipo_vehiculo = $tipo_vehiculo";
        }
        
        if($estado != "todos")
        {
            $consulta.= " and remito.estado = '$estado'";
        }
        
        $r = $this->db->query($consulta);
        return $r->result_array();
    }
    
    public function get_numero_proximo_remito()
    {
        $r = $this->db->query("select max(numero) as numero from remito");
        $r= $r->row_array();
        return (1 + ((int)$r["numero"]));
    } 
    
    public function agregar_remito($fecha,$cliente,$condicion,$transporte,$chofer,$acoplado,$tipo_vehiculo,$patente,$entrega,$total_kg,$estado,$chasis,$detalle)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "cliente"=>$cliente,
            "condicion_venta"=>$condicion,
            "transporte"=>$transporte,
            "chofer"=>$chofer,
            "chasis"=>$chasis,
            "acoplado"=>$acoplado,
            "tipo_vehiculo"=>$tipo_vehiculo,
            "patente"=>$patente,
            "entrega"=>$entrega,
            "total_kg"=>$total_kg,
            "estado"=>$estado,
        );
        
        $insertado= $this->db->insert("remito",$datos);
        
        if($insertado)
        {
            $r= $this->db->query("SELECT max(remito.numero) as numero FROM remito");
            $r = $r->row_array();
            $numero = (int)$r["numero"];
            
            for($i=0; $i < count($detalle);$i++)
            {
                $datos= Array(
                    "numero_remito"=>$numero,
                    "cod_producto"=>$detalle[$i][0],
                    "precio"=>$detalle[$i][2],
                    "cantidad"=>$detalle[$i][3],
                );
                
                $this->db->insert("remito_detalle",$datos);
            }
        }
        
        return $insertado;
    }
    
    public function editar_remito($numero,$fecha,$cliente,$condicion,$transporte,$chofer,$acoplado,$tipo_vehiculo,$patente,$entrega,$total_kg,$estado,$chasis,$detalle)
    {
        $datos = Array(
            "fecha"=>$fecha,
            "cliente"=>$cliente,
            "condicion_venta"=>$condicion,
            "transporte"=>$transporte,
            "chofer"=>$chofer,
            "chasis"=>$chasis,
            "acoplado"=>$acoplado,
            "tipo_vehiculo"=>$tipo_vehiculo,
            "patente"=>$patente,
            "entrega"=>$entrega,
            "total_kg"=>$total_kg,
            "estado"=>$estado,
        );
        
        $this->db->where("numero",$numero);
        $cambiado= $this->db->update("remito",$datos);
        
        if($cambiado)
        {
            
            $this->db->query("delete from remito_detalle where numero_remito = $numero");
            
            for($i=0; $i < count($detalle);$i++)
            {
                $datos= Array(
                    "numero_remito"=>$numero,
                    "cod_producto"=>$detalle[$i][0],
                    "precio"=>$detalle[$i][2],
                    "cantidad"=>$detalle[$i][3],
                );
                
                $this->db->insert("remito_detalle",$datos);
            }
        }
        
        return $cambiado;
    }
    
    public function get_remito($numero_remito)
    {
        $r = $this->db->query("SELECT remito.*, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, transporte.transporte as transporte_transporte, transporte.cuit as transporte_cuit, chofer.cuit as chofer_cuit, chofer.nombre as chofer_nombre, chofer.apellido as chofer_apellido,condicion_de_venta.condicion as condicion_de_venta_condicion FROM remito INNER JOIN condicion_de_venta on condicion_de_venta.id = remito.condicion_venta INNER JOIN cliente on cliente.id = remito.cliente INNER JOIN transporte on transporte.id = remito.transporte INNER JOIN chofer on chofer.id = remito.chofer INNER JOIN tipo_vehiculo on tipo_vehiculo.id = remito.tipo_vehiculo where numero =  $numero_remito");
        return $r->row_array();
    }
    
    public function get_cliente($cliente)
    {
        $r = $this->db->query("select cliente.*, localidades.localidad as desc_localidad, provincias.provincia as desc_provincia from cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia where cliente.id = $cliente");
        return $r->row_array();
    }
    
    public function get_detalle_remito($numero_remito)
    {
        $r = $this->db->query("select remito_detalle.*,productos.descripcion as desc_producto from remito_detalle INNER JOIN productos on productos.id = remito_detalle.cod_producto where remito_detalle.numero_remito = $numero_remito");
        return $r->result_array();
    }
    
    
    public function get_condiciones_de_venta()
    {
        $r = $this->db->query("select * from condicion_de_venta");
        return $r->result_array();
    }
    
}
