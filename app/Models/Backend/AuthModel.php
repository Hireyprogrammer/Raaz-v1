<?php

namespace App\Models\Backend;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table   = 'tbl_users';

    public function login($user,$pwd,$locale){
        try {
            $qry = $this->db->query("SELECT * FROM tbl_users WHERE user_name=?", array($user));
            $data = $qry->getRowArray();
          
            if ($data != null) {
              
                $db_pwd = $data['passwd'];
                $brid = $data['branch_id'];
                
                // check password
                if (password_verify($pwd, $db_pwd)) {

                    if ($data['user_status'] == 'Active') {

                        $user_id = $data['user_id'];
            
                        $userdata = [
                            'user' => $data,
                            'ut_id' => $user_id,
                            'isLoggedIn' => true,
                            'branch_name' => "ALRAYYAN CAFETERIA"
                        ];
                        
                        return [
                            'success' => true,
                            'message' => 'Login Successful',
                            'sess' => $userdata
                        ];
                    } else return ['success' => 0 ,'message' => 'User account is not active'];
                    
                    
                } else return ['success' => 0 ,'message' => 'Invalid Password'];
            } else return ['success' => 0 ,'message' => 'Invalid Username'];
        } catch (\Exception $e) {
            log_message('error', 'Login model error: ' . $e->getMessage());
            return ['success' => 0, 'message' => 'Database error occurred'];
        }
   }

   public function get_user_access($user_id,$locale){

    // $rec = session()->get("access");
    // $ut_id = session()->get("user")['ut_id'];

    // $qry = $this->db->query("SELECT m.tab_id, m.tab_name_en, m.tab_name_en, m.tab_name_ar,m.tab_icon, m.tab_url, m.tab_parent, m.tab_order
    //                             FROM tbl_menu m JOIN tbl_menu_access ma ON m.tab_id = ma.tab_id AND ma.ut_id='$ut_id' 
    //                             WHERE m.tab_parent='0' order by tab_order asc");

    $qry = $this->db->query("SELECT m.tab_id, m.tab_name_en, m.tab_name_en, m.tab_name_ar,m.tab_icon, m.tab_url, m.tab_parent, m.tab_order
    FROM tbl_menu m JOIN tbl_menu_access ma ON m.tab_id = ma.tab_id WHERE m.tab_parent='0' AND ma.user_id='$user_id'  order by tab_order asc");

    $rec = $qry->getResultArray();

    $p_li = '';
    $ptab = '';
    foreach ($rec as $val) { 

        if($locale == 'ar'){
            $ptab = $val['tab_name_ar'];
        }else{
            $ptab = $val['tab_name_en'];
        }

     $p_li .= '<li class="sidebar-item">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false" style="color: white !important;">
            <i data-feather="'.$val['tab_icon'].'" class="feather-icon" style="color: white !important;"></i>
            <span class="hide-menu" style="color: white !important;">'.$ptab.' </span>
        </a>';

    
    //  $sub_menus = $this->db->query("SELECT m.tab_id, m.tab_name_en, m.tab_name_ar, m.tab_icon, m.tab_url, m.tab_parent, m.tab_order 
    //                                 FROM tbl_menu m where m.tab_parent = '".$val['tab_id']."' and (select count(*) from tbl_menu_access 
    //                                 where ut_id = '".$ut_id."' and tab_id = '".$val['tab_id']."') > 0")->getResult();

     $sub_menus = $this->db->query("SELECT m.tab_id, m.tab_name_en, m.tab_name_ar, m.tab_icon, m.tab_url, m.tab_parent, m.tab_order 
    FROM tbl_menu m JOIN tbl_menu_access ma ON m.tab_id = ma.tab_id where m.tab_parent = '".$val['tab_id']."' AND ma.user_id='$user_id' ")->getResult();

     $p_li .= '<ul aria-expanded="false" class="collapse  first-level">';
        $ch_li = '';
        foreach ($sub_menus as $menu) { 

            if($locale == 'ar'){
                $chtab = $menu->tab_name_ar;
            }else{
                $chtab = $menu->tab_name_en;
            }
      
            // Check if this is the active menu (you may need to modify this logic to determine the active menu)
            $isActive = (current_url() == base_url($locale.'/') . $menu->tab_url) ? true : false;
            $activeClass = $isActive ? 'active-submenu' : '';
            $activeStyle = $isActive ? 'background-color: #3e97ff !important;' : '';
            
            $ch_li .= '<li class="sidebar-item '.$activeClass.'">
                <a href="'.base_url($locale.'/') . $menu->tab_url.'" class="sidebar-link" style="color: white !important; '.$activeStyle.'">
                    <i class="mdi mdi-adjust" style="color: white !important;"></i><span class="hide-menu" style="color: white !important;">'.$chtab.'</span>
                </a>
                </li>';
            
        
        } 
        $p_li .= $ch_li;
        $p_li .= '</ul></li>';
    }
    return $p_li;

 }


}