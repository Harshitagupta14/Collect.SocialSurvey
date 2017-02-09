<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor_Product_Model extends CI_Model {

    var $tableName = 'tbl_products';
    var $tableCategory = 'tbl_category';
    var $tableProducttype = 'tbl_product_types';
    var $tableReview = 'tbl_product_reviews';
    var $tableVendorProduct = 'tbl_vendor_products';

    function getProductList() {
        $this->db->where('status', 'active');
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }

    function getVendorProductById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->tableVendorProduct);
        $result = $query->row_array();
        return $result;
    }

    function getVendorProductListByVendorId($vendor_id) {
        $this->db->select('tp.*,tp.product_quantity as main_quantity,tvp.*');
        $this->db->where('tvp.user_id', $vendor_id);
        $this->db->join('tbl_products tp', ' tp.product_id = tvp.prd_id_fk ', 'left');
        $this->db->order_by('tp.product_id', 'DESC');
        $result = $this->db->get('tbl_vendor_products tvp')->result_array();
        return $result;
    }

    function getVendorProductCategory($catId) {
        $this->db->select('category_name');
        $this->db->where('category_id', $catId);
        $query = $this->db->get($this->tableCategory);
        $result = $query->row();
        return $result;
    }

    function getVendorProductReviewByProductId($product_id) {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($this->tableReview);
        $result = $query->result_array();
        return $result;
    }

    function getVendorProductReviewByReviewId($review_id) {
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

    function getVendorProductSubCategory($catId) {
        $this->db->select('category_name');
        $this->db->where('category_id', $catId);
        $query = $this->db->get($this->tableCategory);
        $result = $query->row();
        return $result;
    }

    function getVendorProductType($product_type_Id) {
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

    function getVendorProductTypesList() {
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

    public function addVendorProduct($data) {
        $this->db->set('prd_id_fk', $data['prd_id_fk']);
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('product_vendor_quantity', $data['product_quantity']);
        // pr($data);die;

        $this->db->insert($this->tableVendorProduct);
        $response = $this->db->insert_id();
        return $response;
    }

    public function editVendorProduct($data) {
        $this->db->set('product_vendor_quantity', $data['product_quantity']);
        $this->db->where('id', $data['id']);
        $this->db->update($this->tableVendorProduct);
        return $response;
    }

    public function updateMainProductQuantity($data) {
        $product_quantity_main = $this->common_model->getSingleFieldFromAnyTable('product_quantity', 'product_id', $data['prd_id_fk'], $this->tableName);
        $product_quantity_vendor_old = $this->common_model->getSingleFieldFromAnyTable('product_vendor_quantity', 'id', $data['id'], $this->tableVendorProduct);
        if ($product_quantity_vendor_old != '') {
            if ($data['product_quantity'] < $product_quantity_vendor_old) {
                $new_quantity = $product_quantity_vendor_old - $data['product_quantity'];
                $new_quantity = $product_quantity_main + $new_quantity;
            } else {
                $new_quantity = $data['product_quantity'] - $product_quantity_vendor_old;
                $new_quantity = $product_quantity_main - $new_quantity;
            }
        } else {
            $new_quantity = $product_quantity_main - $data['product_quantity'];
        }
        $this->db->set('product_quantity', $new_quantity);
        $this->db->where('product_id', $data['prd_id_fk']);
        $response = $this->db->update($this->tableName);
    }

    public function deleteVendorProduct($id) {
        $this->db->where('id', $id);
        $response = $this->db->delete($this->tableVendorProduct);
        return $response;
    }

}
