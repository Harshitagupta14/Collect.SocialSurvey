<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_Comment_Model extends CI_Model {

       var $tableName='tbl_blog_comment';       
       
    function getBlogCommentList($blogId) {
        $this->db->where('blog_id', $blogId); 
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    } 
    
    public function updateStatus($commentId,$status)
    {        
        $this->db->set('status',$status);
        $this->db->where('bg_comment_id',$commentId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($commentId){        
        $this->db->where('bg_comment_id',$commentId);
        $response = $this->db->delete($this->tableName);
        return $response;        
        
    }  
}
