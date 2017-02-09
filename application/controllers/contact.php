<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_model', 'contact');
        $this->load->model('mailsending_model', 'mail');
        $this->load->library('form_validation');
        $this->load->model('content_model', 'post_data');
        //$this->load->helper('captcha');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {
        if (!empty($_POST)) {
            $data['full_name'] = $this->input->post('full_name');
            $data['email_id'] = $this->input->post('email_id');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $this->form_validation->set_rules('full_name', 'Full_Name', 'trim|required');
            $this->form_validation->set_rules('email_id', 'Email_Address', 'trim|required|valid_email');
            $this->form_validation->set_rules('subject', 'subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run()) {
                $this->contact->insertNewContact();
                $this->mail->contactusmail();
                $this->session->set_userdata('contactSuccessMessage', 'You Have Successfully Send Your Contact Detail');
                redirect(site_url('contact'));
                exit();
            } else {
                //echo hi;die;
                $this->session->set_userdata('contactErrorMessage', 'There Is Some Error');
            }
        }
        $data['METATITLE'] = "Contact Us";
        $data['METAKEYWORDS'] = "Contact Us";
        $data['METADESCRIPTION'] = "Contact Us";
        $data['current_page_slug'] = "contact-us";
        $data['page_title'] = "Contact Us";
        $data['breadcrumb'] = "Contact Us";
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/contact');
        $this->load->view($this->config->item('template') . '/footer');
    }

}
