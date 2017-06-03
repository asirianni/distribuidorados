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
    
    public function get_lista_productos($lista_cliente)
    {
        $r = $this->db->query("select productos.id,productos.descripcion,productos.$lista_cliente as precio from productos");
        return $r->result_array();
    }
}

