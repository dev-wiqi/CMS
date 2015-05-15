<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    public function index(){
        $a['title'] = "SamMarie Application";
        $a['menu'] = $this->models_admin->menu(0,$h='');
        $a['profile'] = $this->models_admin->profile_top(1);
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/navtop");
        $this->load->view("admin/sidebar");
        $this->load->view("admin/page");
        $this->load->view("admin/footer");
    }
       
}
