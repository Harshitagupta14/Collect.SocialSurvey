<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_Review extends CI_Controller {

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

    public function index($product_id) {
        $data['product_review_data'] = $this->product->getProductReviewByProductId($product_id);
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/product_reviews/product_review');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function view($review_id) {
        $readData = $this->product->updateReadStatus($review_id, 'read');
        //$product_id = $this->getProductReviewbyCustId($custId);
        $data['view_data'] = $this->product->getProductReviewByReviewId($review_id);
        $data['page_name'] = 'Product Review';
        $data['breadcum'] = 'View Product Review';
        $this->load->view($this->config->item('adminFolder') . '/product_reviews/product_review_view', $data);
    }

    public function approve($review_id, $status) {
        $product_Id = $this->common_model->getSingleFieldFromAnyTable('product_id', 'review_id', $review_id, 'tbl_product_reviews');
        if ($review_id != '') {
            $this->product->updateStatus_Review($review_id, $status);
            $this->session->set_flashdata('ProductReviewSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/product_review-list/' . $product_Id);
            exit;
        }
    }

    public function delete($review_id) {
        $product_Id = $this->common_model->getSingleFieldFromAnyTable('product_id', 'review_id', $review_id, 'tbl_product_reviews');
        if (isset($review_id) && $review_id != '') {
            $this->product->delete_Review($review_id);
            $this->session->set_flashdata('ProductReviewSuccess', 'Product Review Successfully Deleted');
            redirect($this->config->item('adminFolder') . '/product_review-list/' . $product_Id);
            exit;
        }
    }

}