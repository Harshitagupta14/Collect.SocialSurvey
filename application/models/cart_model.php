<?php

class Cart_Model extends CI_Model {

    var $tableCart = 'tbl_cart';
    var $tableCartItems = 'tbl_cart_items';
    var $tableProduct = 'tbl_products';
    var $tableCategory = 'tbl_category';

    // CART ITEMS FUNCTION //

    public function addCartItems($condition, $data) {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        if ($condition == $customer_id) {
            $this->db->set('customer_id', $condition);
            $this->db->set('session_id', 0);
        } else {
            $this->db->set('session_id', $condition);
        }
        $this->db->set('product_id', $data['product_id']);
        $this->db->set('category_name', $data['category_name']);
        $this->db->set('product_title', $data['product_title']);
        //$this->db->set('product_upc_code', $data['product_upc_code']);
        $this->db->set('product_code', $data['product_upc_code']);
        $this->db->set('product_image', $data['product_image']);
        $this->db->set('product_quantity', $data['product_quantity']);
        $this->db->set('product_description', $data['product_description']);
        $this->db->set('unit_product_price', $data['unit_price']);
        $this->db->set('total_product_price', $data['total_product_price']);
        $this->db->set('category_id', $data['category_id']);
        // pr($data);die;
        if ($data['cart_item_id']) {
            $this->db->where('cart_item_id', $data['cart_item_id']);
            $this->db->update($this->tableCartItems);
        } else {

            $this->db->insert($this->tableCartItems);
            $response = $this->db->insert_id();
            return $response;
        }
    }

    public function getCartItemByAttributes($prdId = FALSE, $prdColor = FALSE, $cart_item_id = FALSE) {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        if ($prdId) {
            $this->db->where('product_id', $prdId);
        }
        if ($prdColor) {
            $this->db->where('product_color', $prdColor);
        }
        if ($cart_item_id) {
            $this->db->where('cart_item_id', $cart_item_id);
        }
        $query = $this->db->get($this->tableCartItems);
        $result = $query->row_array();
        // pr($result);die;
        // echo $this->db->last_query();die;
        return $result;
    }

    public function getCartItemDetail() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        //pr($customer_id);die;
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $query = $this->db->get($this->tableCartItems);
        $result = $query->result_array();
        // pr($result);die;
        return $result;
    }

    public function getCartItemsTotal() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $this->db->select_sum('total_product_price');
        $query = $this->db->get($this->tableCartItems);
        $result = $query->row_array();
        return $result;
    }

    public function getProductDetail($product_id) {
        $this->db->select($this->tableProduct . '.*');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($this->tableProduct);
        $result = $query->row();
        return $result;
    }

    function deleteCartItemByCartItemId($cart_item_id) {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $this->db->where('cart_item_id', $cart_item_id);
        $query = $this->db->delete($this->tableCartItems);
        return 1;
    }

    function countCartItem() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $query = $this->db->get($this->tableCartItems);
        $nums = $query->num_rows();
        // pr("num".$nums);die;
        return $nums;
    }

    function updateItemQuantity($cartItems) {
        // pr($cartItems);die;
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        $this->db->set('product_quantity', $cartItems['product_quantity']);
        $this->db->set('total_product_price', $cartItems['total_product_price']);
        if ($cartItems['cart_item_id']) {
            $this->db->where('cart_item_id', $cartItems['cart_item_id']);

            if (isset($customer_id) && $customer_id != '') {
                $this->db->where('customer_id', $customer_id);
            } else {
                $this->db->where('session_id', $session_id);
            }
            $response = $this->db->update($this->tableCartItems);
        }
        return $response;
    }

    function destroy_cart($cart_items = FALSE, $cart = FALSE) {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        //pr($customer_id);die;
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        //pr($session_id);die;
        if ($cart_items == 1) {
            $tables = array($this->tableCartItems, $this->tableCart);
            $query = $this->db->delete($tables);
        }
        if ($cart == 2) {
            $query = $this->db->delete($this->tableCart);
        }
        // echo $this->db->last_query();die;
        return $query;
    }

    // CART FUNCTIONS //

    public function updateCart($data) {

        $customer_id = $data['customer_id'];
        //pr($customer_id);die;
        $session_id = $data['session_id'];
        if (isset($customer_id) && $customer_id != '') {
            $this->db->set('customer_id', $customer_id);
        } else {
            $this->db->set('session_id', $session_id);
        }

        if ($data['sub_total'])
            $this->db->set('sub_total', $data['sub_total']);
        if ($data['gst_per'])
            $this->db->set('gst_per', $data['gst_per']);
        if ($data['pst_per'])
            $this->db->set('pst_per', $data['pst_per']);
        if ($data['hst_per'])
            $this->db->set('hst_per', $data['hst_per']);
        $this->db->set('total_discount', $data['total_discount']);
        if ($data['gst'])
            $this->db->set('gst', $data['gst']);
        if ($data['pst'])
            $this->db->set('pst', $data['pst']);
        if ($data['hst'])
            $this->db->set('hst', $data['hst']);
        if ($data['coupon_id'])
            $this->db->set('coupon_id', $data['coupon_id']);
        if ($data['coupon_code'])
            $this->db->set('coupon_code', $data['coupon_code']);

        $this->db->set('coupon_per', $data['coupon_per']);
        $this->db->set('delivery_charges', $data['delivery_charges']);
        $this->db->set('total_cart_price', $data['total_cart_price']);

        //pr($data);
        if ($data['cart_id']) {
            $this->db->where('cart_id', $data['cart_id']);
            $this->db->update($this->tableCart);
        } else {

            $this->db->insert($this->tableCart);
            $response = $this->db->insert_id();
            echo $this->db->last_query();
            return $response;
        }
    }

    public function getCartDetail() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $query = $this->db->get($this->tableCart);
        $result = $query->row_array();
        //  pr($result);
        return $result;
    }

    public function delete($condition, $productId) {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');

        if ($condition == $customer_id) {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $this->db->where('product_id', $productId);
        $response = $this->db->delete($this->tableName);
        return $response;
    }

    function session_to_usercart($customer_id) {
        // pr($customer_id);
        $session_id = $this->session->userdata('my_session_id');
        $this->db->where('session_id', $session_id);
        $this->db->set('customer_id', $customer_id);
        $this->db->set('session_id', 0);
        $response = $this->db->update($this->tableCart);
        return $response;
    }

    function session_to_user_cartItems($customer_id) {
        $session_id = $this->session->userdata('my_session_id');
        $this->db->where('session_id', $session_id);
        $this->db->set('customer_id', $customer_id);
        $this->db->set('session_id', 0);

        $response = $this->db->update($this->tableCartItems);
        return $response;
    }

}

?>