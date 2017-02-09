<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->auth = new stdClass;
        $this->load->model('cart_model', 'cart');
        $this->load->library('flexi_auth');
        $this->load->model('content_model', 'content');
        $this->load->model($this->config->item('login_folder') . '/auth_model', 'authentication');
        if ($this->flexi_auth->is_logged_in_via_password() && $this->uri->segment(2) != 'logout') {
            if ($this->session->flashdata('message')) {
                $this->session->keep_flashdata('message');
            }
            if ($this->flexi_auth->is_admin()) {

                redirect($this->config->item('admin_login_url') . '/dashboard');
            } else {
                $customerId = $this->flexi_auth->get_user_id();
                //pr($customerId);die;
                $this->cart->session_to_usercart($customerId);
                $this->cart->session_to_user_cartItems($customerId);
                redirect('dashboard');
            }
        }
        $this->data = null;
    }

    function index() {
        $this->login();
    }

    function login() {
        if ($this->input->post('login_user')) {
            $this->authentication->login();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('admin_login_folder') . '/login_view', $this->data);
    }

    function secure_login() {
        if ($this->input->post('login_user')) {
            $this->authentication->login();
        }
        /** if ($this->flexi_auth->ip_login_attempts_exceeded()) {
          $this->data['captcha'] = $this->flexi_auth->math_captcha(FALSE);
          }* */
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('admin_login_folder') . '/login_view', $this->data);
    }

    function check_user_existence() {
        if ($this->input->post('login_identity')) {
            $this->authentication->check_user_existence();
        }
        echo json_encode($this->data);
        die;
    }

    function login_via_ajax() {
        if ($this->input->is_ajax_request()) {
            $this->authentication->login_via_ajax();
            $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
            //echo json_encode($this->flexi_auth->is_logged_in());
            if ($this->flexi_auth->is_logged_in()) {
                $response['success'] = true;
                echo json_encode($response);
                die;
            } else {
                if ($this->flexi_auth->ip_login_attempts_exceeded()) {
                    $this->data['captcha'] = $this->flexi_auth->math_captcha(FALSE);
                }
                $response['captcha'] = $this->data['captcha'];
                $response['success'] = false;
                echo json_encode($response);
                die;
            }
        }
        //   $this->load->view($this->config->item('public_login_folder') . '/login_view', $this->data);
        // }
    }

    function register_account() {

        if ($this->flexi_auth->is_logged_in()) {
            redirect($this->config->item('login_url'));
        } else if ($this->input->post('register_user')) {

            $this->authentication->register_account();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/register_view', $this->data);
    }

    /** function quick_register_account() {
      if ($this->flexi_auth->is_logged_in()) {
      redirect($this->config->item('login_url'));
      } else if ($this->input->post('register_email_address')) {
      $this->authentication->quick_register_account();
      }
      $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
      $this->load->view($this->config->item('public_login_folder') . '/register_view', $this->data);
      } */
    function register_account_customer() {
        if ($this->flexi_auth->is_logged_in()) {
            redirect($this->config->item('login_url'));
        } else if ($this->input->post('register_user')) {
            $this->authentication->register_account();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/register_view', $this->data);
    }

    function register_account_service_provider() {
        if ($this->flexi_auth->is_logged_in()) {
            redirect($this->config->item('login_url'));
        } else if ($this->input->post('register_user')) {
            $this->authentication->register_account();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/register_view_service_provider', $this->data);
    }

    function quick_register_account_via_ajax() {
        if ($this->input->is_ajax_request()) {
            if ($this->flexi_auth->is_logged_in()) {
                $this->data['redirect'] = $this->config->item('login_url');
            } else if ($this->input->post('register_email_address')) {
                $this->authentication->register_via_ajax();
                if ($this->flexi_auth->is_logged_in()) {
                    $this->data['response'] = TRUE;
                } else {
                    $this->data['response'] = FALSE;
                }
            }
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        echo json_encode($this->data);
        die;
    }

    function activate_account($user_id, $token = FALSE) {
        $this->flexi_auth->activate_user($user_id, $token, TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect($this->config->item('login_url'));
    }

    function resend_activation_token() {
        if ($this->input->post('send_activation_token')) {
            $this->authentication->resend_activation_token();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/resend_activation_token_view', $this->data);
    }

    function forgotten_password() {
        if ($this->input->post('send_forgotten_password')) {
            $this->authentication->forgotten_password();
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/forgot_password_view', $this->data);
    }

    function manual_reset_forgotten_password($user_id = FALSE, $token = FALSE) {
        if ($this->input->post('change_forgotten_password')) {
            $this->authentication->manual_reset_forgotten_password($user_id, $token);
        }
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        $this->load->view($this->config->item('public_login_folder') . '/forgot_password_update_view', $this->data);
    }

    function auto_reset_forgotten_password($user_id = FALSE, $token = FALSE) {
        $this->flexi_auth->forgotten_password_complete($user_id, $token, FALSE, TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect($this->config->item('login_url'));
    }

    function logout() {
        $this->flexi_auth->logout(TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect($this->config->item('login_url'));
    }

    function secure_logout() {
        $this->flexi_auth->logout(TRUE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect(site_url(''));
    }

    function logout_session() {
        $this->flexi_auth->logout(FALSE);
        $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
        redirect($this->config->item('login_url'));
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */