<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        $this->load->model($this->config->item('login_folder') . '/auth_admin_model', 'admin_authentication');
        if (!$this->flexi_auth->is_logged_in_via_password() || !$this->flexi_auth->is_admin()) {
            $this->flexi_auth->set_error_message('You must login as an admin to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        }
        $this->data = null;
    }

    function index() {
        if (!$this->flexi_auth->is_admin()) {
            redirect($this->config->item('public_login_url') . '/dashboard');
        }
        $this->dashboard();
    }

    function dashboard() {
        $this->data['message'] = $this->session->flashdata('message');
        $this->load->view($this->config->item('admin_login_folder') . '/dashboard_view', $this->data);
    }

    function manage_user_accounts() {
        if (!$this->flexi_auth->is_privileged('View Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        if ($this->input->post('search_users') && $this->input->post('search_query')) {
            $search_query = str_replace(' ', '-', $this->input->post('search_query'));
            redirect($this->config->item('admin_login_url') . '/user-management/search/' . $search_query . '/page/');
        } else if ($this->input->post('update_users') && $this->flexi_auth->is_privileged('Update Users')) {
            $this->admin_authentication->update_user_accounts();
        }
        $this->admin_authentication->get_user_accounts();
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('admin_login_folder') . '/user_acccounts_view', $this->data);
    }

    function update_user_account($user_id) {
        if (!$this->flexi_auth->is_privileged('Update Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to update user accounts.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        if ($this->input->post('update_users_account')) {
            $this->admin_authentication->update_user_account($user_id);
        }
        $sql_where = array($this->flexi_auth->db_column('user_acc', 'id') => $user_id);
        $this->data['user'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);
        $this->data['groups'] = $this->flexi_auth->get_groups_array();
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('admin_login_folder') . '/user_account_update_view', $this->data);
    }

    function register_new_user() {
        if (!$this->flexi_auth->is_privileged('Update Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to create user accounts.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        if ($this->input->post('register_user')) {
            $this->admin_authentication->register_user_account();
        }
        $this->data['groups'] = $this->flexi_auth->get_groups_array();
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('admin_login_folder') . '/user_account_create_view', $this->data);
    }

    function list_user_status($status = FALSE) {
        if (!$this->flexi_auth->is_privileged('View Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        $this->data['page_title'] = ($status == 'inactive') ? 'Inactive Users' : 'Active Users';
        $this->data['status'] = ($status == 'inactive') ? 'inactive_users' : 'active_users'; // Indicate page function.
        $sql_select = array(
            $this->flexi_auth->db_column('user_acc', 'id'),
            $this->flexi_auth->db_column('user_acc', 'email'),
            $this->flexi_auth->db_column('user_acc', 'active'),
            $this->flexi_auth->db_column('user_group', 'name'),
            'upro_first_name',
            'upro_last_name'
        );
        $sql_where[$this->flexi_auth->db_column('user_acc', 'active')] = ($status == 'inactive') ? 0 : 1;
        if (!$this->flexi_auth->in_group('Master Admin')) {
            $sql_where[$this->flexi_auth->db_column('user_group', 'id') . ' !='] = 2;
        }
        $this->data['users'] = $this->flexi_auth->get_users_array($sql_select, $sql_where);

        $this->load->view($this->config->item('admin_login_folder') . '/failed_users_view', $this->data);
    }

    function delete_unactivated_users() {
        if (!$this->flexi_auth->is_privileged('View Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view user accounts.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        $inactive_days = 28;
        if ($this->input->post('delete_unactivated') && $this->flexi_auth->is_privileged('Delete Users')) {

            $this->admin_authentication->delete_users($inactive_days);
        }
        $sql_select = array(
            $this->flexi_auth->db_column('user_acc', 'id'),
            $this->flexi_auth->db_column('user_acc', 'email'),
            $this->flexi_auth->db_column('user_acc', 'active'),
            $this->flexi_auth->db_column('user_group', 'name'),
            'upro_first_name',
            'upro_last_name'
        );
        $this->data['users'] = $this->flexi_auth->get_unactivated_users_array($inactive_days, $sql_select);

        $this->load->view($this->config->item('admin_login_folder') . '/users_unactivated_view', $this->data);
    }

    function failed_login_users() {
        if (!$this->flexi_auth->is_privileged('View Users')) {
            $this->session->set_flashdata('message', '<p class="error_msg">You do not have privileges to view this page.</p>');
            redirect($this->config->item('admin_login_url'));
        }
        $this->data['page_title'] = 'Failed Login Users';
        $this->data['status'] = 'failed_login_users';
        $sql_select = array(
            $this->flexi_auth->db_column('user_acc', 'id'),
            $this->flexi_auth->db_column('user_acc', 'email'),
            $this->flexi_auth->db_column('user_acc', 'failed_logins'),
            $this->flexi_auth->db_column('user_acc', 'active'),
            $this->flexi_auth->db_column('user_group', 'name'),
            'upro_first_name',
            'upro_last_name'
        );
        $sql_where[$this->flexi_auth->db_column('user_acc', 'failed_logins') . ' >='] = 3;
        if (!$this->flexi_auth->in_group('Master Admin')) {
            $sql_where[$this->flexi_auth->db_column('user_group', 'id') . ' !='] = 2;
        }
        $this->data['users'] = $this->flexi_auth->get_users_array($sql_select, $sql_where);
        $this->load->view($this->config->item('admin_login_folder') . '/failed_users_view', $this->data);
    }

}

/* End of file auth_admin.php */
/* Location: ./application/controllers/auth_admin.php */