<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

      class Page_Model extends CI_Model {

        var $tableName='tbl_page';  
        
    function getPageList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }    
        
    function getPageListById($pageId) {        
        if ($pageId != '')
            $this->db->where($this->tableName.'.page_id', $pageId);           
            $query = $this->db->get($this->tableName);
            $result = $query->row_array();
           return $result;
    }  
    function add($page_title) {        
           
        $slug = $this->common_model->create_unique_slug_for_common($page_title,'tbl_page');
            $this->db->set('slug',$slug);  
        if($this->input->post('page_title'))
            $this->db->set('page_title', $this->input->post('page_title'));
        
         if($this->input->post('page_heading'))
            $this->db->set('page_heading', $this->input->post('page_heading')); 
          if($this->input->post('page_content'))
            $this->db->set('page_content', $this->input->post('page_content')); 
            
          $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($pageId){
            
            
             if($this->input->post('page_title'))
            $this->db->set('page_title', $this->input->post('page_title'));
        
         if($this->input->post('page_heading'))
            $this->db->set('page_heading', $this->input->post('page_heading')); 
          if($this->input->post('page_content'))
            $this->db->set('page_content', $this->input->post('page_content'));        
      
            $this->db->where('page_id',$pageId);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
   
    
    public function updateStatus($pageId,$status) {
        $this->db->set('status',$status);
        $this->db->where('page_id',$pageId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($pageId){        
        $this->db->where('page_id',$pageId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
   }
