<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_logout extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    function index(){
        if($this->session->userdata("log_in")=="")
        {
            redirect("auth/auth");
        }
        $this->session->sess_destroy();
            redirect();
    }
    
}
