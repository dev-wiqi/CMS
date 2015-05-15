<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class brands extends MX_Controller {
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
        $a['title'] = "SamMarie Application";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['link'] = $this->perm_user."/brands/add";
        $a['profile'] = $this->models_admin->profile_top($this->session->userdata("id_user"));
        $a['content'] = $this->models_admin->content('brands');
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/brands");
        $this->load->view("admin/footer");
    }
    
     public function add(){
        $a['title'] = "SamMarie Application";
        $a['title2'] = "Tambah Brands";
        $a['permission'] = $this->perm_user;
        $a['mweb'] = $this->models_admin->menu("web",$this->perm_user);
        $a['mblog'] = $this->models_admin->menu("blog",  $this->perm_user);
        $a['madmin'] = $this->models_admin->menu("admin",  $this->perm_user);
        $a['mproducts'] = $this->models_admin->menu("products",$this->perm_user);
        $a['profile'] = $this->models_admin->profile_top(1);
        $a['action'] = $this->perm_user."/brands/save";
        
        $this->load->view("admin/head",$a);
        $this->load->view("admin/menu");
        $this->load->view("admin/addbrands");
        $this->load->view("admin/footer");
    }
    
    public function save(){
        if ($this->perm_user=="administrator" && $this->logged_in=="ikehikehkimochi"){
        $this->form_validation->set_rules('title','Title','trim|required');
        //$this->form_validation->set_rules('img','Image','trim|required');
        
        if ($this->form_validation->run() == FALSE){
            show_error("Validation Error Bro",500); 
        }
        else{
            $config['upload_path'] = './media/brands/';
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['encrypt_name']	= TRUE;
            $config['remove_spaces']	= TRUE;	
            $config['max_size']     = '3000';
            $config['max_width']  	= '3000';
            $config['max_height']  	= '3000';
			 
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if($this->upload->do_upload("img")){
                $data = $this->upload->data();
                
                $source = "./media/brands/".$data['file_name'];
                $thumb = "./media/brands/thumb";
                
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
                
                $insert['tb_image_config'] = $data['file_name'];
                $insert['tb_name_config'] = $this->input->post("title");
                $insert['tb_location_config'] = 'brands';
                $insert['tb_status_config'] = 1;
                $this->db->insert("wq_config",$insert);
               
                redirect($this->perm_user."/brands");
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
    
       
}
