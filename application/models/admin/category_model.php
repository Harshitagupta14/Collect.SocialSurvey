<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Model extends CI_Model {

        var $tableName = 'tbl_category';      

    
    function getCategoryList($categoryId) { 
        if($categoryId){
        $this->db->where('parent_id',$categoryId);
        }
        else{
         $this->db->where('parent_id','0');   
        }
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        //pr($result);die;
        return $result;
    }  
    
    function getCategoryById($categoryId) {  
        $this->db->where('category_id',$categoryId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    } 
    
    function getCategory($categoryId,$catId) {
        $this->db->where('category_id',$categoryId);
        $this->db->where('parent_id',$catId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    } 
    
    function add($categoryId,$category_name,$category_image) { 
        
            if($categoryId)
                 $this->db->set('parent_id',$categoryId);
            else
                 $this->db->set('parent_id','0');
            
            $slug = $this->common_model->create_unique_slug_for_common($category_name,'tbl_category');
            $this->db->set('slug',$slug);  
            if($this->input->post('category_name'))
            $this->db->set('category_name', $this->input->post('category_name'));
            if($this->input->post('category_description'))
            $this->db->set('category_description',$this->input->post('category_description'));

            $this->db->set('parent_id',$this->input->post('parent_id'));
           if($category_image)
               $this->db->set('category_image',$category_image);
            $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }   
     function update($categoryId,$category_image){         
            if($category_image)
            $this->db->set('category_image', $category_image);
            if($this->input->post('category_name'))
            $this->db->set('category_name', $this->input->post('category_name'));
            if($this->input->post('category_description'))
            $this->db->set('category_description',$this->input->post('category_description')); 
                
            $this->db->where('category_id',$categoryId);    
            $query = $this->db->update($this->tableName);
            return $query;       
    }  
    
    public function updateStatus($categoryId,$status) {       
   
        $this->db->set('status',$status);
        $this->db->where('category_id',$categoryId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($categoryId){        
        $this->db->where('category_id',$categoryId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    } 
}
