<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['admin_data'] = $this->admin->getAdminRecords();
        $data['page_name'] = 'adminData';
        $data['breadcum'] = 'Manage Admin';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/admin/admin_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|is_unique[tbl_admin.admin_username]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_admin.admin_email]');

            if ($this->form_validation->run()) {

                $Data = $this->admin->add();
                $this->session->set_flashdata('AdminSuccess', 'Admin Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/admin-list');
                exit;
            } else {
                $data['username'] = $this->input->post('username');
                $data['password'] = $this->input->post('password');
                $data['phone'] = $this->input->post('phone');
                $data['email'] = $this->input->post('email');
            }
        }

        $data['page_name'] = 'admin';
        $data['breadcum'] = 'Add Admin';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/admin/admin_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($adminId) {

        $lists = $this->admin->getAdminRecordById($adminId);
        $data['admin_id'] = $adminId;
        $data['username'] = $lists['admin_username'];
        $data['email'] = $lists['admin_email'];
        $data['phone'] = $lists['admin_phone'];
        //$data['password'] = $lists['admin_password']; 

        if (!empty($_POST)) {
            // pr($_POST);die;
            $data['username'] = $this->input->post('username');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $email = $this->input->post('email');


            $default_email = $this->admin->checkEmail($adminId);
            //pr($default_email );die;
            $email_address = $default_email['admin_email'];
            if ($email_address != $email) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_admin.admin_email]');
            }
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');



            if ($this->form_validation->run()) {

                $adminData = $this->admin->update($adminId);
                $this->session->set_flashdata('AdminSuccess', 'Admin Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/admin-list');
                exit;
            }
        }
        $data['page_name'] = 'admin';
        $data['breadcum'] = 'Edit Admin';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/admin/admin_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($adminId, $status) {
        $data = $this->admin->countAllAdmin();
        if ($data != '1') {
            $adminData = $this->admin->updateStatus($adminId, $status);
            $this->session->set_flashdata('AdminSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/admin-list');
            exit;
        } else {
            $this->session->set_flashdata('AdminError', 'You can not change status of this record');
            redirect($this->config->item('adminFolder') . '/admin-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/admin/admin_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($adminId) {
        $data = $this->admin->countAllAdmin();
        $image = $this->admin->getFileName($adminId);
        $image_name = $image['icon_image'];
        if ($data != '1') {
            unlink('assets/uploads/icon_images/' . $image_name);
            $this->admin->delete($adminId);
            $this->session->set_flashdata('AdminSuccess', 'Admin Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/admin-list');
            exit;
        } else {
            $this->session->set_flashdata('AdminError', 'You can not delete this admin record!');
            redirect($this->config->item('adminFolder') . '/admin-list');
            exit;
        }
    }

}
