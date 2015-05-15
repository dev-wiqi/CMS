<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class models_auth extends CI_Model {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    function __construct() {
        parent::__construct();
        $this->db_admin = $this->load->database("admin",TRUE);
    }
    
    function login($data){
        
        $check['tb_name_userlogin'] = mysql_escape_string($data['username']);
        $check['tb_password_userlogin'] = md5(mysql_escape_string($data['password']).$this->config->item("skey"));
        $login_que = $this->db_admin->get_where('wq_userlogin', $check);
        if (count($login_que->result())>0){
            foreach($login_que->result() as $var){
                $permission = $this->encrypt->decode($var->tb_permission_userlogin);
                if ($permission == "editor"){
                    if ($var->tb_status_userlogin == 1){
                    $sess['log_in'] = $this->encrypt->encode('ikehikehkimochi');
                    $sess['username'] = $var->tb_name_userlogin;
                    $sess['detail_user'] = $var->tb_detail_userlogin;
                    $sess['id_user'] = $var->tb_id_userlogin;
                    $sess['image_user'] = $var->tb_image_userlogin;
                    $sess['permission'] = $var->tb_permission_userlogin;
                    $this->session->set_userdata($sess);
                    redirect("editor/home");
                    }
                    else {
                        $this->session->set_flashdata("result_login",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Maaf Username Anda Sementara Di Nonaktifkan, Silahkan Hubungi Administrator</div>');
                        redirect("auth/auth");
                    }
                }
                elseif ($permission == "writer") {
                    if ($var->tb_status_userlogin == 1){
                    $sess['log_in'] = $this->encrypt->encode('ikehikehkimochi');
                    $sess['username'] = $var->tb_name_userlogin;
                    $sess['detail_user'] = $var->tb_detail_userlogin;
                    $sess['id_user'] = $var->tb_id_userlogin;
                    $sess['image_user'] = $var->tb_image_userlogin;
                    $sess['permission'] = $var->tb_permission_userlogin;
                    $this->session->set_userdata($sess);
                    redirect("writer/home");
                    }
                    else {
                        $this->session->set_flashdata("result_login",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Maaf Username Anda Sementara Di Nonaktifkan, Silahkan Hubungi Administrator</div>');
                        redirect("auth/auth");
                    }
                }
                elseif ($permission == "administrator") {
                    if ($var->tb_status_userlogin == 1){
                    $sess['log_in'] = $this->encrypt->encode('ikehikehkimochi');
                    $sess['username'] = $var->tb_name_userlogin;
                    $sess['detail_user'] = $var->tb_detail_userlogin;
                    $sess['id_user'] = $var->tb_id_userlogin;
                    $sess['image_user'] = $var->tb_image_userlogin;
                    $sess['permission'] = $var->tb_permission_userlogin;
                    $this->session->set_userdata($sess);
                    redirect("administrator/home");
                    }
                    else {
                        $this->session->set_flashdata("result_login",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Maaf Username Anda Sementara Di Nonaktifkan, Silahkan Hubungi Administrator</div>');
                        redirect("auth/auth");
                    }
                }
                else{
                    $this->session->set_flashdata("result_login","Username Anda Tidak Terdaftar Pada Permission");
                    redirect("auth/auth");
                }
            }
        }
        else
        {
            $this->session->set_flashdata("result_login",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Username Anda Tidak Terdaftar</div>');
            redirect("auth/auth");
        }
        
    }
    
    function logout(){
        session_destroy();
        redirect("auth/login");
    }
    
    function register($data){
        $reg['tb_name_userlogin'] = mysql_escape_string($data['username']);
        $reg['tb_email_userlogin'] = $data['email'];
        //check username
        $check = $this->db_admin->get_where('wq_userlogin',$reg)->num_rows();
        if($check>0){
            $this->session->set_flashdata("result_register",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Maaf Username Sudah Terpakai</div>');
            redirect("auth/auth_register");
        }
        else{
            $input['tb_permission_userlogin'] = $this->encrypt->encode($data['permission']);
            $input['tb_name_userlogin'] = $data['username'];
            $input['tb_password_userlogin'] = md5(mysql_escape_string($data['password']).$this->config->item("skey"));
            $input['tb_email_userlogin'] = $data['email'];
            
            $this->db_admin->insert("wq_userlogin",$input);
            $this->session->set_flashdata("result_register",'<div class="alert"><button type="button" class="close" data-dismiss="alert">X</button>Akun Berhasil Di Buat, Silahkan Cek email untuk Aktifasi Akun</div>');
            
            redirect("auth/auth");
        }
    }
    
    function activation($keyid){
        $chk['tb_keyid_activation'] = $keyid;
        $check = $this->db_admin->get_where("wq_activation",$chk)->num_rows();
        if ($check>0){
            $encode['tb_name_userlogin'] = $this->encrypt->encode($keyid);
            $que = $this->db_admin->get_where("wq_userlogin",$encode);
            if ($que>0){
                $act['tb_activation_userlogin'] = 1;
                $this->db_admin->update("wq_userlogin",$act,$encode);
                $this->session->set_flashdata("result_activation","Aktifasi anda sukses, silahkan login");
                redirect("auth/login");
            }
            else {
                $this->session->set_flashdata("result_activation","Kode aktifasi anda tidak sesuai, silahkan hubungi administrator");
                redirect("web");
            }
        }
        else {
            $this->session->set_flashdata("result_activation","Kode aktifasi anda tidak ada");
            redirect("web");
        }
    }
    
    function forgot($data){
        $username = $this->encrypt->decode($data['username']);
        $chk['tb_email_userlogin'] = $data['email'];
        
        $check = $this->db_admin->get_where("wq_userlogin",$chk);
        foreach($check->result() as $var){
            if ($var->tb_username_userlogin == $username){
                
            }
        }
    }
    
}
