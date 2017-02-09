<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/product_model', 'product');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['product_data'] = $this->product->getProductList();
        $data['page_name'] = 'product';
        $data['breadcum'] = 'Manage Product';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product/product_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('product_title', 'Product Title', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Product Category', 'trim|required');
            $this->form_validation->set_rules('city_id', 'Location', 'trim|required');
            //$this->form_validation->set_rules('prd_type_id', 'Product Type', 'trim|required');
            // $this->form_validation->set_rules('product_color', 'Product Color', 'trim|required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');
            $this->form_validation->set_rules('product_upc_code', 'Product UPC Code', 'trim|required');
            $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
            $this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
            if ($this->form_validation->run()) {
                $productData = $this->product->add($this->input->post('product_title'));
                $this->session->set_flashdata('ProductSuccess', 'Product Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/product-list');
                exit;
            } else {
                $data['product_title'] = $this->input->post('product_title');
                $data['category_id'] = $this->input->post('category_id');
                $data['city_id'] = $this->input->post('city_id');
                $data['prd_type_id'] = $this->input->post('prd_type_id');
                $data['product_size'] = $this->input->post('product_size');
                $data['group_number'] = $this->input->post('group_number');
                $data['product_color'] = $this->input->post('product_color');
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['meta_description'] = $this->input->post('meta_description');
                $data['product_mrp'] = $this->input->post('product_mrp');
                $data['product_discount'] = $this->input->post('product_discount');
                $data['product_price'] = $this->input->post('product_price');
                $data['product_upc_code'] = $this->input->post('product_upc_code');
                $data['is_new'] = $this->input->post('is_new');
                $data['product_code'] = $this->input->post('product_code');
                $data['product_description'] = $this->input->post('product_description');
                $data['product_specifications'] = $this->input->post('product_specifications');
                $data['product_small_description'] = $this->input->post('product_small_description');
                $data['product_image'] = $this->input->post('product_image');
            }
        }
        $data['category_list'] = $this->product->getCategoryList();
        $data['product_type'] = $this->product->getProductTypesList();
        $data['page_name'] = 'Product';
        $data['breadcum'] = 'Add Product ';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product/product_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($product_Id) {
        $lists = $this->product->getProductListById($product_Id);
        $product_id = $lists['product_id'];
        if (!empty($_POST)) {
            $this->form_validation->set_rules('product_title', 'Product Title', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Product Category', 'trim|required');
            $this->form_validation->set_rules('city_id', 'Location', 'trim|required');
            //$this->form_validation->set_rules('prd_type_id', 'Product Type', 'trim|required');
            //$this->form_validation->set_rules('product_color', 'Product Color', 'trim|required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'trim|required');
            $this->form_validation->set_rules('product_upc_code', 'Product UPC Code', 'trim|required');
            $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
            $this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
            if ($this->form_validation->run()) {
                $productData = $this->product->update($product_id);
                $this->session->set_flashdata('ProductSuccess', 'Product Updated Successfully');
                redirect($this->config->item('adminFolder') . '/product-list');
                exit;
            } else {
                $data['product_title'] = $this->input->post('product_title');
                $data['category_id'] = $this->input->post('category_id');
                $data['city_id'] = $this->input->post('city_id');
                $data['sub_cat_id'] = $this->input->post('category_id');
                $data['prd_type_id'] = $this->input->post('prd_type_id');
                $data['product_size'] = $this->input->post('product_size');
                $data['group_number'] = $this->input->post('group_number');
                $data['product_color'] = $this->input->post('product_color');
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keyword'] = $this->input->post('meta_keyword');
                $data['meta_description'] = $this->input->post('meta_description');
                $data['product_price'] = $this->input->post('product_price');
                $data['product_mrp'] = $this->input->post('product_mrp');
                $data['product_discount'] = $this->input->post('product_discount');
                $data['is_new'] = $this->input->post('is_new');
                $data['product_upc_code'] = $this->input->post('product_upc_code');
                $data['product_code'] = $this->input->post('product_code');
                $data['product_description'] = $this->input->post('product_description');
                $data['product_small_description'] = $this->input->post('product_small_description');
                $data['product_specifications'] = $this->input->post('product_specifications');
                $data['product_image'] = $this->input->post('product_image');
            }
        }
        $data['product_id'] = $lists['product_id'];
        $data['product_title'] = $lists['product_title'];
        $data['city_id'] = $lists['city_id'];
        $data['category_id'] = $lists['category_id'];
        $data['sub_cat_id'] = $lists['category_id'];
        $data['prd_type_id'] = $lists['prd_type_id'];
        $data['group_number'] = $lists['group_number'];
        $data['product_color'] = $lists['product_color'];
        $data['meta_title'] = $lists['meta_title'];
        $data['meta_keyword'] = $lists['meta_keyword'];
        $data['meta_description'] = $lists['meta_description'];
        $data['product_price'] = $lists['product_price'];
        $data['product_mrp'] = $lists['product_mrp'];
        $data['is_new'] = $lists['is_new'];
        $data['product_discount'] = $lists['product_discount'];
        $data['product_upc_code'] = $lists['product_upc_code'];
        $data['product_code'] = $lists['product_code'];
        $data['product_description'] = $lists['product_description'];
        $data['product_small_description'] = $lists['product_small_description'];
        $data['product_image'] = $lists['product_image'];
        $data['category_list'] = $this->product->getCategoryList();
        $data['product_type'] = $this->product->getProductTypesList();
        $data['page_name'] = 'product';
        $data['breadcum'] = 'Edit Product types';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product/product_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($product_Id, $status) {
        if ($product_Id != '') {
            $this->product->updateStatus($product_Id, $status);
            $this->session->set_flashdata('ProductSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/product-list');
            exit;
        }
    }

    public function delete($product_Id) {
        $file = $this->product->getProductListById($product_Id);
        $product_pic = $file['product_image'];
        if (isset($product_Id) && $product_Id != '') {
            unlink('assets/uploads/product_images/' . $product_pic);
            $this->product->delete($product_Id);
            $this->session->set_flashdata('ProductSuccess', 'Product Successfully Deleted');
            redirect($this->config->item('adminFolder') . '/product-list');
            exit;
        }
    }

    public function getSubCategory() {
        $category_id = $this->input->post('category_id');
        $data['sub_category_list'] = $sub_category_list = $this->product->getSubCategoryByCategory($category_id);
        $data['success'] = true;
        if (sizeof($sub_category_list) == 0) {
            $data['success'] = false;
        }
        echo json_encode($data);
        die;
    }

    public function product_review($product_id) {
        $data['product_review_data'] = $this->product->getProductReviewByProductId($product_id);
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product/product_review/' . $product_id);
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function view($product_id) {
        $readData = $this->enquiry->updateReadStatus($product_id, 'read');
        $data['view_data'] = $this->enquiry->getProductReviewByProductId($product_id);
        $data['page_name'] = 'Product Review';
        $data['breadcum'] = 'View Product Review';
        $this->load->view($this->config->item('adminFolder') . '/product/product_review_view', $data);
    }

}
