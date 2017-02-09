<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_Provider extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/user_model', 'user');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['service_provider_data'] = $this->user->getUserRecords('service_provider');
        $data['page_name'] = 'Service-Provider Manage';
        $data['breadcum'] = 'Manage Service-Provider';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/user/service_provider_list');
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
                $this->session->set_flashdata('CustomerSuccess', 'Admin Has Been Added Successfully');
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

    public function edit($id) {

        $lists = $this->user->getUserRecordsById($id, 'customer');

        $data['uacc_id'] = $id;
        $data['uacc_email'] = $lists['uacc_email'];
        $data['upro_phone'] = $lists['upro_phone'];

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
                $this->session->set_flashdata('CustomerSuccess', 'Admin Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/admin-list');
                exit;
            }
        }
        $data['page_name'] = 'admin';
        $data['breadcum'] = 'Edit Admin';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/customer/customer_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($id, $status) {
        //$data = $this->admin->countAllAdmin();
        if ($id != '' && $status != '') {
            $adminData = $this->user->updateStatus($id, $status);
            $this->session->set_flashdata('CustomerSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/service-provider-list');
            exit;
        } else {
            $this->session->set_flashdata('CustomerError', 'You can not change status of this record');
            redirect($this->config->item('adminFolder') . '/service-provider-list');
            exit;
        }
    }

    public function delete($id) {
        if ($id != '') {
            $this->user->delete($id);
            $this->session->set_flashdata('CustomerSuccess', 'Customer Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/customer-list');
            exit;
        } else {
            $this->session->set_flashdata('CustomerError', 'You can not delete this customer record!');
            redirect($this->config->item('adminFolder') . '/customer-list');
            exit;
        }
    }

    public function check_images($id) {
        if ($id != '') {
            $data['partner_images'] = $this->user->getPartnerImagesById($id);
            $data['breadcum'] = 'Check Partner Images';
            $this->load->view($this->config->item('adminFolder') . '/header', $data);
            $this->load->view($this->config->item('adminFolder') . '/user/service_provider_image_list');
            $this->load->view($this->config->item('adminFolder') . '/footer');
        }
    }

}
