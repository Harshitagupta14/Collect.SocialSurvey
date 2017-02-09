<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_Model extends CI_Model {

        var $tableName = 'tbl_blog';       
        var $tableBlogCategory = 'tbl_blog_category';       
   
    function getBlogList() {  
         $this->db->select($this->tableName.'.*,tbl_blog_category.bg_category_title');
        $this->db->from($this->tableName);        
        $this->db->join($this->tableBlogCategory, $this->tableName.'.category_id=tbl_blog_category.bg_cat_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    function getBlogListById($blogId) {  
        $this->db->where('blog_id',$blogId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
    
    function getBlogCategoryList() {
        $query = $this->db->get($this->tableBlogCategory);
        $result = $query->result_array();
        return $result;
    }    
   
    function add($blog_title,$blog_image) {
              if($blog_image)
            $this->db->set('blog_image', $blog_image);
              
            $slug = $this->common_model->create_unique_slug_for_common($blog_title,'tbl_blog');
            $this->db->set('slug',$slug);   
            
            if($this->input->post('blog_title'))
            $this->db->set('blog_title', $this->input->post('blog_title'));
            if($this->input->post('category_id'))
            $this->db->set('category_id',$this->input->post('category_id'));
            if($this->input->post('blog_description'))
            $this->db->set('blog_description', $this->input->post('blog_description')); 
            if($this->input->post('show_image'))
            $this->db->set('show_image', $this->input->post('show_image'));   
           // $this->db->set('added_by', $this->session->userdata('admin_user_name'));        
            //$this->db->set('blogger_id', $this->session->userdata('admin_id'));
            $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }   
 
    
     function update($blogId,$blog_image){
         
            if($blog_image)
            $this->db->set('blog_image', $blog_image); 
               
            if($this->input->post('blog_title'))
            $this->db->set('blog_title', $this->input->post('blog_title'));
            if($this->input->post('category_id'))
            $this->db->set('category_id',$this->input->post('category_id'));
            if($this->input->post('blog_description'))
            $this->db->set('blog_description', $this->input->post('blog_description'));
            if($this->input->post('show_image'))
            $this->db->set('show_image', $this->input->post('show_image'));   
            
            
            $this->db->set('update_time', time());   
            $this->db->where('blog_id',$blogId);    
            $query = $this->db->update($this->tableName);
            return $response;       
    }  
    
    public function updateStatus($blogId,$action) {       
   
        $this->db->set('status',$action);
        $this->db->where('blog_id',$blogId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($blogId){        
        $this->db->where('blog_id',$blogId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }   
    
   
}
