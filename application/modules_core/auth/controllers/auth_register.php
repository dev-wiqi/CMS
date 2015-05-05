<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class auth_register extends MX_Controller {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    public function index(){
        if($this->session->userdata("log_in")=="")
        {
        
            $a['title'] = "SamMarie Register";
            
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');
        
            if ($this->form_validation->run() == FALSE){
                
                $this->load->view("auth/register",$a);
            }
            else{
                $data['username'] = $this->input->post("username");
                $data['password'] = $this->input->post("password");
                $data['email'] = $this->input->post("email");
                $data['permission'] = "administrator";
            
                $this->models_auth->register($data);
              }
        }
        else
        {
            $type = $this->session->userdata("permission");
            redirect($type."/dashboard");
        }
        
    }
}
