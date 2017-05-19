<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * CLASE QUE TRABAJA CON UNA ENTIDAD 
 * USUARIO PARA OBTENER Y SETEAR SUS 
 * PROPIEDADES
 */

class Usuario 
{
    private $codigo;
    private $usuario;
    private $password;
    private $nombre;
    private $apellido;
    private $correo;
    private $tipo_usuario;
    private $operativo;
    
    
    public function __construct($usuario = null) {
        if($usuario != null)
        {
            $this->inicializaUsuario($usuario);
        }
    }
    
    // GETTERS
    
    public function getCodigo()
    {
        return $this->codigo;
    }
    
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function getApellido()
    {
        return $this->apellido;
    }
    
    public function getCorreo()
    {
        return $this->correo;
    }
    
    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }
    
    public function getOperativo()
    {
        return $this->operativo;
    }
    
    //SETTERS
    
    public function setCodigo($valor)
    {
         $this->codigo= $valor;
    }
    
    public function setUsuario($valor)
    {
         $this->usuario= $valor;
    }
    
    public function setPassword($valor)
    {
         $this->password= $valor;
    }
    
    public function setNombre($valor)
    {
         $this->nombre= $valor;
    }
    
    public function setApellido($valor)
    {
         $this->apellido= $valor;
    }
    
    public function setCorreo($valor)
    {
         $this->correo= $valor;
    }
    
    public function setTipoUsuario($valor)
    {
         $this->tipo_usuario= $valor;
    }
    
    public function setOperativo($valor)
    {
         $this->operativo= $valor;
    }
    
    // PRIVATES
    
    public function inicializaUsuario($usuario)
    {
        $this->codigo= $usuario["codigo"];
        $this->usuario= $usuario["usuario"];
        $this->password= $usuario["password"];
        $this->nombre= $usuario["nombre"];
        $this->apellido= $usuario["apellido"];
        $this->correo= $usuario["correo"];
        $this->tipo_usuario= $usuario["tipo_usuario"];
        $this->operativo= $usuario["operativo"];
    }
}