<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model', 'cart');
        $this->load->model('order_model', 'order');
        $this->load->model('mailsending_model', 'mail');
        $this->load->library('form_validation');
        $this->load->model('content_model', 'post');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {

        if (!$this->flexi_auth->is_logged_in()) {
            $this->flexi_auth->set_error_message('You must login to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        }

        $data['cart_data'] = $cart_data = $this->cart->getCartDetail();
        $data['cart_items_data'] = $cart_items_data = $this->cart->getCartItemDetail();

        if (!empty($_POST)) {
            // pr($_POST);die;
            $this->form_validation->set_rules('email_id', 'Email', 'trim|required');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('contact_no', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('province_name', 'Province', 'trim|required');
            $this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');


            if ($this->form_validation->run()) {
                if (!$cart_data || !$cart_items_data) {
                    redirect($_SERVER['HTTP_REFERER']);
                    exit;
                }
                $this->session->set_userdata($this->session->userdata('my_session_id'), $this->input->post());
                if ($cart_data && $cart_items_data && $this->session->userdata($this->session->userdata('my_session_id'))) {
                    $data['order_data'] = $this->session->userdata($this->session->userdata('my_session_id'));
                    //pr($data);
                    $data['breadcum'] = 'Order Review';
                    $this->load->view($this->config->item('template') . '/header', $data);
                    $this->load->view($this->config->item('template') . '/orderreview');
                    $this->load->view($this->config->item('template') . '/footer');
                }
            } else {
                $this->session->set_flashdata('ShippingError', 'Fields are Missing');
            }
        }
        if (!$cart_data || !$cart_items_data) {
            redirect($_SERVER['HTTP_REFERER']);
            exit;
        }
        $this->data['user_details'] = $this->flexi_auth->get_user_by_identity_row_array();
        $data['user_email'] = $this->data['user_details']['uacc_email'];
        $data['page_name'] = 'Shipping Details';
        $data['province_list'] = $this->common_model->getProvinceList();
        $data['breadcum'] = 'Add shipping Details';
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/shipping');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function cancelorder() {
        $this->cart->destroy_cart(1, FALSE);
        redirect('cart');
    }

    public function finalization() {
        $cart_data = $this->cart->getCartDetail();
        $cart_items_data = $this->cart->getCartItemDetail();

        $data['payment_type'] = $payment_type = $this->session->userdata($this->session->userdata('my_session_id'))['payment_type'];
        $data['total_amount'] = $total_amount = $cart_data['total_cart_price'];

        if ($cart_data && $cart_items_data && $this->session->userdata($this->session->userdata('my_session_id'))) {
            $order_id = $this->order->addConfirmedOrder($cart_data);
            foreach ($cart_items_data as $cart_items) {
                $order_item_id = $this->order->addOrderItems($order_id, $cart_items);
            }
            $this->cart->destroy_cart(1, FALSE);
            $this->session->unset_userdata($this->session->userdata('my_session_id'));
            $this->session->set_userdata('order_id', $order_id);
            //pr($order_id);die;
            if ($payment_type == 'cash_on_delivery') {
                $this->mail->orderMail($order_id);
                redirect('thanks-for-order');

                exit;
            } else if ($payment_type == 'paypal') {
                $this->load->view($this->config->item('template') . '/order_payment', $data);
            }
        } else {
            redirect('cart');
            exit;
        }
    }

    public function orderThanks() {
        $order_id = $this->session->userdata('order_id');
        if ($order_id) {
            $data['order_detail'] = $order_detail = $this->order->getOrderDetailById($order_id);

            $data['orderItems'] = $this->order->getOrderItems($order_detail['order_id']);
            // pr($sd);die;
            $this->load->view($this->config->item('template') . '/header', $data);
            $this->load->view($this->config->item('template') . '/ordercomplete');
            $this->load->view($this->config->item('template') . '/footer');
        } else {
            redirect('cart');
            exit;
        }
    }

}
