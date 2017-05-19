<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 
 * ESTA CLASE CONTIENE DIFERENTES FUNCIONALIDADES
 * PARA LO QUE SON LOS CORREOS. 
 * EJEMPLO: VERIFICA CORREOS, ENVIA CORREOS, ETC.
 * 
 */


Class Correo
{
    public $ci;
    
    public function __construct() 
    {
        $this->ci= &get_instance();
    }
    
    public static function validar_correo($email)
    {
        $mail_correcto = false;
        
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
        {
            if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) 
            {
                //miro si tiene caracter .
                if (substr_count($email,".")>= 1)
                {
                    //obtengo la terminacion del dominio
                    $term_dom = substr(strrchr ($email, '.'),1);
                    //compruebo que la terminación del dominio sea correcta
                    if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
                    {
                        //compruebo que lo de antes del dominio sea correcto
                        $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                        if ($caracter_ult != "@" && $caracter_ult != ".")
                        {
                            $mail_correcto = true;
                        }
                    }
                }
            }
        }
        
        return $mail_correcto;
    }
    
    public static function enviar_correo($mensaje,$asunto,$emisor,$receptor)
    {   //cabecera
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        //dirección del remitente 
        $headers .= "From: < $emisor >\r\n";
        return mail($receptor,$asunto,$mensaje,$headers);
    }
    
    public function enviar_correo_desde_gmail($emisor,$password_emisor,$receptor,$asunto,$mensaje)
    {
        //cargamos la libreria email de ci
	$this->ci->load->library("email");
 
	//configuracion para gmail
	$configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $emisor,
            'smtp_pass' => $password_emisor,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
	);    
 
	//cargamos la configuración para enviar con gmail
	$this->ci->email->initialize($configGmail);
 
	$this->ci->email->from($emisor);
	$this->ci->email->to($receptor);
	$this->ci->email->subject($asunto);
	$this->ci->email->message($mensaje);
	$this->ci->email->send();
	//con esto podemos ver el resultado
	var_dump($this->ci->email->print_debugger());
    }
    
    
    
    
    
    
}