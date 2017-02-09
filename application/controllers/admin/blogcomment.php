<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogcomment extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/blog_comment_model', 'comment');
        $this->load->library('form_validation');
    }

    public function index($blogId) {
        $data['comment_data'] = $this->comment->getBlogCommentList($blogId);
        $data['page_name'] = 'BlogComment';
        $data['breadcum'] = 'Manage Blog Comment';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_comment_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($commentId, $status) {
        $blog_id = $this->common_model->getSingleFieldFromAnyTable('blog_id', 'bg_comment_id', $commentId, 'tbl_blog_comment');
        if ($commentId != '') {
            $commentData = $this->comment->updateStatus($commentId, $status);
            $this->session->set_flashdata('BlogSuccess', 'BloggerComment Status Has Been Changed Successfully');
            redirect($this->config->item('adminFolder') . '/blog-comment/' . $blog_id);
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/blog/blog_comment_list/' . $blog_id);
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($commentId) {
        $blog_id = $this->common_model->getSingleFieldFromAnyTable('blog_id', 'bg_comment_id', $commentId, 'tbl_blog_comment');
        if (isset($commentId) && $commentId != '') {
            $this->comment->delete($commentId);
            $this->session->set_flashdata('BlogSuccess', 'BloggerComment Has Been Removed Successfully');
            redirect($this->config->item('adminFolder') . '/blog-comment/' . $blog_id);
            exit;
        }
    }

}
