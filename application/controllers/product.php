<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->library('form_validation');
        $this->load->model('content_model', 'post');
        $this->load->model('product_model', 'product');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {
        $data['product_data'] = $this->product->getProductrRecordBy();
        // $data['current_page_slug'] = 'categories';
        $this->load->view($this->config->item('template') . '/header');
        $this->load->view($this->config->item('template') . '/category');
        $this->load->view($this->config->item('template') . '/product');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function productSearch() {
        $data['product_data'] = $this->product->getProductByArguments(FALSE,FALSE,$searchKeyword,FALSE,FALSE);
        $this->load->view($this->config->item('template') . '/header');
        $this->load->view($this->config->item('template') . '/category');
        $this->load->view($this->config->item('template') . '/product');
        $this->load->view($this->config->item('template') . '/footer');
    }
    
    public function addCompareItem(){
        $compare_products=$this->session->userdata('compare_products');
        pr($compare_products);
        $count_of_products=count($compare_products);
        if ($count_of_products<2) {
            // $this->form_validation->set_rules('product_id', 'Product Id', 'trim|required');
          $compare_products[]=$this->input->post('product_id');
          $this->session->set_userdata('compare_products', $compare_products);
          echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
//          $this->load->view($this->config->item('template') . '/header');
//          $this->load->view($this->config->item('template') . '/compare');
//          $this->load->view($this->config->item('template') . '/footer');
    }

}

