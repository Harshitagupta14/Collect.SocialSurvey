<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_types_Model extends CI_Model {

        var $tableName='tbl_product_types';  
        
    function getProductTypesList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }    
    
    function getProductTypesListById($product_type_Id) {        
        if ($product_type_Id != '')
            $this->db->where($this->tableName.'.prd_type_id', $product_type_Id);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
    function add($prd_name) {
        
         $slug = $this->common_model->create_unique_slug_for_common($prd_name,'tbl_product_types');
            $this->db->set('slug',$slug); 
        if($this->input->post('prd_type_name'))
           $this->db->set('prd_type_name', $this->input->post('prd_type_name'));
            $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($product_type_Id){
         if($this->input->post('prd_type_name'))
           $this->db->set('prd_type_name', $this->input->post('prd_type_name'));
           $this->db->set('status','active');   
            $this->db->where('prd_type_id',$product_type_Id);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
     public function updateStatus($product_type_Id,$status) {
        $this->db->set('status',$status);
        $this->db->where('prd_type_id',$product_type_Id);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($product_type_Id){        
        $this->db->where('prd_type_id',$product_type_Id);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
    }
    