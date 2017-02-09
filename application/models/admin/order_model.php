<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_Model extends CI_Model {

    var $tableorder = 'tbl_order';
    var $table_order_item = 'tbl_order_item';

    function get_order_list() {
        $query = $this->db->get($this->tableorder);
        $result = $query->result_array();
        return $result;
    }

    function getOrderListById($order_id) {
        $this->db->where('order_id',$order_id);
        $query = $this->db->get($this->tableorder);
        $result = $query->row_array();
        return $result;
        
    }

    function getOrderItemListById($order_id) {
        $this->db->where('order_id',$order_id);
        $query = $this->db->get($this->table_order_item);
        $result = $query->result_array();
        return $result;
    }

    public function updateStatus($order_id, $status) {
        $this->db->set('order_status', $status);
        $this->db->where('order_id', $order_id);
        $response = $this->db->update($this->tableorder);
        return $response;
    }

    public function delete($order_id) {
        $this->db->where('order_id', $order_id);
        $response = $this->db->delete($this->tableorder);
        return $response;
    }

}