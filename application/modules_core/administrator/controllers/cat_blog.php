<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cat_blog extends MX_Controller {
    
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    function __construct() {
        parent::__construct();
        $this->db_admin = $this->load->database("admin",TRUE);
        $this->db = $this->load->database("default", TRUE);
        $this->logged_in=$this->encrypt->decode($this->session->userdata("log_in"));
        $this->perm_user=$this->encrypt->decode($this->session->userdata("permission"));
    }
    
    function index(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
            $a['title'] = "SamMarie Application";
            $a['link'] = $this->perm_user."/cat_blog/add";
            $a['permission'] = $this->perm_user;
            $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
            $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
            $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
            $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
            $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
            $a['content'] = $this->models_admin->content('catblog');
            
            $this->load->view("admin/head",$a);
            $this->load->view("admin/menu");
            $this->load->view("admin/categories");
            $this->load->view("admin/footer");
        }
    }
    
}
    