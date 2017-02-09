<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminlog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in_via_password() || !$this->flexi_auth->is_admin()) {
            $this->flexi_auth->set_error_message('You must login as an admin to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('admin_login_url'));
            exit;
        }
        $this->load->model($this->config->item('adminFolder') . '/admin_log_model', 'adminlog');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['log_data'] = $lists = $this->adminlog->adminlog_list();
        $data['page_name'] = 'adminlog';
        $data['breadcum'] = 'Admin Log';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/adminlog/adminlog_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete() {
        $this->adminlog->clear();
        $this->session->set_flashdata('adminLogClearSuccess', 'Admin All Login Detail Has Been Removed successfully');
        redirect($this->config->item('adminFolder') . '/adminlog-list');
        exit;
    }

}
