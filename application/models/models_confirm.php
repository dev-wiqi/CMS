<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class models_confirm extends CI_model {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    function contact_confirm ()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $web = $this->input->post('website');
        $source = $this->input->post('messages');
        
    }
    
    function insert_data($data)
    {
        $table=$data['table'];
        if(isset($table))
        {
            if($table=="wq_menu"){
                $input['tb_name_menu']=$data['menu'];
                $input['tb_link_menu']=$data['link'];
                $input['tb_parent_menu']=$data['parent'];
                $input['tb_location_menu']=$data['location'];
                $input['tb_status_menu']=1;
                
                $this->db->insert("wq_menu",$input);
                $this->session->set_flashdata("result_confirm","Menu Sukses Di Input");
                
                redirect($this->session->userdata("permission")."/home");
            }
            elseif ($table=="wq_categories"){
                $input['tb_name_categories']=$data['categories'];
                $input['tb_sub_categories']=$data['subcategories'];
                $input['tb_status_categories']=1;
            
                $this->db->insert("wq_categories",$input);
                $this->session->set_flashdata("result_confirm","Kategori Sukses Di tambahkan");
                
                redirect($this->session->userdata("permission"."/home"));
            }
            elseif ($table=="wq_slider"){
                $input['tb_name_slider']=$data['slider'];
                $input['tb_image_slider']=$data['image'];
                $input['tb_status_slider']=1;
                
                $this->db->insert("wq_slider",$input);
                $this->session->set_flashdata("result_confirm","Slider Sukses Ditambahkan");
                
                redirect($this->session->userdata("permission"."/home"));
            }
        }
    }
    
}
