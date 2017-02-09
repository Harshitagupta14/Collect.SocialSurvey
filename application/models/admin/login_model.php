<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_Model extends CI_Model {

    var $tablename = 'tbl_admin';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*     * ****** Purpose : Fuction Use For Authenticate user for access ************** */

    function check_login() {
        $admin_username = $this->input->post('admin_username');
        $admin_password = $this->input->post('admin_password');
        if ($admin_username != '' && $admin_password != '') {
            $this->db->where('admin_username', $admin_username);
            $this->db->where('admin_password', md5($admin_password));
            $this->db->where('status', 'active');
            $query = $this->db->get($this->tablename);
          // pr($query);die;
            if ($query->num_rows() > 0) {
                return $user_data = $query->row();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkEmail($admin_email) {
        $this->db->select('admin_username,admin_id,admin_email');
        $this->db->where('admin_email', $admin_email);
        $query = $this->db->get($this->tablename);
        $row = $query->row();
        return $row;
    }

    function generate_session($user_data) {
        $this->session->set_userdata('admin_id', $user_data->admin_id);
        $this->session->set_userdata('admin_email', $user_data->admin_email);
        $this->session->set_userdata('admin_user_name', $user_data->admin_username);
        return true;
    }

    public function forgotPassword() {
       $strnew = 'abcXdefgRhijklmnoYpqrstGuvwxJyz012345A6789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $shuff = str_shuffle($strnew);
        $newPassword = substr($shuff, 0, 8);
        $this->session->set_userdata('NEWPASSWORD', $newPassword);
        $this->db->set('admin_password', md5($newPassword));
       $this->db->where('admin_email', $this->input->post('admin_email'));
       $this->db->update($this->tablename);
        return $this->db->insert_id();
    }

}