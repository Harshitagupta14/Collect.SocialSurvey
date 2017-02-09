<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_image extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/product_image_model', 'product');
        $this->load->library('form_validation');
    }

    public function productImageSpecification($product_id) {
        if (!empty($_POST)) {
            //pr($_POST);die;
            $this->product->addProductImagesSpecifications($product_id);
            $this->session->set_flashdata('successMsg', 'Images Specifications Updataion Successfully');
            redirect($this->config->item('adminFolder') . '/product_image-list/' . $product_id);
            exit;
        } else {
            $data['product_image'] = $this->product->getProductImageListByProductId($product_id);
            $data['breadcum'] = 'Manage Product Images Specifications';
            $data['product_id'] = $product_id;
            // pr($data['product_image']);die;
            $this->load->view($this->config->item('adminFolder') . '/header', $data);
            $this->load->view($this->config->item('adminFolder') . '/product_image/product_image_list');
            $this->load->view($this->config->item('adminFolder') . '/footer');
        }
    }

    public function uploadImages($product_id) {
        if (!empty($_FILES)) {
            @mkdir("assets/uploads/product_images/", 0777, true);
            @chmod("assets/uploads/product_images/", 0777);
            $temp = true;
            $config['upload_path'] = 'assets/uploads/product_images';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ($_FILES['file']['name'] != '') {
                if (!$this->upload->do_upload('file')) {
                    $output['error'] = array('error' => $this->upload->display_errors());
                    $temp = false;
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
            }
            if ($temp) {
                $this->product->addProductImage($product_id, $data['upload_data']['file_name']);
                $data = 'done';
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        }
    }

    public function delete($product_image_id) {
        $file = $this->product->getProductImageByImageId($product_image_id);
        $product_pic = $file->image_name;
        $product_id = $file->product_id;
        if (isset($product_image_id) && $product_image_id != '') {
            unlink('assets/uploads/product_images/' . $product_pic);
            $this->product->delete($product_image_id);
            $this->session->set_flashdata('ImageSuccess', 'Image Successfully Deleted');
            redirect($this->config->item('adminFolder') . '/product_image-list/' . $product_id);
            exit;
        }
    }
}