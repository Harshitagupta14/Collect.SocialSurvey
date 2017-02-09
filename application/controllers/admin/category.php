<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/category_model', 'category');
        $this->load->library('form_validation');
    }

    public function index($categoryId = FALSE) {
        $data['category_data'] = $this->category->getCategoryList($categoryId);
        $data['page_name'] = 'ProductCategory';
        $data['breadcum'] = 'Manage Category';
        $data['breadcum_sub'] = 'Manage Sub-Category';
        $data['parentId'] = $categoryId;

        if ($categoryId != '0') {
            $cat_row = $this->category->getCategoryById($categoryId);
            $data['category_name'] = $cat_row['category_name'];
            $data['cat_id'] = $catId = $cat_row['category_id'];
            $data['parent_id'] = $prntId = $cat_row['parent_id'];

            $cat_row1 = $this->category->getCategoryById($prntId);
            $data['cat_name'] = $cat_row1['category_name'];
        }

        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/category/category_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add($categoryId = FALSE) {

        $category_name = $this->input->post('category_name');
        if (!empty($_POST)) {
            $this->form_validation->set_rules('category_name', 'Category Title', 'trim|required');
            $this->form_validation->set_rules('category_description', 'Category Description', 'trim|required');
            // $this->form_validation->set_rules('parent_id','Parent Id','trim|required');
            if ($_FILES["category_image"]['name'] == '')
                $this->form_validation->set_rules('category_image', 'Category Image', 'trim|required');

            if ($this->form_validation->run()) {
                if ($_FILES["category_image"]['name']) {
                    $config['upload_path'] = './assets/uploads/category_images';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('category_image')) {
                        $error_msg = $this->upload->display_errors();
                    } else {
                        $detail = array('upload_data' => $this->upload->data());
                    }
                }
                $Data = $this->category->add($categoryId, $category_name, $detail['upload_data']['file_name']);
                $this->session->set_flashdata('ProductCategorySuccess', 'Product Category Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/category-list/' . $categoryId);
                exit;
            } else {
                $data['category_name'] = $this->input->post('category_name');
                $data['category_description'] = $this->input->post('category_description');
                $data['category_image'] = $this->input->post('category_image');
            }
        }
        $data['page_name'] = 'ProductCategory';
        $data['breadcum'] = 'Add Category';
        $data['breadcum_sub'] = 'Add Sub-Category';
        $data['catId'] = $categoryId;
        $data['parent_category'] = $this->category->getCategoryList($categoryId);
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/category/category_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($categoryId = FALSE) {
        $data['parent_category'] = $this->category->getCategoryList();
        $result = $this->category->getCategoryById($categoryId);
        $data['prnt_id'] = $parentId = $result['parent_id'];

        if ($parentId != '0')
            $cat_row = $this->category->getCategoryById($parentId);
        //pr($cat_row);die;
        $data['category_name'] = $cat_row['category_name'];
        $data['cat_parent'] = $catParent = $cat_row['parent_id'];

        if ($catParent != '0')
            $cat_row1 = $this->category->getCategoryById($catParent);
        $data['category_name'] = $cat_row1['category_name'];

        $data['category_id'] = $categoryId;
        $data['category_name'] = $result['category_name'];
        $data['category_image'] = $result['category_image'];
        $data['category_description'] = $result['category_description'];
        $data['page_name'] = 'ProductCategory';
        $data['breadcum_edit'] = 'Edit Category';
        $data['breadcum_edit_sub'] = 'Edit Sub-Category';

        if (!empty($_POST)) {
            $data['category_name'] = $category_name = $this->input->post('category_name');
            $data['category_description'] = $this->input->post('category_description');

            $this->form_validation->set_rules('category_name', 'Category Title', 'trim|required');
            $this->form_validation->set_rules('category_description', 'Category Description', 'trim|required');

            if ($this->form_validation->run()) {

                if ($this->form_validation->run()) {
                    if ($_FILES["category_image"]['name']) {
                        $config['upload_path'] = './assets/uploads/category_images';
                        $config['allowed_types'] = 'jpg|png|jpeg|gif';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('category_image')) {
                            $error_msg = $this->upload->display_errors();
                        } else {
                            $detail = array('upload_data' => $this->upload->data());
                        }
                    }
                    $Data = $this->category->update($categoryId, $detail['upload_data']['file_name']);
                    $this->session->set_flashdata('ProductCategorySuccess', 'Product Category Has Been Updated Successfully');
                    redirect($this->config->item('adminFolder') . '/category-list/' . $parentId);
                    exit;
                }
            }
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/category/category_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($categoryId, $status) {
        if ($categoryId != '') {
            $lists = $this->category->getCategoryById($categoryId);
            $parentId = $lists['parent_id'];
            $Data = $this->category->updateStatus($categoryId, $status);
            $this->session->set_flashdata('ProductCategorySuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/category-list/' . $parentId);
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/category/category_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($categoryId) {
        if (isset($categoryId) && $categoryId != '') {
            $file = $this->category->getCategoryById($categoryId);
            $product_pic = $file['category_image'];
            $parentId = $file['parent_id'];
            unlink('assets/uploads/category_images/' . $product_pic);
            $this->category->delete($categoryId);
            $this->session->set_flashdata('ProductCategorySuccess', 'Product Category Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/category-list/' . $parentId);
            exit;
        }
    }

}
