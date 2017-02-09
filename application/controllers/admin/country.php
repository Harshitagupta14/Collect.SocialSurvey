<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/country_model', 'country');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['country_data'] = $this->country->getCountryList();
        $data['page_name'] = 'Countries';
        $data['breadcum'] = 'Manage Country';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/country/country_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required');
            if ($this->form_validation->run()) {
                $countryData = $this->country->add();
                $this->session->set_flashdata('CountrySuccess', 'Country Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/country-list');
                exit;
            } else {
                $data['country_name'] = $this->input->post('country_name');
            }
        }
        $data['page_name'] = 'Countries';
        $data['breadcum'] = 'Add Country';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/country/country_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($countryId) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required');
            if ($this->form_validation->run()) {
                $countryData = $this->country->update($countryId);
                $this->session->set_flashdata('CountrySuccess', 'Country Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/country-list');
                exit;
            } else {
                $data['country_name'] = $this->input->post('country_name');
            }
        }
        $lists = $this->country->getCountryListById($countryId);

        $data['country_id'] = $countryId;
        $data['country_name'] = $lists['country_name'];
        $data['page_name'] = 'Countries';
        $data['breadcum'] = 'Add Country';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/country/country_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($countryId, $status) {
        if ($countryId != '') {
            $countryData = $this->country->updateStatus($countryId, $status);
            $this->session->set_flashdata('CountrySuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/country-list');
            exit;
        }
    }

    public function delete($countryId) {

        if (isset($countryId) && $countryId != '') {

            $this->country->delete($countryId);
            $this->session->set_flashdata('CountrySuccess', 'Country Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/country-list');
            exit;
        }
    }

}
