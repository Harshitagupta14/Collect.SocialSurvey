<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metatag extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/metatag_model', 'metatag');

        $this->load->library('form_validation');
    }

    public function index() {
        $data['metatag_data'] = $this->metatag->getMetatagList();
        //  pr($data);die;
        $data['page_name'] = 'metatag';
        $data['breadcum'] = 'Manage Metatag';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/metatag/metatag_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {

            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
            $this->form_validation->set_rules('url', 'Url', 'trim|required');
            if ($this->form_validation->run()) {
                $metatagData = $this->metatag->add();
                $this->session->set_flashdata('MetatagSuccess', 'Metatag Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/metatag-list');
                exit;
            } else {
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['meta_description'] = $this->input->post('meta_description');
                $data['url'] = $this->input->post('url');
            }
        }
        $data['page_name'] = 'metatag';
        $data['breadcum'] = 'Add Metatag';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/metatag/metatag_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($metatagId) {

        if (!empty($_POST)) {
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');

            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
            $this->form_validation->set_rules('url', 'Url', 'trim|required');
            if ($this->form_validation->run()) {

                $metatagData = $this->metatag->update($metatagId);
                $this->session->set_flashdata('MetatagSuccess', 'Metatag Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/metatag-list');
                exit;
            } else {
                $data['meta_title'] = $this->input->post('meta_title');

                $data['meta_description'] = $this->input->post('meta_description');
                $data['url'] = $this->input->post('url');
            }
        }
        $lists = $this->metatag->getMetatagListById($metatagId);
        $data['meta_id'] = $lists['meta_id'];
        $data['meta_title'] = $lists['metatag_title'];
        $data['meta_keyword'] = $lists['metatag_keyword'];
        $data['meta_description'] = $lists['metatag_description'];
        $data['url'] = $lists['metatag_url'];
        $data['page_name'] = 'metatag';
        $data['breadcum_edit'] = 'Edit Metatag';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/metatag/metatag_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($metatagId, $status) {
        if ($metatagId != '') {
            $metatagData = $this->metatag->updateStatus($metatagId, $status);
            $this->session->set_flashdata('MetatagSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/metatag-list');
            exit;
        }
    }

    public function delete($metatagId) {

        if (isset($metatagId) && $metatagId != '') {

            $this->metatag->delete($metatagId);
            $this->session->set_flashdata('MetatagSuccess', 'Metatag Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/metatag-list');
            exit;
        }
    }

}
