<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smtp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        $this->flexi_auth->is_admin();
        $this->load->model($this->config->item('adminFolder') . '/smtp_model', 'smtp');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['smtp_data'] = $this->smtp->getSmtpList();
        $data['page_name'] = 'smtpData';
        $data['breadcum'] = 'Manage Smtp';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/smtp/smtp_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('smtp_user', 'User Name', 'trim|required|is_unique[tbl_smtp_settings.smtp_user]');
            $this->form_validation->set_rules('smtp_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('smtp_host', 'host', 'trim|required');
            $this->form_validation->set_rules('smtp_port', 'Port', 'trim|required');

            if ($this->form_validation->run()) {

                $Data = $this->smtp->add();
                $this->session->set_flashdata('SmtpSuccess', 'Smtp Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/smtp-list');
                exit;
            } else {
                $data['smtp_user'] = $this->input->post('smtp_user');
                $data['smtp_password'] = $this->input->post('smtp_password');
                $data['smtp_host'] = $this->input->post('smtp_host');
                $data['smtp_port'] = $this->input->post('smtp_port');
            }
        }

        $data['page_name'] = 'smtp';
        $data['breadcum'] = 'Add Smtp';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/smtp/smtp_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($smtpId) {

        $lists = $this->smtp->getSmtpListById($smtpId);
        $data['smtp_id'] = $smtpId;
        $data['smtp_user'] = $lists['smtp_user'];
        $data['smtp_host'] = $lists['smtp_host'];
        $data['smtp_port'] = $lists['smtp_port'];
        //$data['password'] = $lists['admin_password']; 

        if (!empty($_POST)) {
            $this->form_validation->set_rules('smtp_user', 'User Name', 'trim|required');
            $this->form_validation->set_rules('smtp_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('smtp_host', 'host', 'trim|required');
            $this->form_validation->set_rules('smtp_port', 'Port', 'trim|required');

            if ($this->form_validation->run()) {

                $Data = $this->smtp->update($smtpId);
                $this->session->set_flashdata('SmtpSuccess', 'Smtp Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/smtp-list');
                exit;
            } else {
                $data['smtp_user'] = $this->input->post('smtp_user');
                $data['smtp_password'] = $this->input->post('smtp_password');
                $data['smtp_host'] = $this->input->post('smtp_host');
                $data['smtp_port'] = $this->input->post('smtp_port');
            }
        }
        $data['page_name'] = 'smtp';
        $data['breadcum'] = 'Edit Smtp';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/smtp/smtp_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($smtpId, $status) {
        if ($smtpId != '') {
            $this->smtp->updateStatus($smtpId, $status);
            $this->session->set_flashdata('SmtpSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/smtp-list');
            exit;
        }

        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/smtp/smtp_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($smtpId) {
        if (isset($smtpId) && $smtpId != '') {
            $this->smtp->delete($smtpId);
            $this->session->set_flashdata('SmtpSuccess', 'Admin Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/smtp-list');
            exit;

            $this->session->set_flashdata('SmtpError', 'You can not delete this admin record!');
            redirect($this->config->item('adminFolder') . '/smtp-list');
            exit;
        }
    }

}
