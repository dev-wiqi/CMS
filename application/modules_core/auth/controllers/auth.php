<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    public function index(){
        if($this->session->userdata("log_in")=="")
        {
        
            $a['title'] = "SamMarie Login";
            
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');
        
            if ($this->form_validation->run() == FALSE){
                $this->load->view("auth/login",$a);
            }
            else{
                $data['username'] = $this->input->post("username");
                $data['password'] = $this->input->post("password");
            
                $this->models_auth->login($data);
              }
        }
        else
        {
            $type = $this->encrypt->decode($this->session->userdata("permission"));
            redirect($type."/home");
        }
        
    }
}
