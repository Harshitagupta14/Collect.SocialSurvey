<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nav_Menu extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/nav_menu_model', 'menu');
        $this->load->library('form_validation');
    }

    public function index() {

        $data['nav_menu_data'] = $this->menu->nav_menu_record();
        $data['breadcum'] = 'Manage Navigation';
        $this->load->view($this->config->item('adminFolder') . "/header", $data);
        $this->load->view($this->config->item('adminFolder') . '/nav_menu/nav_menu_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        //pr($_POST);die;
        // $link_title = $this->input->post('link_title');
        if (!empty($_POST)) {
            // pr($data);die;
            $this->form_validation->set_rules('nav_title', 'Nav Title', 'trim|required');
            $this->form_validation->set_rules('nav_url', 'Nav Url', 'trim|required');
            $this->form_validation->set_rules('nav_position', 'Nav Position', 'trim|required');
//            $this->form_validation->set_rules('is_parent','Is Parent','trim|required');
            $this->form_validation->set_rules('menu_group_id', 'Menu Group Id', 'trim|required');

            if ($this->form_validation->run()) {

                $this->menu->add_nav_menu();
                $this->session->set_flashdata('HeaderLinkSuccess', 'Header Links Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/nav_menu-list');
                exit;
            } else {
                $data['nav_title'] = $this->input->post('nav_title');
                $data['nav_url'] = $this->input->post('nav_url');
                $data['nav_position'] = $this->input->post('nav_position');
                $data['nav_target'] = $this->input->post('nav_target');
//                $data['is_parent'] = $this->input->post('is_parent');
                $data['menu_group_id'] = $this->input->post('menu_group_id');
            }
        }
        $data['nav_groups'] = $this->menu->nav_groups();
        $data['page_name'] = 'Nav_link';
        $data['breadcum'] = 'Add Nav Links';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/nav_menu/nav_menu_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($header_linkId) {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('nav_title', 'Nav Title', 'trim|required');
            $this->form_validation->set_rules('nav_url', 'Nav Url', 'trim|required');
            $this->form_validation->set_rules('nav_position', 'Nav Position', 'trim|required');
//            $this->form_validation->set_rules('is_parent','Is Parent','trim|required');
            $this->form_validation->set_rules('menu_group_id', 'Menu Group Id', 'trim|required');

            if ($this->form_validation->run()) {
                $header_linkData = $this->menu->update_nav_menu($header_linkId);
                $this->session->set_flashdata('HeaderLinkSuccess', 'Header Links Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/nav_menu-list');
                exit;
            } else {
                $data['nav_title'] = $this->input->post('nav_title');
                $data['nav_url'] = $this->input->post('nav_url');
                $data['nav_position'] = $this->input->post('nav_position');
                $data['nav_target'] = $this->input->post('nav_target');
//                $data['is_parent'] = $this->input->post('is_parent');
                $data['menu_group_id'] = $this->input->post('menu_group_id');
            }
        }
        $data['nav_groups'] = $this->menu->nav_groups();
        $lists = $this->menu->nav_menu_record_by_id($header_linkId);
        $data['menu_group_id'] = $lists['group_id_fk'];
        $data['nav_title'] = $lists['nav_title'];
        $data['nav_url'] = $lists['nav_url'];
        $data['nav_position'] = $lists['nav_position'];
        $data['nav_target'] = $lists['nav_target'];
        $data['page_name'] = 'header_link';
        $data['breadcum'] = 'Edit Header Links';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/nav_menu/nav_menu_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($navMenuId, $status) {
        if ($navMenuId != '') {
            $this->menu->update_status($navMenuId, $status);
            $this->session->set_flashdata('HeaderLinkSuccess', 'Status Of This Record Has Been Changed Successfully');
            redirect($this->config->item('adminFolder') . '/nav_menu-list');
            exit;
        }
    }

    public function delete($navMenuId) {
        if (isset($navMenuId) && $navMenuId != '') {
            $this->menu->delete_nav_menu($navMenuId);
            $this->session->set_flashdata('HeaderLinkSuccess', 'Navigation Detail Has Been Removed Successfully');
            redirect($this->config->item('adminFolder') . '/nav_menu-list');
            exit;
        }
    }

}
