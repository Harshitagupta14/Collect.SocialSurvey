<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_types extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/product_types_model', 'product_types');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['product_types_data'] = $this->product_types->getProductTypesList();
        //pr($data);die;
        $data['page_name'] = 'product_types';
        $data['breadcum'] = 'Manage Product Types';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_types/product_types_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        // pr($_POST);die;
        $prd_name = $this->input->post('prd_type_name');
        if (!empty($_POST)) {
            // pr($data);die;
            $this->form_validation->set_rules('prd_type_name', 'Product type name', 'trim|required');

            if ($this->form_validation->run()) {

                $this->product_types->add($prd_name);
                $this->session->set_flashdata('ProductTypesSuccess', 'Product Types Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/product_types-list');
                exit;
            } else {
                $data['prd_type_name'] = $this->input->post('prd_type_name');
            }
        }
        $data['page_name'] = 'product_types';
        $data['breadcum'] = 'Add Product types';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_types/product_types_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($product_types_Id) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('prd_type_name', 'Product type name', 'trim|required');

            if ($this->form_validation->run()) {
                $product_typesData = $this->product_types->update($product_types_Id);
                $this->session->set_flashdata('ProductTypesSuccess', 'Product types Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/product_types-list');
                exit;
            } else {
                $data['prd_type_name'] = $this->input->post('prd_type_name');
            }
        }
        $lists = $this->product_types->getProductTypesListById($product_types_Id);

        $data['prd_type_name'] = $lists['prd_type_name'];
        $data['page_name'] = 'product_types';
        $data['breadcum'] = 'Edit Product Types';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_types/product_types_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($product_types_Id, $status) {
        if ($product_types_Id != '') {
            $this->product_types->updateStatus($product_types_Id, $status);
            $this->session->set_flashdata('ProductTypesSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/product_types-list');
            exit;
        }
    }

    public function delete($product_types_Id) {
        if (isset($product_types_Id) && $product_types_Id != '') {
            $this->product_types->delete($product_types_Id);
            $this->session->set_flashdata('ProductTypesSuccess', 'Product Types Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/product_types-list');
            exit;
        }
    }

}
