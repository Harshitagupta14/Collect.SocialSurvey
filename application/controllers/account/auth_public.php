<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_Public extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        $this->load->library('components');
        $this->load->model('content_model', 'content');
        $this->load->model('order_model', 'order');
        $this->load->model('survey_model', 'survey');
        $this->load->model($this->config->item('login_folder') . '/auth_model', 'authentication');
        if (!$this->flexi_auth->is_logged_in() && $this->uri->segment(2) != 'update_email') {
            $this->flexi_auth->set_error_message('You must login to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        }
        $this->data = null;
    }

    function index() {
        if ($this->flexi_auth->is_admin()) {
            redirect($this->config->item('admin_login_url') . '/dashboard');
        }
        $this->dashboard();
    }

    function dashboard() {
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['user'] = $this->flexi_auth->get_user_by_identity_row_array();
        $parent_id = $this->data['user']['uacc_parent_id_fk'];
        $this->data['survey_feeds'] = $this->survey->get_published_survey_feeds_by_args($parent_id);
        $this->load->view($this->config->item('public_login_folder') . '/header', $this->data);
        $this->load->view($this->config->item('public_login_folder') . '/dashboard_view', $this->data);
        $this->load->view($this->config->item('public_login_folder') . '/footer', $this->data);
    }

    function update_account() {
        // print_r($_POST);die;
        if ($this->input->post('update_account')) {

            $this->authentication->update_account();
        }
        $this->data['user'] = $this->flexi_auth->get_user_by_identity_row_array();
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/account_update_view', $this->data);
    }

    function change_password() {
        if ($this->input->post('change_password')) {
            $this->authentication->change_password();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/password_update_view', $this->data);
    }

    function update_email($user_id = FALSE, $token = FALSE) {
        if ($this->input->post('update_email')) {
            $this->authentication->send_new_email_activation();
        } else if (is_numeric($user_id) && strlen($token) == 40) {
            $this->authentication->verify_updated_email($user_id, $token);
        }
        if ($this->flexi_auth->is_logged_in()) {
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            $this->load->view($this->config->item('public_login_folder') . '/email_update_view', $this->data);
        } else {
            redirect($this->config->item('login_url'));
        }
    }

    function manage_address_book() {
        if ($this->input->post('update_addresses')) {
            $this->authentication->manage_address_book();
        }
        $user_id = $this->flexi_auth->get_user_id();
        $sql_select = array('uadd_id', 'uadd_alias', 'uadd_recipient', 'uadd_city', 'uadd_county', 'uadd_phone', 'uadd_address', 'uadd_post_code');
        $sql_where = array('uadd_uacc_fk' => $user_id, 'uadd_status' => 'active');
        $this->data['addresses'] = $this->flexi_auth->get_custom_user_data_array($sql_select, $sql_where, FALSE);
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/address_view', $this->data);
    }

    function insert_address() {
        // print_r($_POST);die;
        if ($this->input->post('create_address')) {
            $this->authentication->insert_address();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/address_insert_view', $this->data);
    }

    function update_address($address_id = FALSE) {
        if (!is_numeric($address_id)) {
            redirect($this->config->item('public_login_url') . '/dashboard');
        } else if ($this->input->post('update_address')) {
            $this->authentication->update_address($address_id);
        }
        $user_id = $this->flexi_auth->get_user_id();
        $sql_where = array('uadd_id' => $address_id, 'uadd_uacc_fk' => $user_id);
        $this->data['address'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/address_update_view', $this->data);
    }

    function delete_address($address_id = FALSE) {
        if (!is_numeric($address_id)) {
            redirect($this->config->item('public_login_url') . '/dashboard');
        } else {
            $this->authentication->delete_address($address_id);
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        redirect($this->config->item('public_login_url') . '/addresses');
        exit;
    }

    function order_history() {
        // print_r($_POST);die;
        $this->data['user'] = $this->flexi_auth->get_user_by_identity_row_array();
//        $customer_id =  $this->data['user']['uacc_id'];
//       $o = $this->order->getOrderIdByCustomerId($customer_id);
        //pr( $this->data['user']);die;
        $this->load->view($this->config->item('public_login_folder') . '/order_history_view', $this->data);
    }

}

/* End of file auth_public.php */
/* Location: ./application/controllers/auth_public.php */