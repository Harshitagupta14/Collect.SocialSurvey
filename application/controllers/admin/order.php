<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

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
        $this->load->model($this->config->item('adminFolder') . '/order_model', 'order');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['order_data'] = $this->order->get_order_list();
        //pr($data);die;
        $data['page_name'] = 'Order';
        $data['breadcum'] = 'Manage Order';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/order/order_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function view($order_id) {
        $data['view_data'] = $view_data = $this->order->getOrderListById($order_id);
        if (empty($view_data)) {
            redirect($this->config->item('adminFolder') . '/order-list');
            exit;
        }
        $data['order_item'] = $view_data = $this->order->getOrderItemListById($order_id);
        $this->load->view($this->config->item('adminFolder') . '/order/order_view', $data);
    }

    public function approve($orderId, $status) {
        if ($orderId != '') {
            $this->order->updateStatus($orderId, $status);
            $this->session->set_flashdata('OrderSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/order-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/order/order_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($orderId) {
        if (isset($orderId) && $orderId != '') {
            $this->order->delete($orderId);
            $this->session->set_flashdata('OrderSuccess', 'Order Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/order-list');
            exit;
        }
    }

}
