<?php

class Product_Model extends CI_Model {

    var $tableProduct = 'tbl_products';
    var $tableProductTypes = 'tbl_product_types';
    var $tableProductImage = 'tbl_product_images';
    var $tableCategory = 'tbl_category';
    var $tableReview = 'tbl_product_reviews';

    public function getProductByArguments($catId = FALSE, $typeId = FALSE, $searchKeyword = FALSE, $per_page = FALSE, $currentpage = FALSE, $limit = FALSE) {
        $this->db->where('status', 'active');
        $this->db->where('city_id', $this->session->userdata('city'));
        if ($catId) {
            $this->db->where('category_id', $catId);
        }
        if ($typeId) {
            $this->db->where('prd_type_id', $typeId);
        }
        if ($searchKeyword) {
            $this->db->like('product_title', $searchKeyword);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($per_page || $currentpage) {
            $query = $this->db->get($this->tableProduct, $per_page, $currentpage);
        } else {
            $query = $this->db->get($this->tableProduct);
        }
//        echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }

    public function get_product_by_id($product_id) {
        $this->db->where('status', 'active');
        $this->db->where('product_id', $product_id);
        $this->db->where('city_id', $this->session->userdata('city'));
        $query = $this->db->get($this->tableProduct);
        $result = $query->result();
        return $result;
    }

    public function get_products_count($catId = FALSE, $typeId = FALSE) {
        $this->db->where('status', 'active');
        if ($catId) {
            $this->db->where('category_id', $catId);
        }
        if ($typeId) {
            $this->db->where('prd_type_id', $typeId);
        }
        $this->db->where('city_id', $this->session->userdata('city'));
        $query = $this->db->get($this->tableProduct);
        $result = $query->num_rows();
        return $result;
    }

    public function get_product_types($limit = FALSE) {
        $this->db->where('status', 'active');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get($this->tableProductTypes);
        $result = $query->result_array();
        return $result;
    }

    public function get_categories($parent_id = FALSE, $limit = FALSE) {
        $this->db->where('status', 'active');
        if ($parent_id !== FALSE) {
            $this->db->where('parent_id', $parent_id);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get($this->tableCategory);
        $result = $query->result_array();
        return $result;
    }

    public function get_product_image($product_id) {
        $this->db->where('status', 'active');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($this->tableProductImage);
        $result = $query->result_array();
        return $result;
    }

    public function get_product_featured_image($product_id) {
        $this->db->where('status', 'active');
        $this->db->where('product_id', $product_id);
        $this->db->where('is_featured', 'yes');
        $query = $this->db->get($this->tableProductImage);
        $result = $query->row();
        return $result;
    }

    public function get_similar_products($product_id, $group_number) {
        //pr($group_number);die;
        $this->db->where('status', 'active');
        $this->db->where('city_id', $this->session->userdata('city'));
        if ($product_id)
            $this->db->where('product_id !=', $product_id);
        if ($group_number)
            $this->db->where('group_number', $group_number);
        $query = $this->db->get($this->tableProduct);
        $result = $query->result_array();
        return $result;
    }

    public function add_review($product_id) {
        if ($product_id)
            $this->db->set('product_id', $product_id);
        if ($this->input->post('full_name'))
            $this->db->set('cust_full_name', $this->input->post('full_name'));
        if ($this->input->post('email'))
            $this->db->set('email', $this->input->post('email'));
        if ($this->input->post('subject'))
            $this->db->set('subject', $this->input->post('subject'));
        if ($this->input->post('review'))
            $this->db->set('review', $this->input->post('review'));
        $this->db->set('add_time', time());
        $this->db->insert($this->tableReview);
        $response = $this->db->insert_id();
        return $response;
    }

}
