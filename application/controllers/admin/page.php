<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/page_model', 'page');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['page_data'] = $this->page->getPageList();
        //  pr($data);die;
        $data['page_name'] = 'page';
        $data['breadcum'] = 'Manage Page';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/page/page_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {

            $this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
            $this->form_validation->set_rules('page_heading', 'Page Heading', 'trim|required');
            $this->form_validation->set_rules('page_content', 'Page Content', 'trim|required');

            if ($this->form_validation->run()) {
                $pageData = $this->page->add($this->input->post('page_title'), $detail['upload_data']['file_name']);
                $this->session->set_flashdata('pageSuccess', 'Page Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/page-list');
                exit;
            } else {
                $data['page_title'] = $this->input->post('page_title');
                $data['page_heading'] = $this->input->post('page_heading');
                $data['page_content'] = $this->input->post('page_content');
            }
        }
        $data['page_name'] = 'page';
        $data['breadcum'] = 'Add Page';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/page/page_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($pageId) {

        if (!empty($_POST)) {

            $this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
            $this->form_validation->set_rules('page_heading', 'Page Heading', 'trim|required');
            $this->form_validation->set_rules('page_content', 'Page Content', 'trim|required');
            if ($this->form_validation->run()) {

                $pageData = $this->page->update($pageId);
                $this->session->set_flashdata('pageSuccess', 'Page Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/page-list');
                exit;
            } else {
                $data['page_title'] = $this->input->post('page_title');
                $data['page_heading'] = $this->input->post('page_heading');
                $data['page_content'] = $this->input->post('page_content');
            }
        }
        $lists = $this->page->getPageListById($pageId);
        $data['page_id'] = $lists['page_id'];
        $data['page_title'] = $lists['page_title'];
        $data['page_heading'] = $lists['page_heading'];
        $data['page_content'] = $lists['page_content'];
        $data['page_name'] = 'page';
        $data['breadcum_edit'] = 'Edit Page';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/page/page_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($pageId, $status) {
        if ($pageId != '') {
            $pageData = $this->page->updateStatus($pageId, $status);
            $this->session->set_flashdata('pageSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/page-list');
            exit;
        }
    }

    public function delete($pageId) {
        if (isset($pageId) && $pageId != '') {
            $this->page->delete($pageId);
            $this->session->set_flashdata('pageSuccess', 'Page Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/page-list');
            exit;
        }
    }

}