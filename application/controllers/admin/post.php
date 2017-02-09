<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/post_model', 'post');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['post_data'] = $this->post->getPostList();
        //pr($data);die;
        $data['page_name'] = 'Post';
        $data['breadcum'] = 'Manage Post';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/post/post_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {

            $this->form_validation->set_rules('post_name', 'Post Title', 'trim|required');
            $this->form_validation->set_rules('post_content', 'Post Content', 'trim|required');
            

            if ($this->form_validation->run()) {
                
                $postData = $this->post->add($this->input->post('post_name'));
                $this->session->set_flashdata('PostSuccess', 'Post Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/post-list');
                exit;
            } else {
                $data['post_name'] = $this->input->post('post_name');
                $data['post_content'] = $this->input->post('post_content');
            }
        }
        $data['page_name'] = 'post';
        $data['breadcum'] = 'Add Post';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/post/post_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($postId) {

        if (!empty($_POST)) {
                  $this->form_validation->set_rules('post_name', 'Post Title', 'trim|required');
            $this->form_validation->set_rules('post_content', 'Post Content', 'trim|required');
            if ($this->form_validation->run()) {
     
                $postData = $this->post->update($postId);
                $this->session->set_flashdata('PostSuccess', 'Post Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/post-list');
                exit;
            } else {
                $data['post_name'] = $post_name = $this->input->post('post_name');
                $data['post_content']  = $this->input->post('post_content');
            }
        }
        $lists = $this->post->getPostListById($postId);
        // pr($lists);die;
        $data['post_id'] = $lists['post_id'];
        $data['post_name'] = $lists['post_name'];
        $data['post_content'] = $lists['post_content'];
        $data['page_name'] = 'post';
        $data['breadcum_edit'] = 'Edit Post';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/post/post_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($postId, $status) {
        if ($postId != '') {
            $postData = $this->post->updateStatus($postId, $status);
            $this->session->set_flashdata('PostSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/post-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/post/post_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($postId) {
        if (isset($postId) && $postId != '') {
            $this->post->delete($postId);
            $this->session->set_flashdata('PostSuccess', 'Post Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/post-list');
            exit;
        }
    }

}
