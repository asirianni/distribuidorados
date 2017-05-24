<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Movimiento_caja
 *
 * @author mario
 */
class Movimiento_caja_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getMovimientoFecha($fecha)
    {
        $r = $this->db->query("SELECT * FROM movimiento_caja WHERE fecha = '$fecha'");
        return $r->result_array();
    }
    
    public function getMovimientoComprobante($num_comprobante)
    {
        $r = $this->db->query("SELECT * FROM movimiento_caja WHERE numero = '$num_comprobante'");
        return $r->row_array();
    }
    
    
    public function getEntradasFecha($fecha)
    {
         $r = $this->db->query("SELECT * FROM movimiento_caja WHERE fecha = '$fecha' and tipo_mov = 'e'");
        return $r->result_array();
    }
    
    public function getSalidasFecha($fecha)
    {
        $r = $this->db->query("SELECT * FROM movimiento_caja WHERE fecha = '$fecha' and tipo_mov = 's'");
        return $r->result_array();
    }
    
    public function eliminar_movimiento($codigo)
    {
        $this->db->query("delete from movimiento_caja WHERE numero = $codigo");
    }
    
    public function eliminar_detalle_caja($comprobante)
    {
        $this->db->query("DELETE FROM caja_detalle WHERE comprobante = $comprobante");
    }
    
   
    
}
