<?php

class Order_Model extends CI_Model {

    var $tableName = 'tbl_order';
    var $tableOrderItem = 'tbl_order_item';

    #============================== Get Page Record By Page ID ===========================================================#

    public function addConfirmedOrder($cart_data) {
        $user_data = $this->flexi_auth->get_user_by_identity_row_array();
        $customer_id = $user_data['uacc_id'];
        if ($customer_id)
            $this->db->set('customer_id', $customer_id);
        
        
        if ($cart_data['sub_total'])
            $this->db->set('sub_total', $cart_data['sub_total']);
        if ($cart_data['gst_per'])
            $this->db->set('gst_per', $cart_data['gst_per']);
        if ($cart_data['pst_per'])
            $this->db->set('pst_per', $cart_data['pst_per']);
        if ($cart_data['hst_per'])
            $this->db->set('hst_per', $cart_data['hst_per']);
        if($cart_data['total_discount'])
            $this->db->set('discount', $cart_data['total_discount']);
        if ($cart_data['gst'])
            $this->db->set('gst', $cart_data['gst']);
        if ($cart_data['pst'])
            $this->db->set('pst', $cart_data['pst']);
        if ($cart_data['hst'])
            $this->db->set('hst', $cart_data['hst']);
        if ($cart_data['coupon_id'])
            $this->db->set('coupon_id', $cart_data['coupon_id']);
        if ($cart_data['coupon_code'])
            $this->db->set('coupon_code', $cart_data['coupon_code']);
        if ($cart_data['coupon_per'])
            $this->db->set('coupon_percentage', $cart_data['coupon_per']);
         if ($cart_data['total_cart_price'])
            $this->db->set('total_amount', $cart_data['total_cart_price']);
       
            $this->db->set('client_ip', $_SERVER['REMOTE_ADDR']);
        
        
        if ($this->session->userdata($this->session->userdata('my_session_id'))['email_id'])
            $this->db->set('email_id', $this->session->userdata($this->session->userdata('my_session_id'))['email_id']);
        if ($this->session->userdata($this->session->userdata('my_session_id'))['first_name'])
            $this->db->set('first_name', $this->session->userdata($this->session->userdata('my_session_id'))['first_name']);
        if ( $this->session->userdata($this->session->userdata('my_session_id'))['last_name'])
            $this->db->set('last_name', $this->session->userdata($this->session->userdata('my_session_id'))['last_name']);
        if ($this->session->userdata($this->session->userdata('my_session_id'))['contact_no'])
            $this->db->set('contact_no', $this->session->userdata($this->session->userdata('my_session_id'))['contact_no']);
        
        if($this->session->userdata($this->session->userdata('my_session_id'))['address'])
           $this->db->set('address', $this->session->userdata($this->session->userdata('my_session_id'))['address']);
        
        if ($this->session->userdata($this->session->userdata('my_session_id'))['city'])
            $this->db->set('city', $this->session->userdata($this->session->userdata('my_session_id'))['city']);
        if ($this->session->userdata($this->session->userdata('my_session_id'))['province_name'])
            $this->db->set('province_name',  $this->session->userdata($this->session->userdata('my_session_id'))['province_name']);
        if ($this->session->userdata($this->session->userdata('my_session_id'))['postal_code'])
            $this->db->set('postal_code',  $this->session->userdata($this->session->userdata('my_session_id'))['postal_code']);
       
        $this->db->set('add_time', time());
       
           $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $response;
        }
        

    
    public function addOrderItems($order_id, $cart_items){
        
        $this->db->set('order_id', $order_id); 
        if($cart_items['product_id'])
        $this->db->set('product_id', $cart_items['product_id']);
        if($cart_items['category_name'])
        $this->db->set('category_name', $cart_items['category_name']);
        if($cart_items['product_title'])
        $this->db->set('product_title', $cart_items['product_title']);
        if($cart_items['product_upc_code'])
        $this->db->set('product_upc_code', $cart_items['product_upc_code']);
        if($cart_items['product_code'])
        $this->db->set('product_code', $cart_items['product_code']);
        if($cart_items['product_size'])
        $this->db->set('product_size', $cart_items['product_size']);
        if($cart_items['product_color'])
        $this->db->set('product_color', $cart_items['product_color']);
         if($cart_items['product_image'])
        $this->db->set('product_image', $cart_items['product_image']);
        if($cart_items['product_quantity'])
        $this->db->set('product_quantity', $cart_items['product_quantity']);
        if($cart_items['unit_product_price'])
        $this->db->set('unit_product_price', $cart_items['unit_product_price']);
        if($cart_items['total_product_price'])
        $this->db->set('total_product_price', $cart_items['total_product_price']);
        if($cart_items['category_id'])
        $this->db->set('category_id', $cart_items['category_id']);
        // pr($cart_data);die;

            $this->db->insert($this->tableOrderItem);
            $response = $this->db->insert_id();
            return $response;
        }
 
    
    public function getOrderDetail() {
        $customer_id = $this->session->userdata('customer_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } 
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        //pr($result);die;
        return $result;
    }
    
    public function getOrderDetailById($order_id){
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        //pr($result);die;
        return $result;
        
    }
    
    public function getOrderItems($order_id){
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->tableOrderItem);
        $result = $query->result();
        //pr($result);die;
        return $result;
    }
    
    
    public function getOrderIdByCustomerId($customer_id){
         $this->db->where('customer_id', $customer_id);
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }
    
    
    



}

?>
