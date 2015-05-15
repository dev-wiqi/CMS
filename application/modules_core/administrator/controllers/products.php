<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class products extends MX_Controller {
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
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['link'] = $this->perm_user."/products/add";
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('products');
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/products");
        $this->load->view("admin/footer");
        }
        else{
            redirect("auth/auth");
        }
    }
    
    public function add(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $a['title'] = "SamMarie Application";
        $a['title2'] = "Tambah Content Page";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/products/save";
        $a['categories'] = $this->models_admin->categories("products",null);
        $a['author'] = $this->session->userdata("username");
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addproducts");
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
           $error = "asu"; 
        }
        else{
            $config['upload_path'] = './media/products/';
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']         = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('img[]')){
                $data = $this->upload->data();
                
                $source = "./media/products/".$data['file_name'];
                $thumb = "./media/products/thumb";
                
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
		$img['quality']      = '100%' ;
                $img['source_image'] = $source ;
		$img['new_image']    = $thumb ;
			 
		// Do Resizing
		$this->image_lib->initialize($img);
		$this->image_lib->resize();
		$this->image_lib->clear() ;
                
                //$insert['tb_image_content'] = $data['file_name'];
                $insert['tb_name_products'] = $this->input->post("title");
                $insert['tb_date_products'] = $this->input->post("date");
                $insert['tb_source_products'] = $this->input->post("content");
                $insert['tb_author_products'] = $this->input->post("author");
                $insert['tb_categories_products'] = $this->input->post("kategori");
                $insert['tb_status_products'] = 1;
                
                $this->db->insert("wq_products",$insert);
                redirect($this->perm_user."/products");
            }
            else{
                echo $this->upload->display_errors();
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
                $insert['tb_name_products'] = $this->input->post("title");
                $insert['tb_date_products'] = $this->input->post("date");
                $insert['tb_source_products'] = $this->input->post("content");
                $insert['tb_author_products'] = $this->input->post("author");
                $insert['tb_categories_products'] = $this->input->post("kategori");
                $insert['tb_status_products'] = 1;
                
                $this->db->insert("wq_products",$insert);
                redirect($this->session->userdata("permission")."/products");
          }
          else{
            $config['upload_path']      = './media/products/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']         = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload("img")){
                $data = $this->upload->data();
                
                $source = "./media/products/".$data['file_name'];
                $thumb = "./media/products/thumb";
                
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
                
                //$insert['tb_image_content'] = $data['file_name'];
                $insert['tb_name_products'] = $this->input->post("title");
                $insert['tb_date_products'] = $this->input->post("date");
                $insert['tb_source_products'] = $this->input->post("content");
                $insert['tb_author_products'] = $this->input->post("author");
                $insert['tb_categories_products'] = $this->input->post("kategori");
                $insert['tb_status_products'] = 1;
                
                $this->db->insert("wq_products",$insert);
                redirect($this->perm_user."/content");
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
        $a['title'] = "SamMarie Application - Edit Products";
        $a['title2'] = "Edit Products";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/products/saveupdate";
        $whre['tb_id_content'] = $uri;
        $content = $this->db->select('wq_products.*,wq_image.tb_name_image,wq_image.tb_link_image');
        $content .= $this->from('wq_products');
        $content .= $this->join('wq_image','wq_image.tb_link_image=wq_products.tb_id_products');
        $content .= $this->where('wq_products',$whre);
        $content .= $this->get();
        foreach($content->result() as $b){
            $a['id'] = $b->tb_id_products;
            $a['name'] = $b->tb_name_products;
            $a['date'] = $b->tb_date_products;
            $a['author'] = $b->tb_author_products;
            $a['source'] = $b->tb_source_content;
            $a['image'] = $b->tb_name_image;
            $a['categories'] = $b->tb_categories_products;
            $a['status'] = $b->tb_status_products;
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
           
           $where['tb_id_content'] = $uri;
           $this->db->delete("wq_content",$where);
           $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Content Berhasil Di Hapus</div>');
           redirect($this->perm_user."/content");
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
        $where['tb_status_content'] = 1;
        $this->db->where('tb_id_content',$id);
        $this->db->update("wq_content",$where);
        $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Content Berhasil Di Publish</div>');
        redirect($this->perm_user."/content");
        }
        else{
          redirect("auth/auth");
      }
    }
}
