<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_de_clientes_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_clientes_no_suspendidos()
    {
        $r = $this->db->query("select cliente.id,cliente.dni_cuit_cuil,cliente.ingresos_brutos,cliente.nombre,cliente.apellido,cliente.razon_social,cliente.lista,cliente.telefono,cliente.correo,cliente.direccion,cliente.localidad,cliente.descuento_gral,cliente.tipo_inscripcion, estado_cliente.estado as desc_estado, localidades.localidad as desc_localidad, provincias.id as id_provincia, provincias.provincia as desc_provincia,tipo_inscripcion.inscripcion as desc_inscripcion from cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia INNER JOIN estado_cliente on estado_cliente.id = cliente.estado INNER JOIN tipo_inscripcion on tipo_inscripcion.id = cliente.tipo_inscripcion where cliente.estado <> 3 ");
        return $r->result_array();
    }
    
    public function get_clientes()
    {
        $r = $this->db->query("select cliente.id,cliente.dni_cuit_cuil,cliente.ingresos_brutos,cliente.nombre,cliente.apellido,cliente.razon_social,cliente.lista,cliente.telefono,cliente.correo,cliente.direccion,cliente.localidad,cliente.descuento_gral,cliente.tipo_inscripcion, estado_cliente.estado as desc_estado, localidades.localidad as desc_localidad, provincias.id as id_provincia, provincias.provincia as desc_provincia,tipo_inscripcion.inscripcion as desc_inscripcion from cliente INNER JOIN localidades on localidades.codigo = cliente.localidad INNER JOIN provincias on provincias.id = localidades.id_provincia INNER JOIN estado_cliente on estado_cliente.id = cliente.estado INNER JOIN tipo_inscripcion on tipo_inscripcion.id = cliente.tipo_inscripcion");
        return $r->result_array();
    }
    
    public function get_cantidad_clientes()
    {
        $r = $this->db->query("SELECT count(cliente.id) as numero FROM cliente");
        $r = $r->row_array();
        return (int)$r["numero"];
    }
    
    public function get_fecha_min_cuenta_clientes()
    {
       $r = $this->db->query("select min(fecha) as fecha from cuenta_cliente");
       $r= $r->row_array();
       return $r["fecha"];
    }
    
    public function get_fecha_max_cuenta_clientes()
    {
       $r = $this->db->query("select max(fecha) as fecha from cuenta_cliente");
       $r= $r->row_array();
       return $r["fecha"];
    }
    
    public function get_cuentas_clientes_con_consulta($desde,$hasta,$tipo,$cliente_consultar)
    {
       $sql="SELECT cuenta_cliente.*, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido,usuarios.usuario as desc_usuario FROM cuenta_cliente INNER JOIN cliente on cliente.id = cuenta_cliente.cliente INNER JOIN usuarios on usuarios.id = cuenta_cliente.usuario where cuenta_cliente.fecha >= '".$desde."' and cuenta_cliente.fecha <= '".$hasta."' ";
       
       if($tipo == "recibo")
       {
           $sql.= " and importe_recibo != null";
       }
       
       if($tipo == "factura")
       {
           $sql.= " and cuenta_cliente.importe_factura != null";
       }
       
       if($cliente_consultar != "todos")
       {
           $sql.= " and cuenta_cliente.cliente = $cliente_consultar";
       }
       
       $r = $this->db->query($sql);
       return $r->result_array(); 
    }
    
    
    public function get_cliente($id)
    {
        $r = $this->db->query("select * from cliente where id=$id");
        return $r->row_array();
    }
    
    public function get_ultimo_cliente()
    {
        $r = $this->db->query("select * from cliente where cliente.id in (select max(id) from cliente)");
        return $r->row_array();
    }
    
    public function agregar_movimiento_cuenta_cliente($cliente,$fecha,$tipo_factura,$numero_factura,$importe_factura,$importe_recibo,$usuario)
    {
        $datos = Array(
            "cliente"=>$cliente,
            "fecha"=>$fecha,
            "tipo_factura"=>$tipo_factura,
            "numero_factura"=>$numero_factura,
            "importe_factura"=>$importe_factura,
            "importe_recibo"=>$importe_recibo,
            "usuario"=>$usuario,
        );
        
        return $this->db->insert("cuenta_cliente",$datos);
    }
    
    public function agregar_cliente($dni_cuit_cuil,$razon_social,$nombre,$apellido,$telefono,$correo,$direccion,$contrasenia,$localidad,$tipo_inscripcion,$estado,$descuento_gral,$ingresos_brutos,$lista)
    {
        $datos = Array(
            "dni_cuit_cuil"=>$dni_cuit_cuil,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "razon_social"=>$razon_social,
            "telefono"=>$telefono,
            "correo"=>$correo,
            "direccion"=>$direccion,
            "localidad"=>$localidad,
            "tipo_inscripcion"=>$tipo_inscripcion,
            "contrasenia"=>$contrasenia,
            "descuento_gral"=>$descuento_gral,
            "estado"=>$estado,
            "ingresos_brutos"=>$ingresos_brutos,
            "lista"=>$lista,
        );
        
        $respuesta = $this->db->insert("cliente",$datos);
        
        if($respuesta)
        {
            $respuesta = $this->get_ultimo_cliente();
        }
        
        return $respuesta;
        
    }
    
    public function editar_cliente($id,$dni_cuit_cuil,$razon_social,$nombre,$apellido,$telefono,$correo,$direccion,$contrasenia,$localidad,$tipo_inscripcion,$estado,$descuento_gral,$ingresos_brutos,$lista)
    {
        $datos = Array(
            "dni_cuit_cuil"=>$dni_cuit_cuil,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "razon_social"=>$razon_social,
            "telefono"=>$telefono,
            "correo"=>$correo,
            "direccion"=>$direccion,
            "localidad"=>$localidad,
            "tipo_inscripcion"=>$tipo_inscripcion,
            "contrasenia"=>$contrasenia,
            "descuento_gral"=>$descuento_gral,
            "estado"=>$estado,
            "ingresos_brutos"=>$ingresos_brutos,
            "lista"=>$lista,
        );
        
        $this->db->where("id",$id);
        return $this->db->update("cliente",$datos);
    }
    
    public function get_estados_clientes()
    {
        $r = $this->db->query("select * from estado_cliente");
        return $r->result_array();
    }
    
    public function get_cuenta_cliente($id)
    {
        $r = $this->db->query("SELECT cuenta_cliente.*, cliente.dni_cuit_cuil as cliente_dni_cuit_cuil, cliente.nombre as cliente_nombre, cliente.apellido as cliente_apellido, usuarios.usuario desc_usuario FROM cuenta_cliente INNER JOIN cliente on cliente.id = cuenta_cliente.cliente INNER JOIN usuarios on usuarios.id = cuenta_cliente.usuario where cuenta_cliente.id = $id");
        return $r->row_array();
    }
    
    public function get_tipo_inscripciones()
    {
        $r = $this->db->query("select * from tipo_inscripcion");
        return $r->result_array();
    }
    
    public function get_descuentos()
    {
        $r = $this->db->query("select * from descuentos_clientes");
        return $r->result_array();
    }
}
    

