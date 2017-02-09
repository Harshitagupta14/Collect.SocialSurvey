<?php

class Content_Model extends CI_Model {

    var $tableName = 'tbl_page';
    var $tablePost = 'tbl_post'; 
    #============================== Get Page Record By Page ID ===========================================================#

    public function getContentRecordByAttributes($content_id =FALSE,$content_slug =FALSE ) {
        $this->db->where($this->tableName . '.status', 'active');
        if($content_id){
        $this->db->where($this->tableName . '.page_id', $content_id);
        }
        if($content_slug){
         $this->db->where($this->tableName . '.slug', $content_slug);
        }
         $query = $this->db->get($this->tableName);
        $result = $query->row();
        return $result;
    }
    
     public function getPostRecordByAttributes($post_id = FALSE ,$post_slug = FALSE) {
        $this->db->where($this->tablePost . '.status', 'active');
        if($post_id){
        $this->db->where($this->tablePost . '.post_id', $post_id);
        }
        if($post_slug){
        $this->db->where($this->tablePost . '.slug', $post_slug);
        }
        $query = $this->db->get($this->tablePost);
        $result = $query->row();
        return $result;
    }
    
}

?>
