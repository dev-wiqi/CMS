<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_login extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    public function index(){
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if ($this->form_validation->run() == FALSE){
            
        }
        else{
            
        }
    }
}
