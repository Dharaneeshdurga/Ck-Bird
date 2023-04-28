<?php

class LoginModel extends CI_Model {

    public function checkLogin($data) {
        
        //query the table 'users' and get the result count
        $this->db->select("*");
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('user_pass', $data['user_pass']);
        $this->db->where('status', $data['status']);
        $query = $this->db->get('ckb_users')->row_array();

        return $query;
    }

         public function get_role_permission($user_role_id){
                     $this->db->select("*");
                    $this->db->from('ckb_role_permission');
                    $this->db->where('role_id', $user_role_id);
                    $query = $this->db->get();   
                    return $query->result_array();
        }
}