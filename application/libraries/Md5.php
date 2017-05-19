<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Md5
 *
 * @author mario
 */
class Md5 
{
    //put your code here
    
    public static function cifrar($cadena)
    {
        $key='Hh819AsdrWln791YuFGHqWe185vcmvbaSdGG6723';
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    } 
    
    public static function descifrar($cadena)
    {
        $key='Hh819AsdrWln791YuFGHqWe185vcmvbaSdGG6723';
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;
    }
}
