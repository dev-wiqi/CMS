<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class menu_admin extends MX_Controller {
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
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['link'] = $this->perm_user."/menu_admin/add.aspx";
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('menuadmin');
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/menuadmin");
        $this->load->view("admin/footer");
       }
       else{
            redirect("auth/auth");
        }
    }
    
    function add(){
       if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $a['title'] = "SamMarie Application - Tambah Menu";
        $a['title2'] = "Tambah Menu";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/menu_admin/save";
        $a['content'] = $this->models_admin->content_menu(null);
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addmenuadmin");
        $this->load->view("admin/footer");
       }
      else{
            redirect("auth/auth");
        }  
    }
    
    function update(){
       if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
          $uri="";
          if($this->uri->segment(4)===FALSE){
              show_error("Validation Error Bro",500);
          }
          else{
              $uri=$this->uri->segment(4);
          }
        $a['title'] = "SamMarie Application - Update Menu";
        $a['title2'] = "Edit Menu";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/menu_admin/saveupdate";
        $whre['tb_id_menu'] = $uri;
        $content = $this->db_admin->get_where("wq_menu",$whre);
        foreach($content->result() as $b){
            $a['id'] = $b->tb_id_menu;
            $a['name'] = $b->tb_name_menu;
            $a['link'] = $b->tb_link_menu;
            $a['icon'] = $b->tb_icon_menu;
        }
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/editmenuadmin");
        $this->load->view("admin/footer");
       }
       else{
           redirect("auth/auth");
       }
    }
    
    function save(){
       if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $this->form_validation->set_rules('title','Title','trim|required');
           
           if ($this->form_validation->run()==FALSE){
               show_error("Validation Error Bro",500); 
           }
           $insert['tb_name_menu'] = $this->input->post("title");
           $insert['tb_link_menu'] = $this->input->post("module");
           $insert['tb_icon_menu'] = $this->input->post("icon");
           $insert['tb_location_menu'] = $this->input->post("location");
           $insert['tb_permission_menu'] = $this->input->post("permission");
           $insert['tb_status_menu'] = 1;
           
           $this->db_admin->insert("wq_menu",$insert);
           redirect($this->perm_user."/menu_admin");
       }
       else{
           redirect("auth/auth");
       }
    }
    
    function saveupdate(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $this->form_validation->set_rules('title','Title','trim|required');
           
           if ($this->form_validation->run()==FALSE){
              show_error("Validation Error Bro",500); 
           }
           $insert['tb_name_menu'] = $this->input->post("title");
           $insert['tb_link_menu'] = $this->input->post("module");
           $insert['tb_location_menu'] = $this->input->post("location");
           $insert['tb_permission_menu'] = $this->input->post("permission");
           $insert['tb_status_menu'] = 1;
           $where = $this->input->post("id");
           
           $this->db_admin->where("tb_id_menu",$where);
           $this->db_admin->update("wq_menu",$insert);
           $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Menu Berhasil Di edit</div>');
           redirect($this->perm_user."/menu_admin");
       }
       else{
           redirect("auth/auth");
       }
    }
    
    function delete(){
      if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $uri="";
           if ($this->uri->segment(4)===FALSE){
               $uri = "";
           }
           else{
               $uri=$this->uri->segment(4);
           }
           
           $where['tb_id_menu'] = $uri;
           $this->db_admin->delete("wq_menu",$where);
           $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Menu Berhasil Di Hapus</div>');
           redirect($this->perm_user."/menu_admin");
      }
      else{
          redirect("auth/auth");
      }
    }
       
}
