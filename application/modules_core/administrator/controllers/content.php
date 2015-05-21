<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class content extends MX_Controller {
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
        $a['link'] = $this->perm_user."/content/add";
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('content');
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/content");
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
        $a['action'] = $this->perm_user."/content/save";
        $a['categories'] = $this->models_admin->categories("web",null);
        $a['author'] = $this->session->userdata("id_user");
        
       
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addcontent");
        $this->load->view("admin/footer");
        }
        else{
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
        $a['title'] = "SamMarie Application - Edit Content";
        $a['title2'] = "Edit Content";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['action'] = $this->perm_user."/content/saveupdate";
        $whre['tb_id_content'] = $uri;
        $content = $this->db->get_where("wq_content",$whre);
        foreach($content->result() as $b){
            $a['id'] = $b->tb_id_content;
            $a['name'] = $b->tb_name_content;
            $a['date'] = $b->tb_date_content;
            $a['author'] = $b->tb_author_content;
            $a['source'] = $b->tb_source_content;
            $a['image'] = $b->tb_image_content;
            $categories = $b->tb_categories_content;
            $a['status'] = $b->tb_status_content;
        }
            $a['categories'] = $this->models_admin->categories("web",$categories);
            $a['image'] = $this->models_admin->image_db("web",$uri);
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/editcontent");
        $this->load->view("admin/footer");
       }
       else{
           redirect("auth/auth");
       }
    }

     public function save(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $this->form_validation->set_rules('title','Title','trim|required');
        
        if ($this->form_validation->run() == FALSE){
            show_error("Error Validation",500);
        }
        else{
            $config['upload_path']      = './media/content/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']         = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('MY_upload');
            $this->upload->initialize($config);
            
            if($this->upload->do_multi_upload("img") == FALSE){
                $insert['tb_name_content'] = $this->input->post("title");
                $insert['tb_date_content'] = $this->input->post("date");
                $insert['tb_source_content'] = $this->input->post("content");
                $insert['tb_author_content'] = $this->input->post("author");
                $insert['tb_categories_content'] = $this->input->post("kategori");
                $insert['tb_status_content'] = 1;
                $this->db->insert("wq_content",$insert);
                $insert_id = $this->db->insert_id();
                $data = $this->upload->get_multi_upload_data();
                $max = count($data);
                for($i=0; $i<$max; $i++){
                $source = "./media/content/".$data[$i]['file_name'];
                $thumb = "./media/content/thumb";
                
                chmod($source, 0777);
                chmod($thumb, 0777);
                
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
                
                $insimg['tb_name_image'] = $data[$i]['file_name'];
                $insimg['tb_location_image'] = "web";
                $insimg['tb_link_image'] = $insert_id;
                $this->db->insert("wq_image",$insimg);
                }
                redirect($this->perm_user."/content");
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
        
        if ($this->form_validation->run() == FALSE){
            show_error("Wrong Validation");
        }
        else{
          if(empty($_FILES['img']['name'])){
                $insert['tb_name_content'] = $this->input->post("title");
                $insert['tb_date_content'] = $this->input->post("date");
                $insert['tb_source_content'] = $this->input->post("content");
                $insert['tb_author_content'] = $this->input->post("author");
                $insert['tb_categories_content'] = $this->input->post("kategori");
                $where = $this->input->post("id");
                
                $this->db->where("tb_id_content",$where);
                $this->db->update("wq_content",$insert);
                
                $this->session->set_flashdata("result_action",'<div class="alert margin"><button type="button" class="close" data-dismiss="alert">X</button>Content Berhasil Di edit</div>');
                redirect($this->perm_user."/content");
          }
          else{
            $config['upload_path']      = './media/content/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']         = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('MY_upload');
            $this->upload->initialize($config);
            
            if($this->upload->do_multi_upload("img") == FALSE){
                $data = $this->upload->get_multi_upload_data();
               
                $max = count($data);
                for($i=0; $i<$max; $i++){
                $source = "./media/content/".$data[$i]['file_name'];
                $thumb = "./media/content/thumb";
                
                chmod($source, 0777);
                chmod($thumb, 0777);
                
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
                
                $insimg['tb_name_image'] = $data[$i]['file_name'];
                $insimg['tb_location_image'] = "web";
                $insimg['tb_link_image'] = $this->input->post("id");
                $this->db->insert("wq_image",$insimg);
                }
                
                $insert['tb_name_content'] = $this->input->post("title");
                $insert['tb_date_content'] = $this->input->post("date");
                $insert['tb_source_content'] = $this->input->post("content");
                $insert['tb_author_content'] = $this->input->post("author");
                $insert['tb_categories_content'] = $this->input->post("kategori");
                $where = $this->input->post("id");
                $this->db->where("tb_id_content",$where);
                $this->db->update("wq_content",$insert);
                redirect($this->perm_user."/content");
            }
            else {
                echo $this->upload->display_error();
            }
        }
       }
      }
      else {
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
