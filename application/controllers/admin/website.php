<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/website_model', 'website');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['lists'] = $lists = $this->website->website_list();
        $data['id'] = $settingId = $lists['website_id'];
        $data['site_email'] = $lists['site_email'];
        $data['paypal_email'] = $lists['paypal_email'];
        $data['contact_address'] = $lists['contact_address'];
        $data['contact_no'] = $lists['contact_no'];
        $data['page_size_front'] = $lists['page_size_front'];
        $data['facebook'] = $lists['facebook'];
        $data['twitter'] = $lists['twitter'];
        $data['google'] = $lists['google'];
        $data['youtube'] = $lists['youtube'];
        $data['linkedin'] = $lists['linkedin'];
        $data['site_title'] = $lists['site_title'];
        $data['meta_keywords'] = $lists['meta_keywords'];
        $data['meta_description'] = $lists['meta_description'];
        $data['google_indexing'] = $lists['google_indexing'];
        $data['google_analytic_code'] = $lists['google_analytic_code'];
        $data['logo'] = $lists['logo'];
        $data['favicon'] = $lists['favicon'];
        if (!empty($_POST)) {
            // pr($_POST);die;
            $data['site_email'] = $this->input->post('site_email');
            $data['paypal_email'] = $this->input->post('paypal_email');
            $data['contact_address'] = $this->input->post('contact_address');
            $data['page_size_front'] = $this->input->post('page_size_front');
            $data['facebook'] = $this->input->post('facebook');
            $data['twitter'] = $this->input->post('twitter');
            $data['google'] = $this->input->post('google');
            $data['youtube'] = $this->input->post('youtube');
            $data['linkedin'] = $this->input->post('linkedin');
            $data['site_title'] = $this->input->post('site_title');
            $data['meta_keywords'] = $this->input->post('meta_keywords');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['google_indexing'] = $this->input->post('google_indexing');
            $data['google_analytic_code'] = $this->input->post('google_analytic_code');
            $data['logo'] = $this->input->post('logo');
            $data['favicon'] = $this->input->post('favicon');
            if ($_FILES["logo"]['name']) {
                $config['upload_path'] = './assets/uploads/site_images';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')) {
                    $error_msg = $this->upload->display_errors();
                } else {
                    $detail = array('upload_data' => $this->upload->data());
                }
            }
            if ($_FILES["favicon"]['name']) {
                $config['upload_path'] = './assets/uploads/site_images';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('favicon')) {
                    $error_msg = $this->upload->display_errors();
                } else {
                    $detail = array('favicon_data' => $this->upload->data());
                }
            }
            $websiteData = $this->website->update($settingId, $detail['upload_data']['file_name'], $detail['favicon_data']['file_name']);
            $this->session->set_userdata('websiteSettingsUpdate', show_message('Website Setting Detail Has Been Update Successfully', 'success'));
            redirect($this->config->item('adminFolder') . '/website-links');
            exit;
        }
        $data['page_name'] = 'websiteSetting';
        $data['breadcum'] = 'Manage Website Setting';
        $this->load->view($this->config->item('adminFolder') . "/header", $data);
        $this->load->view($this->config->item('adminFolder') . '/website/website_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

}
