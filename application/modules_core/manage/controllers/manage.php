<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class manage extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    public function index(){
        $a['menu'] = $this->models_admin->menu(0,$h='');
        
        $this->load->view("sample",$a);
    }
    
    public function detail(){
        
    }
    
}
