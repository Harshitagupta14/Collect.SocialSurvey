<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enquiry extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/enquiry_model', 'enquiry');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['enquiry_data'] = $this->enquiry->getEnquiryList();
        $data['page_name'] = 'enquiry';
        $data['breadcum'] = 'Manage Contact Detail';
        $this->load->view($this->config->item('adminFolder') . "/header", $data);
        $this->load->view($this->config->item('adminFolder') . '/enquiry/enquiry_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function view($enquiryId) {
        $readData = $this->enquiry->updateReadStatus($enquiryId, 'read');

        $data['view_data'] = $this->enquiry->viewContactById($enquiryId);
        $data['page_name'] = 'enquiry';
        $data['breadcum'] = 'View Contact Detail';


        $this->load->view($this->config->item('adminFolder') . '/enquiry/enquiry_view', $data);
    }

    public function delete($enquiryId) {
        if (isset($enquiryId) && $enquiryId != '') {
            $this->enquiry->delete($enquiryId);
            $this->session->set_flashdata('EnquirySuccess', 'Contact Detail Has Been Deleted Successfully');
            redirect('admin/enquiry-list');
            exit;
        }
    }

}
