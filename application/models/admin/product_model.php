<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_Model extends CI_Model {

    var $tableName = 'tbl_products';
    var $tableCategory = 'tbl_category';
    var $tableProducttype = 'tbl_product_types';
    var $tableReview = 'tbl_product_reviews';

    function getProductList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }

    function getProductListById($prdId) {
        $this->db->where('product_id', $prdId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }

    function getProductCategory($catId) {
        $this->db->select('category_name');
        $this->db->where('category_id', $catId);
        $query = $this->db->get($this->tableCategory);
        $result = $query->row();
        return $result;
    }

    function getProductReviewByProductId($product_id) {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($this->tableReview);
        $result = $query->result_array();
        return $result;
    }

    function getProductReviewByReviewId($review_id) {
        $this->db->where('review_id', $review_id);
        $query = $this->db->get($this->tableReview);
        $result = $query->row_array();
        return $result;
    }

    public function updateReadStatus($review_id, $status) {
        $this->db->set('read_status', $status);
        $this->db->where('review_id', $review_id);
        $response = $this->db->update($this->tableReview);
        return $response;
    }

    function getProductSubCategory($catId) {
        $this->db->select('category_name');
        $this->db->where('category_id', $catId);
        $query = $this->db->get($this->tableCategory);
        $result = $query->row();
        return $result;
    }

    function getProductType($product_type_Id) {
        if ($product_type_Id != '')
            $this->db->where($this->tableProducttype . '.prd_type_id', $product_type_Id);
        $query = $this->db->get($this->tableProducttype);
        $result = $query->row();
        return $result;
    }

    function getCategoryList() {
        $this->db->where('parent_id', 0);
        $query = $this->db->get($this->tableCategory);
        $result = $query->result_array();
        return $result;
    }

    function getProductTypesList() {
        $query = $this->db->get($this->tableProducttype);
        $result = $query->result_array();
        return $result;
    }

    function getSubCategoryByCategory($catId) {
        $this->db->where('parent_id', $catId);
        $query = $this->db->get($this->tableCategory);
        $result = $query->result_array();
        return $result;
    }

    function add($product_title) {
        $slug = $this->common_model->create_unique_slug_for_common($product_title, 'tbl_product_types');
        $this->db->set('slug', $slug);
        if ($product_title)
            $this->db->set('product_title', $product_title);
        $this->db->set('category_id', $this->input->post('category_id'));
        $this->db->set('city_id', $this->input->post('city_id'));
        $this->db->set('prd_type_id', $this->input->post('prd_type_id'));
        $this->db->set('group_number', $this->input->post('group_number'));
        //$this->db->set('product_color', $this->input->post('product_color'));
        // $this->db->set('product_size', $this->input->post('product_size'));
        $this->db->set('meta_title', $this->input->post('meta_title'));
        $this->db->set('meta_keyword', $this->input->post('meta_keyword'));
        $this->db->set('meta_description', $this->input->post('meta_description'));
        $this->db->set('product_mrp', $this->input->post('product_mrp'));
        $this->db->set('product_discount', $this->input->post('product_discount'));
        $this->db->set('product_price', $this->input->post('product_price'));
        $this->db->set('product_upc_code', $this->input->post('product_upc_code'));
        $this->db->set('product_code', $this->input->post('product_code'));
        $this->db->set('product_description', $this->input->post('product_description'));
        $this->db->set('product_small_description', $this->input->post('product_small_description'));
        $this->db->set('product_specifications', $this->input->post('product_specifications'));
        $this->db->set('is_new', $this->input->post('is_new'));
        $this->db->set('status', 'active');
        $this->db->set('add_time', time());
        $query = $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $response;
    }

    function update($product_id) {
        if ($this->input->post('product_title'))
            $this->db->set('product_title', $this->input->post('product_title'));
        $this->db->set('category_id', $this->input->post('category_id'));
        $this->db->set('category_id', $this->input->post('category_id'));
        $this->db->set('city_id', $this->input->post('city_id'));
        $this->db->set('prd_type_id', $this->input->post('prd_type_id'));
        $this->db->set('group_number', $this->input->post('group_number'));
        // $this->db->set('product_color', $this->input->post('product_color'));
        //$this->db->set('product_size', $this->input->post('product_size'));
        $this->db->set('meta_title', $this->input->post('meta_title'));
        $this->db->set('meta_keyword', $this->input->post('meta_keyword'));
        $this->db->set('meta_description', $this->input->post('meta_description'));
        $this->db->set('product_mrp', $this->input->post('product_mrp'));
        $this->db->set('product_discount', $this->input->post('product_discount'));
        $this->db->set('product_price', $this->input->post('product_price'));
        $this->db->set('product_upc_code', $this->input->post('product_upc_code'));
        $this->db->set('product_code', $this->input->post('product_code'));
        $this->db->set('product_description', $this->input->post('product_description'));
        $this->db->set('product_small_description', $this->input->post('product_small_description'));
        $this->db->set('product_specifications', $this->input->post('product_specifications'));
        $this->db->set('is_new', $this->input->post('is_new'));
        $this->db->set('status', 'active');
        $this->db->set('update_time', time());
        $this->db->where('product_id', $product_id);
        $query = $this->db->update($this->tableName);
        return $response;
    }

    public function updateStatus($product_Id, $status) {
        $this->db->set('status', $status);
        $this->db->where('product_id', $product_Id);
        $response = $this->db->update($this->tableName);
        return $response;
    }

    public function delete($product_Id) {
        $this->db->where('product_id', $product_Id);
        $response = $this->db->delete($this->tableName);
        return $response;
    }

    public function updateStatus_Review($review_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('review_id', $review_id);
        $response = $this->db->update($this->tableReview);
        return $response;
    }

    public function delete_Review($review_id) {
        $this->db->where('review_id', $review_id);
        $response = $this->db->delete($this->tableReview);
        return $response;
    }

}
