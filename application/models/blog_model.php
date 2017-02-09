<?php

class Blog_Model extends CI_Model {

    var $tableBlog = 'tbl_blog';
    var $tableBlogCategory = 'tbl_blog_category';
    var $tableComments = 'tbl_blog_comment';

    public function getBlogData(){
        
        $query = $this->db->get($this->tableBlog);
        $result = $query->result_array();
        //pr($result);die;
        return $result;
    }
    public function getBlogCategory() {
        $this->db->where($this->tableBlogCategory . '.status', 'active');
        $query = $this->db->get($this->tableBlogCategory);
        $result = $query->result_array();
        return $result;
    }

    public function getBlogList($catId) {
        $this->db->where($this->tableBlog . '.status', 'active');
        $this->db->where('category_id', $catId);
        $query = $this->db->get($this->tableBlog);
        $result = $query->result_array();
        return $result;
    }

    public function getBlogComments($blogId) {
        $this->db->where('blog_id', $blogId);
        //$this->db->where($this->tableBlog . '.status', 'active');
        $query = $this->db->get($this->tableComments);
        $result = $query->result_array();
        return $result;
    }
    
      
     function getBlogRecords($per_page, $currentpage) {
        $this->db->select('*');
        $this->db->where('status', 'active');
        $query = $this->db->get($this->tableBlog, $per_page, $currentpage);
        $result = $query->result_array();
        return $result;
    }

    public function addComment($blogId) {
        if ($this->input->post('full_name'))
            $this->db->set('full_name', $this->input->post('full_name'));
        if ($this->input->post('email'))
            $this->db->set('email', $this->input->post('email'));
        if ($this->input->post('phone'))
            $this->db->set('phone', $this->input->post('phone'));
        if ($this->input->post('comment'))
            $this->db->set('comment', $this->input->post('comment'));
        if ($blogId)
            $this->db->set('blog_id', $blogId);
        $this->db->set('status', 'active');
        $this->db->set('add_time', time());
        $query = $this->db->insert($this->tableComments);
        $response = $this->db->insert_id();
        return $response;
    }

}

?>
