<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller
{
    public $funciones_generales;
    public $adminlte;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Md5");
    }
//    public function index()
//    {
//         echo Md5::descifrar("WQaj3lkwXEevbW7zSYLqQ1T30YEY3IUXJFnYu/ZOQrw=");
//    }
    
 }    
