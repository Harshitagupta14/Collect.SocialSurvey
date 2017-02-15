<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Organization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('content_model', 'post');
        $this->load->model('survey_model', 'survey');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('components');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in()) {
            $this->flexi_auth->set_error_message('You must login to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        }
    }

    public function index() {
        $data['METATITLE'] = "Create Survey - Step 1";
        $data['METAKEYWORDS'] = "Create Survey - Step 1";
        $data['METADESCRIPTION'] = "Create Survey - Step 1";
        $data['organization'] = $this->flexi_auth->get_user_by_identity_row_array();
        $data['organization_surveyor_data'] = $this->survey->get_surveyor_by_args($this->flexi_auth->get_user_by_identity_row_array()['uacc_id']);
        $data['breadcrumb'] = '<li class="active">Services</li>';
        $this->load->view($this->config->item('template') . '/organization/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/organization/main_contents/organization_dashboard');
        $this->load->view($this->config->item('template') . '/organization/footer/footer_dashboard');
    }

    function ajax_register_surveyor() {
        $upro_first_name = $this->input->post('surveyor_first_name');
        $upro_last_name = $this->input->post('surveyor_last_name');
        $upro_phone = $this->input->post('surveyor_contact_number');

        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'surveyor_first_name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'surveyor_last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'surveyor_contact_number', 'label' => 'Contact Number', 'rules' => 'required'),
            array('field' => 'surveyor_email', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
            array('field' => 'surveyor_password', 'label' => 'Password', 'rules' => 'required|min_length[6]'),
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $email = $this->input->post('surveyor_email');
            $email_array = explode('@', $this->input->post('surveyor_email'));
            $username = $email_array[0];
            $password = $this->input->post('surveyor_password');
            $profile_data = array(
                'upro_first_name' => $upro_first_name,
                'upro_last_name' => $upro_last_name,
                'upro_phone' => $upro_phone,
                'upro_newsletter' => '',
                'ugrp_id' => '3',
                'uacc_parent_id_fk' => $this->flexi_auth->get_user_by_identity_row_array()['uacc_id']
            );
            $response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, 3, 1);
            if ($response) {
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'success' => 'true'
                );
            }
        } else {
            $data = array(
                'success' => 'false',
                'surveyor_first_name_error' => form_error('surveyor_first_name'),
                'surveyor_last_name_error' => form_error('surveyor_last_name'),
                'surveyor_contact_number_error' => form_error('surveyor_contact_number'),
                'surveyor_email_error' => form_error('surveyor_email'),
                'surveyor_password_error' => form_error('surveyor_password')
            );
        }
        echo json_encode($data);
        die;
    }

    public function ajax_change_surveyor_status() {
        $surveyor_id = $this->input->post('surveyor_id');
        $surveyor_status = $this->input->post('surveyor_status');
        if ($surveyor_status == 0) {
            $new_surveyor_status = 1;
        } else {
            $new_surveyor_status = 0;
        }
        $response = $this->common_model->update_data('user_accounts', array('uacc_id' => $surveyor_id), array('uacc_suspend' => $new_surveyor_status));
        if ($response) {
            if ($new_surveyor_status == 1) {
                $data = array(
                    'success' => 'true',
                    'status' => 'Suspended'
                );
            } else {
                $data = array(
                    'success' => 'true',
                    'status' => 'Activated'
                );
            }
        } else {
            $data = array(
                'success' => 'false',
                'status' => 'Please try again!'
            );
        }
        echo json_encode($data);
        die;
    }

    public function ajax_update_organization_details() {
        $organization_id = $this->input->post('organization_id');
        $organization_type = $this->input->post('organization_type');
        $organization_name = $this->input->post('organization_name');

        $response = $this->common_model->update_data('user_profiles', array('upro_uacc_fk' => $organization_id), array('upro_company_type' => $organization_type, 'upro_company' => $organization_name));
        if ($response) {
            $data = array(
                'success' => 'true',
            );
        } else {
            $data = array(
                'success' => 'false',
            );
        }
        echo json_encode($data);
        die;
    }

}
