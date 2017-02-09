<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Province extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/province_model', 'province');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['province_data'] = $this->province->getProvinceList();
        $data['page_name'] = 'province';
        $data['breadcum'] = 'Manage Province';

        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/province/province_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        $province_name = $this->input->post('province_name');
        if (!empty($_POST)) {
            $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
            $this->form_validation->set_rules('province_name', 'State Name', 'trim|required');
            $this->form_validation->set_rules('gst', 'Gst', 'trim|required');
            $this->form_validation->set_rules('pst', 'Pst', 'trim|required');
            $this->form_validation->set_rules('hst', 'Hst', 'trim|required');
            if ($this->form_validation->run()) {

                $provinceData = $this->province->add($province_name);
                $this->session->set_flashdata('StateSuccess', 'Province Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/province-list');
                exit;
            } else {
                $data['country_id'] = $this->input->post('country_id');
                $data['province_name'] = $this->input->post('province_name');
                $data['gst'] = $this->input->post('gst');
                $data['pst'] = $this->input->post('pst');
                $data['hst'] = $this->input->post('hst');
            }
        }
        $data['country_list'] = $this->province->getCountryList();
        $data['page_name'] = 'province';
        $data['breadcum'] = 'Add province';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/province/province_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($provinceId) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
            $this->form_validation->set_rules('province_name', 'State Name', 'trim|required');
            $this->form_validation->set_rules('gst', 'Gst', 'trim|required');
            $this->form_validation->set_rules('pst', 'Pst', 'trim|required');
            $this->form_validation->set_rules('hst', 'Hst', 'trim|required');
            if ($this->form_validation->run()) {

                $provinceData = $this->province->update($provinceId);
                $this->session->set_flashdata('StateSuccess', 'Province Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/province-list');
                exit;
            } else {
                $data['country_id'] = $this->input->post('country_id');
                $data['province_name'] = $province_name = $this->input->post('province_name');
                $data['gst'] = $this->input->post('gst');
                $data['pst'] = $this->input->post('pst');
                $data['hst'] = $this->input->post('hst');
            }
        }
        $data['lists'] = $lists = $this->province->getProvinceListById($provinceId);
        $data['country_list'] = $country_list = $this->province->getCountryList();
        $data['province_id'] = $provinceId;
        $data['country_id'] = $lists['country_id'];
        $data['province_name'] = $lists['province_name'];
        $data['gst'] = $lists['gst'];
        $data['pst'] = $lists['pst'];
        $data['hst'] = $lists['hst'];
        $data['page_name'] = 'province';
        $data['breadcum'] = 'Edit province';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/province/province_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($provinceId, $action) {
        if ($provinceId != '') {
            $provinceData = $this->province->updateStatus($provinceId, $action);
            $this->session->set_flashdata('StateSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/province-list');
            exit;
        }
    }

    public function delete($provinceId) {
        if (isset($provinceId) && $provinceId != '') {
            $this->province->delete($provinceId);
            $this->session->set_flashdata('StateSuccess', 'State Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/province-list');
            exit;
        }
    }

    public function getStateList() {
        $country_id = $this->input->post('country_id');
        $data['province_list'] = $province_list = $this->province->getProvinceByCountry($country_id);
        $data['success'] = true;
        if (sizeof($province_list) == 0) {
            $data['success'] = false;
        }
        echo json_encode($data);
        die;
    }

}