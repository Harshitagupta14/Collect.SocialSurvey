<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Model extends CI_Model {

    var $tableUser = 'user_accounts';
    var $tableUserDetails = 'user_profiles';
    var $tablePartnerImages = 'tbl_partner_images';

    function getUserRecords($type) {
        $this->db->select('user_accounts.*,user_profiles.*');
        $this->db->from('user_accounts');
        $this->db->join('user_profiles', 'user_accounts.uacc_id = user_profiles.upro_uacc_fk', 'left');
        $this->db->where('user_profiles.upro_type', $type);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getUserRecordsById($id, $type) {
        $this->db->select('user_accounts.*,user_profiles.*');
        $this->db->from('user_accounts');
        $this->db->join('user_profiles', 'user_accounts.uacc_id = user_profiles.upro_uacc_fk', 'left');
        $this->db->where('user_profiles.upro_type', $type);
        $this->db->where('uacc_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function getPartnerImagesById($id) {
        $this->db->select('user_profiles.upro_identity_image,tbl_partner_images.*');
        $this->db->from('user_profiles');
        $this->db->join('tbl_partner_images', 'tbl_partner_images.user_id_fk = user_profiles.upro_uacc_fk', 'left');
        $this->db->where('user_id_fk', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function add() {

        if ($this->input->post('username'))
            $this->db->set('admin_username', $this->input->post('username'));
        if ($this->input->post('password'))
            $this->db->set('admin_password', md5($this->input->post('password')));
        if ($this->input->post('phone'))
            $this->db->set('admin_phone', $this->input->post('phone'));
        if ($this->input->post('email'))
            $this->db->set('admin_email', $this->input->post('email'));

        $this->db->set('status', 'active');
        $this->db->set('add_time', time());

        $query = $this->db->insert($this->tableUser);
        $response = $this->db->insert_id();
        return $response;
    }

    function update($adminId) {
        // pr($_POST);die;
        if ($this->input->post('username'))
            $this->db->set('admin_username', ($this->input->post('username')));
        if ($this->input->post('phone'))
            $this->db->set('admin_phone', $this->input->post('phone'));
        if ($this->input->post('email'))
            $this->db->set('admin_email', $this->input->post('email'));
        $this->db->set('update_time', time());

        $this->db->where('admin_id', $adminId);
        $query = $this->db->update($this->tableUser);
        return $response;
    }

    function checkEmail($adminId) {
        $this->db->where('admin_id', $adminId);
        $query = $this->db->get($this->tableUser);
        $result = $query->row_array();
        return $result;
    }

    public function updateStatus($id, $status) {
        $this->db->set('upro_verified', $status);
        $this->db->where('upro_id', $id);
        $response = $this->db->update('user_profiles');
        return $response;
    }

    public function updatePassword() {
        $this->db->set('password', $_POST['newpass']);
        $this->db->where('password', $_POST['pass']);
        $response = $this->db->update($this->tableUser);
        return $response;
    }

    function countAllAdmin() {
        $this->db->where('status', 'active');
        $query = $this->db->get($this->tableUser);
        $result = $query->num_rows();
        return $result;
    }

    public function getFileName($adminId) {
        $this->db->where('admin_id', $adminId);
        $query = $this->db->get($this->tableUser);
        $result = $query->row_array();
        return $result;
    }

    public function delete($id) {
        $this->db->where('uacc_id', $id);
        $response = $this->db->delete($this->tableUser);
        $this->db->where('upro_uacc_fk', $id);
        $this->db->delete($this->tableUserDetails);
        return $response;
    }

}
