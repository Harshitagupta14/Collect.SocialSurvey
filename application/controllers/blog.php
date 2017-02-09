<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('blog_model', 'blog');
        $this->load->model('content_model', 'post');
        $this->load->library('form_validation');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {

        $data['blog_data'] = $this->blog->getBlogData();
        $data['blogcategory_data'] = $this->blog->getBlogCategory();
        $data['METATITLE'] = "Blog";
        $data['METAKEYWORDS'] = "Blog";
        $data['METADESCRIPTION'] = "Blog";
        $data['current_page_slug'] = "blog";
        $data['page_title'] = "Blog";
        $data['breadcrumb'] = "Blog";
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/blog');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function blogcategory($categorySlug) {
        //pr($categorySlug);die;
        $data['blogcategory_data'] = $this->blog->getBlogCategory();
        $data['category_detail'] = $category_detail = $this->common_model->getSingleRowFromAnyTable('slug', $categorySlug, $this->blog->tableBlogCategory);
        $data['blog_data'] = $this->blog->getBlogList($category_detail->bg_cat_id); //pr($data);die;
        $data['page_title'] = $category_detail->bg_category_title;
        $data['breadcrumb'] = '<a href="' . site_url('blog') . '">Blog Category</a> / ' . $category_detail->bg_category_title;
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/blog');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function blogdetail($blogSlug) {
        $blog_detail = $this->common_model->getSingleRowFromAnyTable('slug', $blogSlug, 'tbl_blog');
        $blog_category_detail = $this->common_model->getSingleRowFromAnyTable('bg_cat_id', $blog_detail->category_id, $this->blog->tableBlogCategory);

        if (!empty($_POST)) {
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('comment', 'Comment', 'trim|required');

            if ($this->form_validation->run()) {
                $this->blog->addComment($blog_detail->blog_id);
                $this->session->set_flashdata('BlogSuccessMessage', 'Comment Posted Succesfully.');
                redirect('blog');
                exit;
            } else {
                $this->session->set_flashdata('BlogErrorMessage', 'Error! Comment Not Posted.');
                redirect('blog');
            }
        }
        $data['blogcategory_data'] = $this->blog->getBlogCategory();
        $data['blog_detail'] = $blog_detail = $this->common_model->getSingleRowFromAnyTable('slug', $blogSlug, $this->blog->tableBlog);
        $data['blogComments'] = $this->blog->getBlogComments($blog_detail->blog_id);
        $data['page_title'] = $blog_detail->blog_title;
        $data['breadcrumb'] = '<a href="' . site_url('blog') . '">Blog</a> ';
        $data['breadcrumb'] = '<a href="' . site_url('blog') . '">Blog Category</a> / ' . $blog_detail->blog_title;
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/blog_detail');
        $this->load->view($this->config->item('template') . '/footer');
    }

    function select_city() {
        $city = $this->input->post('city');
        $this->session->set_userdata('city', $city);
        $data['status'] = "true";
        echo json_encode($data);
        die;
    }

}
