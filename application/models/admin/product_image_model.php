<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_Image_Model extends CI_Model {
        
        var $tableImage = 'tbl_product_images';
        var $tableProduct='tbl_products';
        var $tableCategory='tbl_category'; 
        var $tableProducttype = 'tbl_product_types';
        
    function getProductImageListByProductId($product_id) {
        $this->db->where('product_id',$product_id);
        $query = $this->db->get($this->tableImage);
        $result = $query->result_array();
        return $result;
    }  
    
    function getProductImageByImageId($product_image_id){
        $this->db->where('product_image_id',$product_image_id);
        $query = $this->db->get($this->tableImage);
        $result = $query->row();
      
        return $result;   
    }
    
    function addProductImagesSpecifications($product_id) {
       
        //$update_details = $this->input->post('update_details');
        $product_image_id = $this->input->post('product_image_id');
        $is_featured = $this->input->post('is_featured');
            $image_color = $this->input->post('image_color');
        $status = $this->input->post('status');
        $seq_number = $this->input->post('seq_number');
       // $alttext = $this->input->post('alttext');
        foreach ($product_image_id as $key => $value) {
          //  pr($update_details);die;
            $this->db->set('product_id', $product_id);
           // $this->db->set('is_featured', $is_featured[$key]);
            $this->db->set('image_color', $image_color[$key]);
            $this->db->set('status', $status[$key]);
       //     $this->db->set('is_deleted', $is_deleted[$key]);
            $this->db->set('seq_number', $seq_number[$key]);
          //  $this->db->set('alttext', $alttext[$key]);
            if ($is_featured == $value) {
                $this->db->set('is_featured', 'yes');
            } else {
                $this->db->set('is_featured', 'no');
            }
            if ($value != '') 
               // pr($value);die;
                $this->db->where('product_image_id', $value);
               // $this->db->set('update_time', time());
               $query = $this->db->update($this->tableImage);
            }
               return $query;
        }
     
    
    
    
    function update($product_image_id,$product_image){
        
           $this->db->set('image_color', $this->input->post('image_color'));
           $this->db->set('seq_number', $this->input->post('seq_number'));
           $this->db->set('is_featured', $this->input->post('is_featured'));      
         if($product_image)
           $this->db->set('image_name', $product_image);                  
            $this->db->set('status','active');  
            $this->db->where('product_image_id',$product_image_id);
            $query = $this->db->update($this->tableImage);
            return $query;       
    } 
   
    public function delete($product_image_id){        
        $this->db->where('product_image_id',$product_image_id);
        $response = $this->db->delete($this->tableImage);
        return $response; 
    }
    
    function getMaxSeqenceNo($product_id) {
        $this->db->select_max('seq_number');
        $this->db->from($this->tableImage);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
     function addProductImage($product_id, $image_name) {
       // $product_name = $this->common_model->getSingleFieldFromAnyTable('product_name', 'p_id', $product_id, 'tbl_products');
       //  pr($product_id);die;
        $this->db->set('product_id', $product_id);
        $this->db->set('image_name', $image_name);
       // $this->db->set('alttext', $product_name);
        $maxSequenceNo = $this->getMaxSeqenceNo($product_id);
        $piseqnum = $maxSequenceNo->seq_number;
        $nextSeqncNo = $piseqnum + 1;
        $this->db->set('seq_number', $nextSeqncNo);
        $this->db->set('add_time', time());
        $query = $this->db->insert($this->tableImage);
        $response = $this->db->insert_id();
        return $response;
    }

    
    
    }
    