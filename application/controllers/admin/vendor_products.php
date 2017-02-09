<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_Products extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/product_model', 'product');
        $this->load->model($this->config->item('adminFolder') . '/vendor_product_model', 'vendor_products');
        $this->load->library('form_validation');
    }

    public function add_vendor_product($user_id) {
        $data['product_data'] = $this->vendor_products->getProductList();
        $data['user_id'] = $user_id;
        $data['page_name'] = 'All Products';
        $data['breadcum'] = 'Add Vndor Products';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_vendor/product_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function manage_vendor_product($user_id) {
        $data['product_data'] = $this->vendor_products->getVendorProductListByVendorId($user_id);
        $data['user_id'] = $user_id;
        $data['page_name'] = 'All Products';
        $data['breadcum'] = 'Add Vndor Products';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_vendor/vendor_product_list');
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

    public function edit_vendor_product($id) {
        $lists = $this->vendor_products->getVendorProductById($id);
        $data['product_vendor_quantity'] = $lists['product_vendor_quantity'];

        if (!empty($_POST)) {
            $this->form_validation->set_rules('product_quantity', 'product_quantity ', 'trim|required');
            $product_quantity_main = $this->common_model->getSingleFieldFromAnyTable('product_quantity', 'product_id', $lists['prd_id_fk'], 'tbl_products');

            if ($this->input->post('product_quantity') > $product_quantity_main) {
                $this->session->set_flashdata('ProductError', 'Quantity Cannot Excced then main.');
                redirect($this->config->item('adminFolder') . '/edit-vendor-product/' . $id);
                exit();
            }
            if ($this->form_validation->run()) {

                $data = array(
                    'id' => $lists['id'],
                    'prd_id_fk' => $lists['prd_id_fk'],
                    'product_quantity' => $this->input->post('product_quantity'),
                );
                $this->vendor_products->updateMainProductQuantity($data);
                $this->vendor_products->editVendorProduct($data);
                $this->session->set_flashdata('ProductSuccess', 'Vendor Product Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/manage-vendor-products-list/' . $lists['user_id']);
                exit;
            }
        }
        $data['page_name'] = 'admin';
        $data['breadcum'] = 'Edit Admin';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_vendor/product_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($id, $status) {
        //$data = $this->admin->countAllAdmin();
        if ($id != '' && $status != '') {
            $adminData = $this->user->updateStatus($id, $status);
            $this->session->set_flashdata(' CustomerSuccess ', ' Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . ' / customer-list');
            exit;
        } else {
            $this->session->set_flashdata('CustomerError ', 'You can not change status of this record');
            redirect($this->config->item('adminFolder') . ' / customer-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . ' /header ', $data);
        $this->load->view($this->config->item('adminFolder') . ' /admin/admin_list');
        $this->load->view($this->config->item('adminFolder') . ' /footer

        ');
    }

    public function delete_vendor_product($id) {
        $lists = $this->vendor_products->getVendorProductById($id);
        if ($id != '') {
            $data = array(
                'user_id' => $lists['user_id'],
                'prd_id_fk' => $lists['prd_id_fk'],
                'product_quantity' => 0,
            );
            $this->vendor_products->updateMainProductQuantity($data);
            $this->vendor_products->deleteVendorProduct($id);
            $this->session->set_flashdata('ProductSuccess', ' Product Has Been Deleted Successfully.');
            redirect($this->config->item('adminFolder') . '/manage-vendor-products-list/' . $lists['user_id']);
            exit;
        } else {
            $this->session->set_flashdata('ProductError ', 'You can not delete this product.');
            redirect($this->config->item('adminFolder') . '/manage-vendor-products-list/' . $lists['user_id']);
            exit;
        }
    }

    public function addVendorProduct() {
        if (!empty($_POST)) {
            //$this->form_validation->set_rules('product_id ', 'Product Id ', 'trim|required');
            $this->form_validation->set_rules('product_quantity', 'Product Quantity ', 'trim|required');
            if ($this->form_validation->run()) {
                $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'prd_id_fk' => $this->input->post('product_id'),
                    'product_quantity' => $this->input->post('product_quantity'),
                );

                $this->vendor_products->addVendorProduct($data);
                $this->vendor_products->updateMainProductQuantity($data);
            }
        }
    }

}
