<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class models_admin extends CI_model {
    /*
     * SamMarie Application V.1.0 Copyright 2014
     * Build Date : 17 Juli 2014
     * Founder & Programmer : Wisnu Groho Aji 
     * Website : http://wiqi.co
     */
    
    function __construct() {
        $this->db_admin = $this->load->database("admin",TRUE);
        $this->db = $this->load->database("default", TRUE);
        $this->logged_in=$this->encrypt->decode($this->session->userdata("log_in"));
        $this->perm_user=$this->encrypt->decode($this->session->userdata("permission"));
    }
    
    private function count($userid,$argv){
        //argv for argumen table search
        
    }
    
    function top_bar(){
        $value = '';
        $where['tb_location_cofig'] = 'title';
        $que = $this->db_admin->get_where('wq_config',$where);
        foreach($que->result() as $a){
            $value .= '<a href="'.base_url().'/manage" class="appbrand pull-left"><span>'.$a->tb_name_config.'<span>'.$a->tb_set_config.'</span></span></a>';
        }
        return $value;
    }
    
    function profile_top($userid){
        $value = '';
        $where['tb_id_userlogin'] = $userid;
        $que = $this->db_admin->get_where("wq_userlogin",$where);
        $value .= '<ul class="top-menu">';
        $value .= '<li class="dropdown">';
        foreach($que->result() as $a){
            $value .= '<a class="user-menu" data-toggle="dropdown"><img src="http://img.tramedifa.com/user/"'.$a->tb_image_userlogin.'" alt="" /><span>Howdy, '.$a->tb_name_userlogin.'! <b class="caret"></b></span></a>';
            $value .= '<ul class="dropdown-menu">';
            $value .= '<li><a href="'.base_url().$this->perm_user.'/profile.aspx" title=""><i class="icon-user"></i>Profile</a></li>';
            $value .= '<li><a href="'.base_url().'auth/auth_logout.aspx" title=""><i class="icon-remove"></i>Logout</a></li>';
        }
        $value .= '</ul></li>';
        return $value;
    }
    
    function sidebar($userid){
        $value = '';
        $where['tb_id_userlogin'] = $userid;
        $que = $this->db_admin->get_where("wq_userlogin",$where);
        $value .= '<span class="profile">';
        foreach($que->result() as $a){
            $value .= '<a class="img" href="'.base_url().'myaccount/'.$a->tb_id_userlogin.'"><img src="'. base_url().'media/user/avatar/'.$a->tb_image_userlogin.'" alt="'.$a->tb_name_userlogin.'" /></a>';
            $value .= '<span><strong>Welcome</strong><a href="'.base_url().'myaccount/'.$a->tb_id_userlogin.'" class="glyphicons right_arrow">'.$a->tb_name_userlogin.' <i></i></a></span>';
          }
        $value .= '</span></span>';
        return $value;
    }
    
    function sidebar_notif($userid){
        $value = '';
    }
       
    function menu($location,$perm){
        $where['tb_location_menu']=$location;
        $where['tb_permission_menu']=$perm;
        $where['tb_status_menu']=1;
        $w = $this->db_admin->get_where("wq_menu",$where);
	$value = '';
            foreach($w->result() as $h)
            {
                $value .= '<li><a href="'.base_url().''.$perm.'/'.$h->tb_link_menu.'.aspx" title="">'.$h->tb_name_menu.'</a></li>';
            }
	return $value;
    }
    
    function simple_menu($sess){
        $where['tb_status_menu'] = 1;
        $value = "";
        $que = $this->db_admin->get_where("wq_menu",$where);
        if(($que->num_rows())>0){
            $value .= '<ul class="navigation widget">';
            $value .= '<li><a href="'.base_url().''.$sess.'/home"><i class="icon-home"></i>Dashboard</a></li>';
        }
        foreach ($que->result() as $a){
            $value .= '<li><a href="'.base_url().''.$sess.'/'.$a->tb_link_menu.'"><i class="'.$a->tb_icon_menu.'"></i>'.$a->tb_name_menu.'</a></li>';
        }
        if(($que->num_rows())>0){
            $value .= '</ul>';
        }
        return $value;
    }
    
    function content($data){
        $value = '';
        $status = '';
        if ($data == 'blog'){
            $que = $this->db->get_where("wq_blog");
            foreach($que->result_array() as $a){
                if($a['tb_status_blog']==1){$status="Publish";}elseif ($a['tb_status_blog'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_blog'].'</td>
                                    <td>'.$a['tb_name_blog'].'</td>
                                    <td>'.word_limiter($a['tb_source_blog'],15).'</td>
                                    <td>'.$a['tb_categories_blog'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/blog/update/'.$a['tb_id_blog'].'/'.url_title($a['tb_name_blog']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/blog/delete/'.$a['tb_id_blog'].'/'.url_title($a['tb_name_blog']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';
            }
            return $value;
        }
        elseif ($data == 'content'){
            $que = $this->db->get_where("wq_content");
            foreach($que->result_array() as $a){
                if($a['tb_status_content']==1){$status="Publish";}elseif ($a['tb_status_content'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_content'].'</td>
                                    <td>'.$a['tb_name_content'].'</td>
                                    <td>'.$a['tb_date_content'].'</td>   
                                    <td>'.word_limiter($a['tb_source_content'],20).'</td>
                                    <td>'.$a['tb_page_content'].'</td>
                                    <td>'.$a['tb_categories_content'].'</td>
                                    <td>'.$a['tb_author_content'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/content/update/'.$a['tb_id_content'].'/'.url_title($a['tb_name_content']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/content/delete/'.$a['tb_id_content'].'/'.url_title($a['tb_name_content']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';    
            }
            return $value;
        }
        elseif($data=='categories'){
                $where['tb_location_categories'] = "web";
                $que = $this->db->get_where("wq_categories",$where);
                foreach($que->result_array() as $a){
                if($a['tb_status_categories']==1){$status="Publish";}elseif ($a['tb_status_categories'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_categories'].'</td>
                                    <td>'.$a['tb_name_categories'].'</td>
                                    <td>'.$a['tb_sub_categories'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/categories/update/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/categories/delete/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
              return $value;
            }
         elseif($data=='slider') {
                $this->db->select('*');
                $this->db->from('wq_slider');
                $this->db->join('wq_image','wq_slider.tb_id_slider = wq_image.tb_link_image AND wq_image.tb_location_image = "slider"');
                $where['tb_status_slider'] = 1;
                $this->db->where($where);
                $que = $this->db->get();
                foreach($que->result_array() as $a){
                if($a['tb_status_slider']==1){$status="Publish";}elseif ($a['tb_status_slider'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_slider'].'</td>
                                    <td>'.$a['tb_name_slider'].'</td>
                                    <td>'.$a['tb_name_image'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/slider/update/'.$a['tb_id_slider'].'/'.url_title($a['tb_name_slider']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/slider/delete/'.$a['tb_id_slider'].'/'.url_title($a['tb_name_slider']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
              return $value;
         }
         elseif ($data=='testimonial') {
                $que = $this->db->get_where("wq_testimonial");
                foreach($que->result_array() as $a){
                if($a['tb_status_testimonial']==1){$status="Publish";}elseif ($a['tb_status_testimonial'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_testimonial'].'</td>
                                    <td>'.$a['tb_user_testimonial'].'</td>
                                    <td>'.$a['tb_source_testimonial'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/testimonial/update/'.$a['tb_id_testimonial'].'/'.url_title($a['tb_user_testimonial']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/testimonial/delete/'.$a['tb_id_testimonial'].'/'.url_title($a['tb_user_testimonial']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
                 return $value;
        }
        elseif ($data=='member'){
            $que = $this->db->get_where("wq_user");
                foreach($que->result_array() as $a){
                if($a['tb_status_user']==1){$status="Active";}elseif ($a['tb_status_user'] == 2){$status = "Verification";}else{$status = "Blocked";}
                $value .= '<tr><td>'.$a['tb_id_user'].'</td>
                                    <td>'.$a['tb_name_user'].'</td>
                                    <td>'.$a['tb_idrs_user'].'</td>
                                    <td>'.$a['tb_bdate_user'].'</td>
                                    <td>'.$a['tb_job_user'].'</td>
                                    <td>'.$a['tb_photo_user'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/member/update/'.$a['tb_id_user'].'/'.url_title($a['tb_name_user']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/member/delete/'.$a['tb_id_user'].'/'.url_title($a['tb_name_user']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
                 return $value;
        }
        elseif ($data=='menu'){
            $que = $this->db->get_where("wq_menu");
                foreach($que->result_array() as $a){
                if($a['tb_status_menu']==1){$status="Active";}elseif ($a['tb_status_menu'] == 2){$status = "Verification";}else{$status = "Blocked";}
                $value .= '<tr><td>'.$a['tb_id_menu'].'</td>
                                    <td>'.$a['tb_name_menu'].'</td>
                                    <td>'.$a['tb_parent_menu'].'</td>
                                    <td>'.$a['tb_link_menu'].'</td>
                                    <td>'.$a['tb_position_menu'].'</td>
                                    <td>'.$a['tb_location_menu'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/menu/update/'.$a['tb_id_menu'].'/'.url_title($a['tb_name_menu']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/menu/delete/'.$a['tb_id_menu'].'/'.url_title($a['tb_name_menu']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
             return $value;
        }
        elseif ($data=='brands'){
            $where['tb_location_config'] = "brands";
            $que = $this->db->get_where("wq_config",$where);
                foreach($que->result_array() as $a){
                    if($a['tb_status_config']==1){$status="Active";}elseif ($a['tb_status_config'] == 2){$status = "Verification";}else{$status = "Blocked";}
                    $value .= '<tr><td>'.$a['tb_id_config'].'</td>
                                    <td>'.$a['tb_name_config'].'</td>
                                    <td>'.$a['tb_image_config'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="table-controls">
                                            <li><a href="'.base_url().$this->perm_user.'/brands/update/'.$a['tb_id_config'].'/'.url_title($a['tb_name_config']).'.aspx" class="tip" title="Edit Content"><i class="fam-cross"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/brands/update/'.$a['tb_id_config'].'/'.url_title($a['tb_name_config']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/brands/delete/'.$a['tb_id_config'].'/'.url_title($a['tb_name_config']).'.aspx" class="tip" title="Remove Content"><i class="fam-database-delete"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';
                }
                return $value;
        }
         elseif ($data=='menuadmin'){
             $que = $this->db_admin->get_where("wq_menu");
                foreach($que->result_array() as $a){
                if($a['tb_status_menu']==1){$status="Active";}elseif ($a['tb_status_menu'] == 2){$status = "Verification";}else{$status = "Blocked";}
                $value .= '<tr><td>'.$a['tb_id_menu'].'</td>
                                    <td>'.$a['tb_name_menu'].'</td>
                                    <td>'.$a['tb_link_menu'].'</td>
                                    <td>'.$a['tb_parent_menu'].'</td>
                                    <td>'.$a['tb_position_menu'].'</td>
                                    <td>'.$a['tb_icon_menu'].'</td>
                                    <td>'.$a['tb_location_menu'].'</td>
                                    <td>'.$a['tb_permission_menu'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/menu_admin/update/'.$a['tb_id_menu'].'/'.url_title($a['tb_name_menu']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/menu_admin/delete/'.$a['tb_id_menu'].'/'.url_title($a['tb_name_menu']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
             return $value;
         }
         elseif ($data=='products') {
         $que = $this->db->get_where("wq_products");
            foreach($que->result_array() as $a){
                if($a['tb_status_products']==1){$status="Publish";}elseif ($a['tb_status_products'] == 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_products'].'</td>
                                    <td>'.$a['tb_name_products'].'</td>
                                    <td>'.$a['tb_date_products'].'</td>   
                                    <td>'.word_limiter($a['tb_source_products'],20).'</td>
                                    <td>'.$a['tb_categories_products'].'</td>
                                    <td>'.$a['tb_author_products'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/products/update/'.$a['tb_id_products'].'/'.url_title($a['tb_name_products']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/products/delete/'.$a['tb_id_products'].'/'.url_title($a['tb_name_products']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';    
            }
            return $value;
        }
        elseif($data=='catproducts'){
             $where['tb_location_categories'] = "products";
             $que = $this->db->get_where("wq_categories",$where);
                foreach($que->result_array() as $a){
                if($a['tb_status_categories']==1){$status="Publish";}elseif ($a['tb_status_categories']==2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_categories'].'</td>
                                    <td>'.$a['tb_name_categories'].'</td>
                                    <td>'.$a['tb_sub_categories'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/cat_products/update/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/cat_products/delete/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
              return $value;
        }
        elseif($data=='catblog'){
             $where['tb_location_categories'] = "blog";
             $que = $this->db->get_where("wq_categories",$where);
                foreach($que->result_array() as $a){
                if($a['tb_status_categories'] === 1){$status="Publish";}elseif ($a['tb_status_categories'] === 2){$status = "Moderation";}else{$status = "Not Publish";}
                $value .= '<tr><td>'.$a['tb_id_categories'].'</td>
                                    <td>'.$a['tb_name_categories'].'</td>
                                    <td>'.$a['tb_sub_categories'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <ul class="navbar-icons">
                                            <li><a href="'.base_url().$this->perm_user.'/cat_blog/update/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Edit Content"><i class="fam-pencil"></i></a> </li>
                                            <li><a href="'.base_url().$this->perm_user.'/cat_blog/delete/'.$a['tb_id_categories'].'/'.url_title($a['tb_name_categories']).'.aspx" class="tip" title="Remove Content"><i class="fam-cross"></i></a> </li>
                                        </ul>
                                    </td>
                                </tr>';  
                 }
              return $value;
        }
             
      }
    
      function categories($location,$idselect){
          $where['tb_location_categories'] = $location;
          $where['tb_status_categories'] = 1;
          $value = "";
          if (isset($location)){
             $que  = $this->db->get_where("wq_categories",$where);
          }
          elseif($location == null){
             $que  = $this->db->get_where("wq_categories"); 
          }
          
          foreach ($que->result_array() as $a){
              if($a['tb_id_categories'] == $idselect){
                  $value .= '<option value='.$a['tb_id_categories'].' selected="selected">'.$a['tb_name_categories'].'</option>';
              }
              else{
                   $value .= '<option value='.$a['tb_id_categories'].'>'.$a['tb_name_categories'].'</option>';
              }
          }
          return $value;
      }
      
      function list_menu($idselect){
          $value = '';
          if(isset($idselect)){
          $where['tb_parent_menu'] = $idselect;
          $que = $this->db->get_where("wq_menu",$where)->row();
            if($que->tb_name_menu == $idselect){
                  $value .= '<option value='.$que->tb_id_menu.' selected="selected">'.$que->tb_name_menu.'</option>';
                  
              }
              else{
                   $value .= '<option value="0" selected="selected">--Select Parent--</option>';
              }
           }
           $query = $this->db->get_where("wq_menu");
           foreach($query->result() as $a){
               $value .= '<option value='.$a->tb_id_menu.'>'.$a->tb_name_menu.'</option>';
           }
          return $value;
      }
      
      function content_menu($idselect){
          $value = '';
          $where['tb_status_content'] = 1;
          $que = $this->db->get_where("wq_content",$where);
          foreach ($que->result() as $a){
              if($a->tb_name_content == $idselect){
                  $value .= '<option value='.$a->tb_id_content.' selected="selected">'.$a->tb_name_content.'</option>';
              }
              else{
                  $value .= '<option value='.$a->tb_id_content.'>'.$a->tb_name_content.'</option>';
              }
          }
          return $value;
      }
      
      function image_db($location,$link){
          $value = '';
          $where['tb_location_image'] = $location;
          $where['tb_link_image'] = $link;
          $query = $this->db->get_where("wq_image",$where);
          foreach($query->result() as $a){
              $value .= '<img src="http://img.tramedifa.com/'.$location.'/thumb/'.$a->tb_name_image.'" width="30" height="30"/>';
          }
          return $value;
      }
      
    }
