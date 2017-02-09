<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_admin_model extends CI_Model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    function get_user_accounts() {
        $sql_select = array(
            $this->flexi_auth->db_column('user_acc', 'id'),
            $this->flexi_auth->db_column('user_acc', 'email'),
            $this->flexi_auth->db_column('user_acc', 'suspend'),
            $this->flexi_auth->db_column('user_group', 'name'),
            'upro_first_name',
            'upro_last_name',
        );
        $this->flexi_auth->sql_select($sql_select);
        if (!$this->flexi_auth->in_group('Master Admin')) {
            $sql_where[$this->flexi_auth->db_column('user_group', 'id') . ' !='] = 3;
            $this->flexi_auth->sql_where($sql_where);
        }
        $uri = $this->uri->uri_to_assoc(3);
        $limit = 10;
        $offset = (isset($uri['page'])) ? $uri['page'] : FALSE;
        if (array_key_exists('search', $uri)) {
            $pagination_url = 'user-management/search/' . $uri['search'] . '/';
            $config['uri_segment'] = 6;
            $search_query = str_replace('-', ' ', $uri['search']);
            $total_users = $this->flexi_auth->search_users_query($search_query)->num_rows();
            $this->flexi_auth->sql_limit($limit, $offset);
            $this->data['users'] = $this->flexi_auth->search_users_array($search_query);
        } else {
            $pagination_url = 'user-management/';
            $search_query = FALSE;
            $config['uri_segment'] = 4;
            $total_users = $this->flexi_auth->get_users_query()->num_rows();
            $this->flexi_auth->sql_limit($limit, $offset);
            $this->data['users'] = $this->flexi_auth->get_users_array();
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . $pagination_url . 'page/';
        $config['total_rows'] = $total_users;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        $this->data['search_query'] = $search_query; // Populates search input field in view.
        $this->data['pagination']['links'] = $this->pagination->create_links();
        $this->data['pagination']['total_users'] = $total_users;
    }

    function update_user_accounts() {

        if ($this->flexi_auth->is_privileged('Delete Users')) {
            if ($delete_users = $this->input->post('delete_user')) {
                foreach ($delete_users as $user_id => $delete) {
                    $this->flexi_auth->delete_user($user_id);
                }
            }
        }
        if ($user_status = $this->input->post('suspend_status')) {
            $current_status = $this->input->post('current_status');

            foreach ($user_status as $user_id => $status) {
                if ($current_status[$user_id] != $status) {
                    if ($status == 1) {
                        $this->flexi_auth->update_user($user_id, array($this->flexi_auth->db_column('user_acc', 'suspend') => 1));
                    } else {
                        $this->flexi_auth->update_user($user_id, array($this->flexi_auth->db_column('user_acc', 'suspend') => 0));
                    }
                }
            }
        }
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect('user-management');
    }

    function register_user_account() {
        print_r($_POST);
        die;
        $this->load->library('form_validation');
        if ($_POST['customer_type'] == "Service Provider") {
            $validation_rules = array(
                array('field' => 'register_first_name', 'label' => 'First Name', 'rules' => 'required'),
                array('field' => 'register_last_name', 'label' => 'Last Name', 'rules' => 'required'),
                array('field' => 'register_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
                array('field' => 'register_company_detail', 'label' => 'About Company', 'rules' => 'required'),
                array('field' => 'register_company_name', 'label' => 'Company Name', 'rules' => 'required'),
                array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
                array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
                    // array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
            );
        } else {

            $validation_rules = array(
                array('field' => 'register_first_name', 'label' => 'First Name', 'rules' => 'required'),
                array('field' => 'register_last_name', 'label' => 'Last Name', 'rules' => 'required'),
                array('field' => 'register_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
                array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
                array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
                    //array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
            );
        }
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $email = $this->input->post('register_email_address');
            $email_array = explode('@', $this->input->post('register_email_address'));
            $username = $email_array[0];
            $password = $this->input->post('register_password');
            if ($_POST['customer_type'] == "Service Provider") {
                $profile_data = array(
                    'upro_first_name' => $this->input->post('register_first_name'),
                    'upro_last_name' => $this->input->post('register_last_name'),
                    'upro_phone' => $this->input->post('register_phone_number'),
                    'upro_company' => $this->input->post('register_company_name'),
                    'upro_company_detail' => $this->input->post('register_company_detail'),
                    'upro_newsletter' => 1
                );
            } else {
                $profile_data = array(
                    'upro_first_name' => $this->input->post('register_first_name'),
                    'upro_last_name' => $this->input->post('register_last_name'),
                    'upro_phone' => $this->input->post('register_phone_number'),
                    'upro_newsletter' => 1
                );
            }
            $instant_activate = TRUE;
            $response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, 1, $instant_activate);
            if ($response) {
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                redirect('user-management');
            }
        }
        $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
        return FALSE;
    }

    function update_user_account($user_id) {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'update_first_name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'update_last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'update_newsletter', 'label' => 'Newsletter', 'rules' => 'integer'),
            array('field' => 'update_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available[' . $user_id . ']'),
            array('field' => 'update_username', 'label' => 'Username', 'rules' => 'min_length[4]|identity_available[' . $user_id . ']'),
            array('field' => 'update_group', 'label' => 'User Group', 'rules' => 'required|integer')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $profile_data = array(
                'upro_id' => $user_id,
                'upro_first_name' => $this->input->post('update_first_name'),
                'upro_last_name' => $this->input->post('update_last_name'),
                'upro_phone' => $this->input->post('update_phone_number'),
                'upro_newsletter' => $this->input->post('update_newsletter'),
                $this->flexi_auth->db_column('user_acc', 'email') => $this->input->post('update_email_address'),
                $this->flexi_auth->db_column('user_acc', 'username') => $this->input->post('update_username'),
                $this->flexi_auth->db_column('user_acc', 'group_id') => $this->input->post('update_group')
            );
            $this->flexi_auth->update_user($user_id, $profile_data);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('user-management');
        }

        return FALSE;
    }

    function delete_users($inactive_days) {
        $this->flexi_auth->delete_unactivated_users($inactive_days);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect('user-management');
    }

}

/* End of file auth_admin_model.php */
/* Location: ./application/models/auth_admin_model.php */