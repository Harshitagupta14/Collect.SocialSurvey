<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Log_Model extends CI_Model {

    var $tableName = 'tbl_admin_log';

    function adminlog_list() {       
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }

    function add($browser, $version, $platform, $mobile) {
        $operating_system = ($mobile != "") ? $platform . '-' . $mobile : $platform;
        $data = array(
            'admin_id' => $this->session->userdata('admin_id'),
            'admin_username' => $this->session->userdata('admin_user_name'),
            'login_time' => time(),
            'login_ip' => $_SERVER['REMOTE_ADDR'],
            'operating_system' => $operating_system,
            'browser' => $browser . "-Version-" . $version
        );
        $this->db->insert($this->tableName, $data);
    }

    public function clear() {
        $response = $this->db->truncate($this->tableName);
        return $response;
    }

}
