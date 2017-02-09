<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/blog_model', 'blog');
        $this->load->library('form_validation');
    }

    public function index() {
        // pr($data);die;
        $data['blog_data'] = $this->blog->getBlogList();
        $data['page_name'] = 'blog';
        $data['breadcum'] = 'Manage Blogs';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('blog_title', 'Blog Title', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Blog Category', 'trim|required');
            $this->form_validation->set_rules('blog_description', 'Blog Description', 'trim|required');
            $this->form_validation->set_rules('show_image', 'Show Image', 'trim|required');
//            if($_FILES["blog_image"]['name']=='')
//            $this->form_validation->set_rules('blog_image', 'Blog Image', 'trim|required');

            if ($this->form_validation->run()) {

                if ($_FILES["blog_image"]['name']) {
                    $config['upload_path'] = './assets/uploads/blog_images';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('blog_image')) {
                        $error_msg = $this->upload->display_errors();
                    } else {
                        $detail = array('upload_data' => $this->upload->data());
                    }
                }
                $Data = $this->blog->add($this->input->post('blog_title'), $detail['upload_data']['file_name']);
                $this->session->set_flashdata('BlogSuccess', 'Blog Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/blog-list');
                exit;
            } else {
                $data['blog_title'] = $this->input->post('blog_title');
                $data['category_id'] = $this->input->post('category_id');
                $data['blog_description'] = $this->input->post('blog_description');
                $data['blog_image'] = $this->input->post('blog_image');
                $data['show_image'] = $this->input->post('show_image');
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keywords'] = $this->input->post('meta_keywords');
                $data['meta_description'] = $this->input->post('meta_description');
            }
        }
        $data['blog_category'] = $this->blog->getBlogCategoryList();
        $data['page_name'] = 'blog';
        $data['breadcum'] = 'Add Blog';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($blogId) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('blog_title', 'Blog Title', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Blog Category', 'trim|required');
            $this->form_validation->set_rules('blog_description', 'Blog Description', 'trim|required');
            $this->form_validation->set_rules('show_image', 'Show Image', 'trim|required');
            if ($this->form_validation->run()) {
                if ($_FILES["blog_image"]['name']) {
                    $config['upload_path'] = './assets/uploads/blog_images';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('blog_image')) {
                        $error_msg = $this->upload->display_errors();
                    } else {
                        $detail = array('upload_data' => $this->upload->data());
                    }
                }
                $Data = $this->blog->update($blogId, $detail['upload_data']['file_name']);
                $this->session->set_flashdata('BlogSuccess', 'Blog Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/blog-list');
                exit;
            } else {
                $data['blog_title'] = $blog_title = $this->input->post('blog_title');
                $data['category_id'] = $this->input->post('category_id');
                $data['blog_description'] = $this->input->post('blog_description');
                $data['blog_image'] = $this->input->post('blog_image');
                $data['show_image'] = $this->input->post('show_image');
                $data['meta_title'] = $this->input->post('meta_title');
                $data['meta_keywords'] = $this->input->post('meta_keywords');
                $data['meta_description'] = $this->input->post('meta_description');
            }
        }
        $data['blog_category'] = $this->blog->getBlogCategoryList();
        $result = $this->blog->getBlogListById($blogId);

        $data['blog_id'] = $blogId;
        $data['blog_title'] = $result['blog_title'];
        $data['category_id'] = $result['category_id'];
        $data['blog_description'] = $result['blog_description'];
        $data['blog_image'] = $result['blog_image'];
        $data['show_image'] = $result['show_image'];
        $data['meta_title'] = $result['meta_title'];
        $data['meta_keywords'] = $result['meta_keywords'];
        $data['meta_description'] = $result['meta_description'];
        $data['page_name'] = 'blog';
        $data['breadcum_edit'] = 'Edit Blog';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($blogId, $status) {
        if ($blogId != '') {
            $Data = $this->blog->updateStatus($blogId, $status);
            $this->session->set_flashdata('BlogSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/blog-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($blogId) {
        if (isset($blogId) && $blogId != '') {
            $this->blog->delete($blogId);
            $this->session->set_flashdata('BlogSuccess', 'Blog Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/blog-list');
            exit;
        }
    }

}
