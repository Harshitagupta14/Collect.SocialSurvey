<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_Model extends CI_Model {

        var $tableName='tbl_post';  
        
    function getPostListById($postId) {        
        if ($postId != '')
            $this->db->where($this->tableName.'.post_id', $postId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }

    function getPostList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }
   
    
    function add($post_name) {        
                 
            $slug = $this->common_model->create_unique_slug_for_common($post_name,'tbl_post');
            $this->db->set('slug',$slug);  

        if($this->input->post('post_name'))
            $this->db->set('post_name', $this->input->post('post_name'));
            if($this->input->post('post_content'))
            $this->db->set('post_content', $this->input->post('post_content'));
            
         $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($postId){
            if($this->input->post('post_name'))
            $this->db->set('post_name', $this->input->post('post_name'));                
            if($this->input->post('post_content'))
            $this->db->set('post_content', $this->input->post('post_content'));
           
//            $this->db->set('status','active');             
//      
            $this->db->where('post_id',$postId);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
   
    
    public function updateStatus($postId,$status) {
        $this->db->set('status',$status);
        $this->db->where('post_id',$postId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($postId){        
        $this->db->where('post_id',$postId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
    
    public function getPostImageName($postId){
        $this->db->where('post_id',$postId); 
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
        
    }
}