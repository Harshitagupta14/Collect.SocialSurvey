<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login_identity', 'Identity (Email / Login)', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required');
        // if ($this->flexi_auth->ip_login_attempts_exceeded()) {
        //$this->form_validation->set_rules('recaptcha_response_field', 'Captcha Answer', 'required|validate_recaptcha');
        //      $this->form_validation->set_rules('login_captcha', 'Captcha Answer', 'required|validate_math_captcha[' . $this->input->post('login_captcha') . ']');
        //    }
        if ($this->form_validation->run()) {
            $remember_user = ($this->input->post('remember_me') == 1);
            $this->flexi_auth->login($this->input->post('login_identity'), $this->input->post('login_password'), 1);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function check_user_existence() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login_identity', 'Identity (Email / Login)', 'required');
        if ($this->form_validation->run()) {
            $this->flexi_auth->login($this->input->post('login_identity'), $this->input->post('login_password'), $remember_user);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            echo json_encode($this->data);
            die;
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function login_via_ajax() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('login_identity', 'Identity (Email / Login)', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $remember_user = 1;
            return $this->flexi_auth->login($this->input->post('login_identity'), $this->input->post('login_password'), $remember_user);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            $this->data['message'] = $this->flexi_auth->get_messages();
            return TRUE;
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function register_via_ajax() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
            array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
            array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $email = $this->input->post('register_email_address');
            $email_array = explode('@', $this->input->post('register_email_address'));
            $username = $email_array[0];
            $password = $this->input->post('register_password');
            $profile_data = array(
                'upro_first_name' => '',
                'upro_last_name' => '',
                'upro_phone' => '',
                'upro_newsletter' => ''
            );
            $instant_activate = TRUE;
            $response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, 1, $instant_activate);
            if ($response) {
                $email_data = array('identity' => $email);
                $this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                if ($instant_activate && $this->flexi_auth->login($email, $password)) {
                    $this->data['message'] = $this->flexi_auth->get_messages();
                    return TRUE;
                }
            }
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function register_account() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'customer_type', 'label' => 'Customer Type', 'rules' => 'required'),
            array('field' => 'register_first_name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'register_last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'register_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
            array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
                //array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $email = $this->input->post('register_email_address');
            $email_array = explode('@', $this->input->post('register_email_address'));
            $username = $email_array[0];
            $password = $this->input->post('register_password');
            $profile_data = array(
                'upro_type' => "customer",
                'upro_first_name' => $this->input->post('register_first_name'),
                'upro_last_name' => $this->input->post('register_last_name'),
                'upro_phone' => $this->input->post('register_phone_number'),
                'upro_newsletter' => 1
            );
            $instant_activate = TRUE;
            $response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, 1, $instant_activate);
            if ($response) {
                $email_data = array('identity' => $email);
                $this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                if ($instant_activate && $this->flexi_auth->login($email, $password)) {
                    redirect($this->config->item('login_url'));
                }
                redirect($this->config->item('login_url'));
            }
        }
        $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

        return FALSE;
    }

    function quick_register_account() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
            array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
            array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $email = $this->input->post('register_email_address');
            $email_array = explode('@', $this->input->post('register_email_address'));
            $username = $email_array[0];
            $password = $this->input->post('register_password');
            $instant_activate = TRUE;
            $response = $this->flexi_auth->insert_user($email, $username, $password, '', 1, $instant_activate);
            if ($response) {
                $email_data = array('identity' => $email);
                $this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
                $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                if ($instant_activate && $this->flexi_auth->login($email, $password)) {
                    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
                    //pr($this->data);die;
                    echo json_encode($this->data);
                    die;
                }
                redirect($this->config->item('login_url'));
            }
        }
        $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

        return FALSE;
    }

    function resend_activation_token() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('activation_token_identity', 'Identity (Email / Login)', 'required');
        if ($this->form_validation->run()) {
            $response = $this->flexi_auth->resend_activation_token($this->input->post('activation_token_identity'));
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            ($response) ? redirect($this->config->item('login_url')) : redirect('activation-token-resend');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function forgotten_password() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('forgot_password_identity', 'Identity (Email / Login)', 'required');
        if ($this->form_validation->run()) {
            $response = $this->flexi_auth->forgotten_password($this->input->post('forgot_password_identity'));
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function manual_reset_forgotten_password($user_id, $token) {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required|validate_password|matches[confirm_new_password]'),
            array('field' => 'confirm_new_password', 'label' => 'Confirm Password', 'rules' => 'required')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $new_password = $this->input->post('new_password');
            $this->flexi_auth->forgotten_password_complete($user_id, $token, $new_password);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function update_account() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'update_first_name', 'label' => 'First Name', 'rules' => 'required'),
            array('field' => 'update_last_name', 'label' => 'Last Name', 'rules' => 'required'),
            array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'update_newsletter', 'label' => 'Newsletter', 'rules' => 'integer')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $user_id = $this->flexi_auth->get_user_id();
            $profile_data = array(
                'upro_uacc_fk' => $user_id,
                'upro_first_name' => $this->input->post('update_first_name'),
                'upro_last_name' => $this->input->post('update_last_name'),
                'upro_phone' => $this->input->post('update_phone_number'),
                'upro_newsletter' => $this->input->post('update_newsletter')
            );
            $response = $this->flexi_auth->update_user($user_id, $profile_data);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            ($response) ? redirect($this->config->item('public_login_url') . '/dashboard') : redirect($this->config->item('public_login_url') . '/update_account');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function change_password() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'current_password', 'label' => 'Current Password', 'rules' => 'required'),
            array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required|validate_password|matches[confirm_new_password]'),
            array('field' => 'confirm_new_password', 'label' => 'Confirm Password', 'rules' => 'required')
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $identity = $this->flexi_auth->get_user_identity();
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $response = $this->flexi_auth->change_password($identity, $current_password, $new_password);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            ($response) ? redirect($this->config->item('public_login_url') . '/dashboard') : redirect($this->config->item('public_login_url') . '/change_password');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function send_new_email_activation() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'email_address', 'label' => 'Email', 'rules' => 'required|valid_email|identity_available'),
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $user_id = $this->flexi_auth->get_user_id();
            $this->flexi_auth->update_email_via_verification($user_id, $this->input->post('email_address'));
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('public_login_url') . '/dashboard');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function verify_updated_email($user_id, $token) {
        $this->flexi_auth->verify_updated_email($user_id, $token);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        if ($this->flexi_auth->is_logged_in()) {
            redirect($this->config->item('public_login_url') . '/dashboard');
        } else {
            redirect($this->config->item('login_url') . '/login');
        }
    }

    function manage_address_book() {
        if ($delete_addresses = $this->input->post('delete_address')) {
            foreach ($delete_addresses as $address_id => $delete) {
                $this->flexi_auth->delete_custom_user_data('user_address', $address_id);
            }
        }
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect($this->config->item('public_login_url') . '/manage_address_book');
    }

    function insert_address() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'insert_alias', 'label' => 'Address Alias', 'rules' => 'required'),
            array('field' => 'insert_recipient', 'label' => 'Recipient', 'rules' => 'required'),
            array('field' => 'insert_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'insert_address', 'label' => 'Address', 'rules' => 'required'),
            array('field' => 'insert_city', 'label' => 'City / Town', 'rules' => 'required'),
            array('field' => 'insert_county', 'label' => 'County', 'rules' => 'required'),
            array('field' => 'insert_post_code', 'label' => 'Post Code', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $user_id = $this->flexi_auth->get_user_id();
            $address_data = array(
                'uadd_alias' => $this->input->post('insert_alias'),
                'uadd_recipient' => $this->input->post('insert_recipient'),
                'uadd_phone' => $this->input->post('insert_phone_number'),
                'uadd_landmark' => $this->input->post('insert_landmark'),
                'uadd_address' => $this->input->post('insert_address'),
                'uadd_city' => $this->input->post('insert_city'),
                'uadd_county' => $this->input->post('insert_county'),
                'uadd_post_code' => $this->input->post('insert_post_code'),
                'uadd_country' => 'india'
            );
            $response = $this->flexi_auth->insert_custom_user_data($user_id, $address_data);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            ($response) ? redirect($this->config->item('public_login_url') . '/addresses') : redirect($this->config->item('public_login_url') . '/create-address');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function insert_address_via_ajax() {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'insert_recipient', 'label' => 'Recipient', 'rules' => 'required'),
            array('field' => 'insert_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'insert_address', 'label' => 'Address', 'rules' => 'required'),
            array('field' => 'insert_city', 'label' => 'City / Town', 'rules' => 'required'),
            array('field' => 'insert_county', 'label' => 'County', 'rules' => 'required'),
            array('field' => 'insert_post_code', 'label' => 'Post Code', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $user_id = $this->flexi_auth->get_user_id();
            $address_data = array(
                'uadd_alias' => $this->input->post('insert_alias') != '' ? $this->input->post('insert_alias') : 'No Name',
                'uadd_recipient' => $this->input->post('insert_recipient'),
                'uadd_phone' => $this->input->post('insert_phone_number'),
                'uadd_landmark' => $this->input->post('insert_landmark'),
                'uadd_address' => $this->input->post('insert_address'),
                'uadd_city' => $this->input->post('insert_city'),
                'uadd_county' => $this->input->post('insert_county'),
                'uadd_post_code' => $this->input->post('insert_post_code'),
                'uadd_country' => 'india'
            );
            $response = $this->flexi_auth->insert_custom_user_data($user_id, $address_data);
            if ($response) {
                $this->data['message'] = $this->flexi_auth->get_messages();
                return TRUE;
            } else {
                $this->data['message'] = $this->flexi_auth->get_messages();
                return FALSE;
            }
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function update_address($address_id) {
        $this->load->library('form_validation');
        $validation_rules = array(
            array('field' => 'update_alias', 'label' => 'Address Alias', 'rules' => 'required'),
            array('field' => 'update_recipient', 'label' => 'Recipient', 'rules' => 'required'),
            array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
            array('field' => 'update_address', 'label' => 'Address', 'rules' => 'required'),
            array('field' => 'update_city', 'label' => 'City / Town', 'rules' => 'required'),
            array('field' => 'update_county', 'label' => 'County', 'rules' => 'required'),
            array('field' => 'update_post_code', 'label' => 'Post Code', 'rules' => 'required'),
            array('field' => 'update_country', 'label' => 'Country', 'rules' => 'required'),
        );
        $this->form_validation->set_rules($validation_rules);
        if ($this->form_validation->run()) {
            $address_id = $this->input->post('update_address_id');
            $address_data = array(
                'uadd_alias' => $this->input->post('update_alias'),
                'uadd_recipient' => $this->input->post('update_recipient'),
                'uadd_phone' => $this->input->post('update_phone_number'),
                'uadd_landmark' => $this->input->post('update_landmark'),
                'uadd_address' => $this->input->post('update_address'),
                'uadd_city' => $this->input->post('update_city'),
                'uadd_county' => $this->input->post('update_county'),
                'uadd_post_code' => $this->input->post('update_post_code'),
                'uadd_country' => $this->input->post('update_country')
            );
            $response = $this->flexi_auth->update_custom_user_data('user_address', $address_id, $address_data);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            ($response) ? redirect($this->config->item('public_login_url') . '/addresses') : redirect('auth_public/update-address');
        } else {
            $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
            return FALSE;
        }
    }

    function delete_address($address_id) {
        $address_id = $address_id;
        $address_data = array(
            'uadd_status' => 'inactive'
        );
        $response = $this->flexi_auth->update_custom_user_data('user_address', $address_id, $address_data);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        ($response) ? redirect($this->config->item('public_login_url') . '/addresses') : redirect($this->config->item('public_login_url') . '/update-address');
        $this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
        return FALSE;
    }

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */