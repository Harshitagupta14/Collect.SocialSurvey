<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model', 'cart');
        $this->load->model('product_model', 'product');
        $this->load->model('content_model', 'post');
        $this->load->library('form_validation');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {
        $data['page_name'] = 'cart';
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/cart');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function addCartItem() {

        if (!empty($_POST)) {
            $this->form_validation->set_rules('product_id', 'Product Id', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category Id', 'trim|required');
            // $this->form_validation->set_rules('product_color', 'Product Color', 'trim|required');
            $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'trim|required');
            if ($this->form_validation->run()) {
                $product_detail = $this->common_model->getSingleRowFromAnyTable('product_id', $this->input->post('product_id'), $this->product->tableProduct);
                $product_image_detail = $this->product->get_product_featured_image($this->input->post('product_id'));
                //pr($product_image_detail);
                $category_id = $this->input->post('category_id');
                $category_detail = $this->common_model->getSingleRowFromAnyTable('category_id', $category_id, 'tbl_category');
                $cart_data = $this->cart->getCartItemByAttributes($this->input->post('product_id'), $this->input->post('product_color'), FALSE);
                $product_quantity = $this->input->post('product_quantity');
                if (isset($cart_data) && !empty($cart_data)) {
                    $product_quantity = $product_quantity + $cart_data['product_quantity'];
                }

                $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
                $session_id = $this->session->userdata('my_session_id');
                if (isset($customer_id) && $customer_id != '') {
                    $condition = $customer_id;
                } else {
                    $condition = $session_id;
                }
                if ($product_detail->product_discount != 0) {
                    $product_price = ($product_detail->product_mrp) - ($product_detail->product_mrp * $product_detail->product_discount) / 100;
                } else {
                    $product_price = $product_detail->product_price;
                }
                //pr($condition);die;
                $data = array(
                    'cart_item_id' => $cart_data['cart_item_id'],
                    'session_id' => $session_id,
                    'customer_id' => $customer_id,
                    'product_id' => $this->input->post('product_id'),
                    'product_title' => $product_detail->product_title,
                    'product_upc_code' => $product_detail->product_upc_code,
                    'product_code' => $product_detail->product_code,
                    'product_description' => $product_detail->product_small_description,
                    'product_size' => $this->input->post('product_size'),
                    'product_color' => $this->input->post('product_color'),
                    'product_image' => $product_image_detail->image_name,
                    'product_quantity' => $product_quantity,
                    'product_price' => $product_price,
                    'category_id' => $category_id,
                    'category_name' => $category_detail->category_name,
                    'unit_price' => $product_price,
                    'total_product_price' => $product_quantity * $product_price
                );

                $this->cart->addCartItems($condition, $data);
                $this->updateCartCost();
            }
        }
    }

    public function saveTaxInformation() {
        $countryId = $this->input->post('country_id');
        $provinceId = $this->input->post('province_id');
        $this->session->set_userdata('country_id', $countryId);
        $this->session->set_userdata('province_id', $provinceId);
        $tax_data = $this->common_model->getTaxByCountryProvinceId($countryId, $provinceId);
        //pr($tax_data);die;
        $data['cart_data'] = $this->cart->getCartItemDetail();
        $data['cart_detail'] = $this->cart->getCartDetail();

        if ($tax_data) {
            $this->updateCartCost('', $tax_data);
            $output = array(
                'cart_data' => $this->load->view($this->config->item('template') . '/cart', null, true),
                'msg' => 'Tax Information successfully Applied.',
            );
            return $this->output
                            ->set_header("HTTP/1.0 200 OK")
                            ->set_content_type('application/json')
                            ->set_output(json_encode($output));
        }
    }

    public function applyCoupon() {
        //pr($_POST);die;
        if (!empty($_POST)) {
            $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required');
            if ($this->form_validation->run()) {
                $coupon_data = $this->common_model->getSingleRowFromAnyTable('coupon_code', $this->input->post('coupon_code'), 'tbl_coupons');
                // pr($coupon_data);
                if ($coupon_data) {
                    if ($coupon_data->status == 'inactive') {
                        $msg = 'This Coupon code is inactivated now.';
                    }
//                    if ($coupon_data->expiration_date <= time()) {
//                        $this->session->set_flashdata('cart_coupon_messages', 'This Coupon code Got Expired Now.');
//                        redirect($_SERVER['HTTP_REFERER']);
//                        exit;
//                    }
                    $cart_data = $this->cart->getCartDetail();
                    if ($cart_data['sub_total'] < $coupon_data->minimum_order_amount) {
                        $msg = 'Your Amount Should be greater than ' . $coupon_data->minimum_order_amount;
                    }
                    $discount = 0;
                    if ($coupon_data->coupon_type == 'percentage') {
                        $coupon_percentage = $coupon_data->coupon_price;
                        $discount = ($cart_data['sub_total'] * ($coupon_data->coupon_price / 100));
                    } else if ($coupon_data->coupon_type == 'money') {
                        $coupon_percentage = 0.00;
                        $discount = $coupon_data->coupon_price;
                    }
                    $coupon_data = array(
                        'coupon_id' => $coupon_data->coupon_id,
                        'coupon_code' => $coupon_data->coupon_code,
                        'discount' => $discount,
                        'coupon_percentage' => $coupon_percentage,
                    );
                    $this->updateCartCost($coupon_data);
                    $output = array(
                        'cart_data' => $this->load->view($this->config->item('template') . '/cart', null, true),
                        'msg' => 'Congratulations! Your Coupon Code Has Been Applied Successfully.',
                    );
                    return $this->output
                                    ->set_header("HTTP/1.0 200 OK")
                                    ->set_content_type('application/json')
                                    ->set_output(json_encode($output));
                } else {
                    $msg = 'This Coupon Code Does not exist.';
                }
            } else {
                $msg = 'There is some Error with Form.';
            }
            $output = array(
                'msg' => $msg,
            );
            return $this->output
                            ->set_header("HTTP/1.0 200 OK")
                            ->set_content_type('application/json')
                            ->set_output(json_encode($output));
        }
    }

    public function updateCartCost($coupon_data = '', $tax_data = '') {
        $sub_total = $this->cart->getCartItemsTotal();
        $sub_total = $sub_total['total_product_price'];
        $cart_data = $this->cart->getCartDetail();

        // pr($cart_data);die;
        $discount = 0;
        $coupon_id = 0;
        $coupon_code = 0;
        $coupon_percentage = 0;

        if ($coupon_data) {
            $discount = $coupon_data['discount'];
            $coupon_id = $coupon_data['coupon_id'];
            $coupon_code = $coupon_data['coupon_code'];
            $coupon_percentage = $coupon_data['coupon_percentage'];
            //pr($coupon_percentage);
        } else
        if ($cart_data) {
            $discount = $cart_data['total_discount'];
            $coupon_id = $cart_data['coupon_id'];
            $coupon_code = $cart_data['coupon_code'];
            $coupon_percentage = $cart_data['coupon_percentage'];
        }

        $discounted_total = $sub_total - $discount;
        if ($tax_data) {
            $gst = number_format((($discounted_total * $tax_data['gst']) / 100), 2, '.', '');
            //    $pst = number_format((($discounted_total * $tax_data['pst']) / 100), 2, '.', '');
            //    $hst = number_format((($discounted_total * $tax_data['hst']) / 100), 2, '.', '');
            $gst_per = $tax_data['gst'];
            //    $pst_per = $tax_data['pst'];
            //    $hst_per = $tax_data['hst'];
        } else {
            $gst = number_format((($discounted_total * $cart_data['gst_per']) / 100), 2, '.', '');
            // $pst = number_format((($discounted_total * $cart_data['pst_per']) / 100), 2, '.', '');
            // $hst = number_format((($discounted_total * $cart_data['hst_per']) / 100), 2, '.', '');
            $gst_per = $cart_data['gst_per'];
            // $pst_per = $cart_data['pst_per'];
            //  $hst_per = $cart_data['hst_per'];
        }
        $total_cart_price = number_format(($discounted_total + $gst + $pst + $hst + 0), 2, '.', '');

        $data = array(
            'cart_id' => $cart_data['cart_id'],
            'session_id' => $this->session->userdata('my_session_id'),
            'customer_id' => $this->session->userdata('SofaByFancy_Sessions')['user_id'],
            'sub_total' => $sub_total,
            'gst_per' => $gst_per,
            //   'pst_per' => $pst_per,
            //   'hst_per' => $hst_per,
            'total_discount' => $discount,
            'coupon_id' => $coupon_id,
            'coupon_code' => $coupon_code,
            'coupon_per' => $coupon_percentage,
            'gst' => $gst,
            //   'pst' => $pst,
            //  'hst' => $hst,
            'delivery_charges' => 0,
            'total_cart_price' => $total_cart_price,
        );
        $this->cart->updateCart($data);
    }

    public function deleteCartItem($cart_item_id) {
        $countItem = $this->cart->countCartItem();
        $this->cart->deleteCartItemByCartItemId($cart_item_id);

        if ($countItem == 1) {
            $this->cart->destroy_cart(FALSE, 2);
        } else {
            $this->updateCartCost();
        }
        $this->session->set_flashdata('DeleteSuccess', 'Item Deleted Successfully');
        redirect('cart');
        exit;
    }

    public function deleteCart() {
        $this->cart->destroy_cart(1, FALSE);
        $this->session->set_flashdata('EmptySuccess', 'Cart Emptied Successfully .');
        redirect('cart');
        exit;
    }

    public function updateItemQuantity() {
        $product_quantity = $this->input->post('product_quantity');
        foreach ($product_quantity as $key => $value) {
            // pr($key);die;
            $cart_item_id = $key;
            $product_quantity = $value;

            $cart_item_data = $this->cart->getCartItemByAttributes(FALSE, FALSE, $cart_item_id);
            // pr($cart_item_data);die;
            $cartItems = array(
                'cart_item_id' => $cart_item_id,
                'product_quantity' => $product_quantity,
                'total_product_price' => $product_quantity * $cart_item_data['unit_product_price']
            );
            $this->cart->updateItemQuantity($cartItems);
            $this->updateCartCost();
        }
        $this->session->set_flashdata('QuantitySuccess', 'Quantity Updated Successfully .');
        redirect('cart');
        exit;
    }

    public function getProvinceList() {
        $country_id = $this->input->post('country_id');
        $data['province_list'] = $province_list = $this->common_model->getProvinceByCountry($country_id);
        // pr($data);die;
        $data['success'] = true;
        if (sizeof($province_list) == 0) {
            $data['success'] = false;
        }
        echo json_encode($data);
        die;
    }

}
