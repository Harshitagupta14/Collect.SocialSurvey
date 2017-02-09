<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_Category_Model extends CI_Model {

        var $tableName='tbl_blog_category';
       
   
    function getBlogCategoryList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }  
    
    function getBlogCategoryById($catId) {
        $this->db->where('bg_cat_id', $catId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
   
    function add($blog_cat_name) {        
              
            $slug = $this->common_model->create_unique_slug_for_common($blog_cat_name,'tbl_blog_category');
            $this->db->set('slug',$slug);  
        
            if($this->input->post('bg_category_title'))
            $this->db->set('bg_category_title', $this->input->post('bg_category_title'));
            if($this->input->post('bg_category_description'))
            $this->db->set('bg_category_description', $this->input->post('bg_category_description'));
            if($this->input->post('bg_meta_title'))
            $this->db->set('bg_meta_title', $this->input->post('bg_meta_title'));          
            if($this->input->post('bg_meta_keywords'))
            $this->db->set('bg_meta_keywords', $this->input->post('bg_meta_keywords'));
            if($this->input->post('bg_meta_description'))
            $this->db->set('bg_meta_description', $this->input->post('bg_meta_description'));
         
            $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    
     function update($catId){ 
         
             if($this->input->post('bg_category_title'))
            $this->db->set('bg_category_title', $this->input->post('bg_category_title'));
            if($this->input->post('bg_category_description'))
            $this->db->set('bg_category_description', $this->input->post('bg_category_description'));
            if($this->input->post('bg_meta_title'))
            $this->db->set('bg_meta_title', $this->input->post('bg_meta_title'));          
            if($this->input->post('bg_meta_keywords'))
            $this->db->set('bg_meta_keywords', $this->input->post('bg_meta_keywords'));
            if($this->input->post('bg_meta_description'))
            $this->db->set('bg_meta_description', $this->input->post('bg_meta_description'));
            
            $this->db->where('bg_cat_id',$catId);
            $query = $this->db->update($this->tableName);
            return $response;       
    }      
  
    
    public function updateStatus($catId,$status) {       
   
        $this->db->set('status',$status);
        $this->db->where('bg_cat_id',$catId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($catId){        
        $this->db->where('bg_cat_id',$catId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }    
}
