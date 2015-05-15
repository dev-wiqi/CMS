<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class member extends MX_Controller {
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
    
    public function index(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $a['title'] = "SamMarie Application";
        $a['menu'] = $this->models_admin->simple_menu($this->perm_user);
        $a['link'] = $this->perm_user."/member/add";
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('member');
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/member");
        $this->load->view("admin/footer");
         }
         else{
            redirect("auth/auth");
        }
    }
    
     public function add(){
       
        $a['title'] = "SamMarie Application";
        $a['title2'] = "Tambah Member";
        $a['menu'] = $this->models_admin->simple_menu($this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = "member/save";
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addmember");
        $this->load->view("admin/footer");
    }
    
    public function update(){
    if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
          $uri="";
          if($this->uri->segment(4)===FALSE){
              $error="";
          }
          else{
              $uri=$this->uri->segment(4);
            }
        $a['title'] = "SamMarie Application";
        $a['title2'] = "Tambah Member";
        $a['menu'] = $this->models_admin->simple_menu($this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = "member/saveupdate";
        
        $where['tb_id_userlogin'] = $uri;
        $content = $this->db_admin->get_where("wq_userlogin",$where);
        foreach($content->result() as $b){
            $a['id'] = $a->tb_id_userlogin;
            $a['username'] = $a->tb_name_userlogin;
            $a['email'] = $a->tb_email_userlogin;
            $a['permission'] = $this->encrypt->decode($a->tb_permission_userlogin);
            $a['status'] = $a->tb_status_userlogin;
        }
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/editmember");
        $this->load->view("admin/footer");
        
      }
    }
    
    public function save(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
            $this->form_validation_set_rules('username','Username','trim|required');
           
           if ($this->form_validation->run()==FALSE){
               $error = "";
           }
           
           $insert['tb_name_userlogin'] = $this->input->post("username");
           $insert['tb_password_userlogin'] = md5($this->input->post("password"));
           $insert['tb_permission_userlogin'] = $this->encrypt->encode($this->input->post("permission"));
           $insert['tb_status_userlogin'] = 1;
           
           $this->db_admin->insert("wq_userlogin",$insert);
           redirect($this->perm_user."/member");
        }
        else{
            redirect("auth/auth");
        }
    }
    
    public function saveupdate(){
         if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
            $this->form_validation_set_rules('username','Username','trim|required');
           
           if ($this->form_validation->run()==FALSE){
               $error = "";
           }
         
           $insert['tb_password_userlogin'] = md5($this->input->post("password"));
           
         }
    }
    
    public function delete() {
         if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
            $this->form_validation_set_rules('username','Username','trim|required');
           
          if ($this->uri->segment(4)===FALSE){
               $uri = "";
           }
           else{
               $uri=$this->uri->segment(4);
           }
           
           $where['tb_id_userlogin'] = $uri;
           $this->db->delete("wq_userlogin",$where);
           $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>User Berhasil Di Hapus</div>');
           redirect($this->perm_user."/member");
        }
        else{
          redirect("auth/auth");
        }
    }
       
}
