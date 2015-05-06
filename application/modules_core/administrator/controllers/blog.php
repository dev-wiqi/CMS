<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class blog extends MX_Controller {
    
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
        $a['link'] = $this->perm_user."/blog/add";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('blog');
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/blog");
        $this->load->view("admin/footer");
        }
        else{
            redirect("auth/auth");
        }
    }
    
    public function add(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $a['title'] = "SamMarie Application - Tambah Artikel Blog";
        $a['title2'] = "Tambah Artikel Blog";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/blog/save";
        $a['link'] = $this->perm_user."/categories/add";
        $a['categories'] = $this->models_admin->categories('blog',null);
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addblog");
        $this->load->view("admin/footer");
        }
        else{
            redirect("auth/auth");
        }
    }
    
    public function save(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('content','Source','trim|required');
        
        if ($this->form_validation->run() == FALSE){
           $error = "ini error"; 
        }
        else{
          if(empty($_FILES['img']['name'])){
                $insert['tb_name_blog'] = $this->input->post("title");
                $insert['tb_date_blog'] = $this->input->post("date");
                $insert['tb_source_blog'] = $this->input->post("content");
                $insert['tb_author_blog'] = $this->input->post("author");
                $insert['tb_categories_blog'] = $this->input->post("kategori");
                $insert['tb_status_blog'] = 1;
                
                $this->db->insert("wq_blog",$insert);
                redirect($this->perm_user."/blog");
          }
          else{
            $config['upload_path'] = './media/blog/';
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']     = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload("img")){
                $data = $this->upload->data();
                
                $source = "./media/blog/".$data['file_name'];
                $thumb = "./media/blog/thumb";
                
                chmod($source, 0777);
                
                $this->load->library('image_lib');
                $img['image_library'] = 'GD2';
                $img['create_thumb'] = TRUE;
                $img['maintain_ratio'] = TRUE;
                
               	 
                //// Making THUMBNAIL ///////
		$img['width']  = 100;
		$img['height'] = 100;
                
		// Configuration Of Image Manipulation :: Dynamic
		$img['quality']      = '100%' ;
                $img['source_image'] = $source ;
		$img['new_image']    = $thumb ;
			 
		// Do Resizing
		$this->image_lib->initialize($img);
		$this->image_lib->resize();
		$this->image_lib->clear() ;
                
                $insert['tb_image_blog'] = $data['file_name'];
                $insert['tb_name_blog'] = $this->input->post("title");
                $insert['tb_date_blog'] = $this->input->post("date");
                $insert['tb_source_blog'] = $this->input->post("content");
                $insert['tb_author_blog'] = $this->input->post("author");
                $insert['tb_categories_blog'] = $this->input->post("kategori");
                $insert['tb_status_blog'] = 1;
                
                $this->db->insert("wq_blog",$insert);
                redirect($this->perm_user."/blog");
            }
        }
       }
      }
      else {
          redirect("auth/auth");
      }
    }
    
    public function saveupdate(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('source','Source','trim|required');
        
        if ($this->form_validation->run() == FALSE){
           $error = ""; 
        }
        else{
          if(empty($_FILES['img']['name'])){
                $insert['tb_name_blog'] = $this->input->post("title");
                $insert['tb_date_blog'] = $this->input->post("date");
                $insert['tb_source_blog'] = $this->input->post("content");
                $insert['tb_author_blog'] = $this->input->post("author");
                $insert['tb_categories_blog'] = $this->input->post("kategori");
                $insert['tb_status_blog'] = 1;
                
                $where = $this->input->post("id");
                $this->db->where("tb_id_blog",$where);
                $this->db->update("wq_blog",$insert);
                redirect($this->perm_user."/blog");
          }
          else{
            $config['upload_path']      = './media/blog/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']         = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload("img")){
                $data = $this->upload->data();
                
                $source = "./media/blog/".$data['file_name'];
                $thumb = "./media/blog/thumb";
                
                chmod($source, 0777);
                
                $this->load->library('image_lib');
                $img['image_library'] = 'GD2';
                $img['create_thumb'] = TRUE;
                $img['maintain_ratio'] = TRUE;
                
			 
                //// Making THUMBNAIL ///////
		$img['width']  = 100;
		$img['height'] = 100;
			 
		// Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '';
		$img['quality']      = '100%';
                $img['source_image'] = $source;
		$img['new_image']    = $thumb;
			 
		// Do Resizing
		$this->image_lib->initialize($img);
		$this->image_lib->resize();
		$this->image_lib->clear() ;
                
                $insert['tb_image_blog'] = $data['file_name'];
                $insert['tb_name_blog'] = $this->input->post("title");
                $insert['tb_date_blog'] = $this->input->post("date");
                $insert['tb_source_blog'] = $this->input->post("content");
                $insert['tb_author_blog'] = $this->input->post("author");
                $insert['tb_categories_blog'] = $this->input->post("kategori");
                $insert['tb_status_blog'] = 1;
                
                $where = $this->input->post("id");
                $this->db->where("tb_id_blog",$where);
                $this->db->update("wq_blog",$insert);
                redirect($this->perm_user."/blog");
            }
        }
       }
      }
      else {
          redirect("auth/auth");
      }
    }
    
    public function update(){
       if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $uri="";
           if ($this->uri->segment(4)===FALSE){
               $uri="";
           }
           else{
               $uri=$this->uri->segment(4);
           }
        $a['title'] = "SamMarie Application - Edit Artikel Blog";
        $a['title2'] = "Edit Artikel Blog";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $a['action'] = $this->perm_user."/blog/updatesave";
        $whre['tb_id_blog'] = $uri;
        $content = $this->db->get_where("wq_blog",$whre);
        foreach($content->result() as $b){
            $a['id'] = $b->tb_id_blog;
            $a['name'] = $b->tb_name_blog;
            $a['date'] = $b->tb_date_blog;
            $a['author'] = $b->tb_author_blog;
            $a['source'] = $b->tb_source_blog;
            $a['image'] = $b->tb_image_blog;
            $a['categories'] = $b->tb_categories_blog;
            $a['status'] = $b->tb_status_blog;
        }
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/editblog");
        $this->load->view("admin/footer");
       }
       else{
           redirect("auth/auth");
       }
    }
    
    public function delete(){
      if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $uri="";
           if ($this->uri->segment(4)===FALSE){
               $uri = "";
           }
           else{
               $uri=$this->uri->segment(4);
           }
           
           $where['tb_id_blog'] = $uri;
           $this->db->delete("wq_blog",$where);
           $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Artikel Berhasil Di Hapus</div>');
          redirect($this->perm_user."/blog");
      }
       else{
          redirect("auth/auth");
      }
    }
    
    public function approve(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
           $uri="";
           if($this->uri->segment(4)===FALSE){
               $uri = "";
           }
           else{
               $uri = $this->uri->segment(4);
           }
        $id = $uri;
        $where['tb_status_blog'] = 1;
        $this->db->where('tb_id_blog',$id);
        $this->db->update("wq_blog",$where);
        $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Artikel Berhasil Di Publish</div>');
        redirect($this->perm_user."/blog");
        }
        else{
          redirect("auth/auth");
      }
    }
       
}
