<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cliente_template
{
    public function get_menu()
    {
        $html=
        "<div class='row'>
        <div class='col-md-12'>
            <!-- Static navbar -->
            <nav class='navbar navbar-default'>
              <div class='container-fluid'>
                <div class='navbar-header'>
                  <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                  </button>
                    <a class='navbar-brand' href='#'><strong style='color: #3c8dbc;'>Area de clientes</strong></a>
                </div>
                <div id='navbar' class='navbar-collapse collapse'>
                  <ul class='nav navbar-nav'>
                    <li class=''><a href='".base_url()."index.php/Welcome/principal_cliente'>Creador de pedidos</a></li>
                    <li class=''><a href='".base_url()."index.php/Welcome/mi_lista_de_pedidos'>Mi lista de pedidos</a></li>
                    
                    <!--<li><a href='#'>About</a></li>
                    <li><a href='#'>Contact</a></li>
                    <li class='dropdown'>
                      <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Dropdown <span class='caret'></span></a>
                      <ul class='dropdown-menu'>
                        <li><a href='#'>Action</a></li>
                        <li><a href='#'>Another action</a></li>
                        <li><a href='#'>Something else here</a></li>
                        <li role='separator' class='divider'></li>
                        <li class='dropdown-header'>Nav header</li>
                        <li><a href='#'>Separated link</a></li>
                        <li><a href='#'>One more separated link</a></li>
                      </ul>
                    </li>-->
                  </ul>
                  <ul class='nav navbar-nav navbar-right'>
                    <!--<li class='active'><a href='./'>Default <span class='sr-only'>(current)</span></a></li>
                    <li><a href='../navbar-static-top/'>Static top</a></li>-->
                    <li><a href='".base_url()."index.php/Welcome/cerrar_sesion'><i style='color: #dd4b39' class='fa fa-power-off'></i> <strong>Cerrar Sesion</strong></a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->
            </nav>
        </div>
    </div>";
        return $html;
    }
    
    public function get_footer()
    {
        $html=
        "<footer>
            <div class='navbar navbar-default navbar-fixed-bottom'>
                <div class='container'>
                    <div class='navbar-header'>
                        <ul class=''>
                            <li class='pull-right' style='list-style:none;font-size: 16px;font-weight: bold;text-align: right;'>Sistema desarrollado por <a target='_blank' href='https://www.facebook.com/Ordene-su-negocio-737763829635258' style='color: #3c8dbc;'>Adrian Sirianni</a> de <a target='_blank' href='https://www.facebook.com/Ordene-su-negocio-737763829635258' style='color: #3c8dbc;'>ordenesunegocio</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>";
        return $html;
    }
}

