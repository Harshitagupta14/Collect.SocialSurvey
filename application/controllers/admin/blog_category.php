<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_Category extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/blog_category_model', 'category');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['category_data'] = $this->category->getBlogCategoryList();
        $data['page_name'] = 'BlogCategory';
        $data['breadcum'] = 'Manage Blog Category';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_category_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('bg_category_title', 'Blog Category', 'trim|required');
            $this->form_validation->set_rules('bg_category_description', 'Blog Category Description', 'trim|required');

            if ($this->form_validation->run()) {
                $categoryData = $this->category->add($this->input->post('bg_category_title'));
                $this->session->set_flashdata('BlogCategorySuccess', 'Blog Category Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/blog-category-list');
                exit;
            } else {
                $data['bg_category_title'] = $this->input->post('bg_category_title');
                $data['bg_category_description'] = $this->input->post('bg_category_description');
                $data['bg_meta_title'] = $this->input->post('bg_meta_title');
                $data['bg_meta_keywords'] = $this->input->post('bg_meta_keywords');
                $data['bg_meta_description'] = $this->input->post('bg_meta_description');
            }
        }
        $data['page_name'] = 'BlogCategory';
        $data['breadcum'] = 'Add Blog Category';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_category_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($catId) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('bg_category_title', 'Blog Category', 'trim|required');
            $this->form_validation->set_rules('bg_category_description', 'Blog Category Description', 'trim|required');
            if ($this->form_validation->run()) {
                $Data = $this->category->update($catId, $detail['upload_data']['file_name']);
                $this->session->set_flashdata('BlogCategorySuccess', 'Blog Category Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/blog-category-list');
                exit;
            } else {
                $data['bg_category_title'] = $item_cat_name = $this->input->post('bg_category_title');
                $data['bg_category_description'] = $this->input->post('bg_category_description');
                $data['bg_meta_title'] = $this->input->post('bg_meta_title');
                $data['bg_meta_keywords'] = $this->input->post('bg_meta_keywords');
                $data['bg_meta_description'] = $this->input->post('bg_meta_description');
            }
        }
        $lists = $this->category->getBlogCategoryById($catId);

        $data['cat_id'] = $catId;
        $data['page_name'] = 'BlogCategory';
        $data['breadcum_edit'] = 'Edit Blog Category';
        $data['bg_category_title'] = $lists['bg_category_title'];
        $data['bg_category_description'] = $lists['bg_category_description'];
        $data['bg_meta_title'] = $lists['bg_meta_title'];
        $data['bg_meta_keywords'] = $lists['bg_meta_keywords'];
        $data['bg_meta_description'] = $lists['bg_meta_description'];

        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_category_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($catId, $status) {
        if ($catId != '') {
            $categoryData = $this->category->updateStatus($catId, $status);
            $this->session->set_flashdata('BlogCategorySuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/blog-category-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_category_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($catId) {
        if (isset($catId) && $catId != '') {
            $this->category->delete($catId);
            $this->session->set_flashdata('BlogCategorySuccess', 'Blog Category Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/blog-category-list');
            exit;
        }
    }

}
