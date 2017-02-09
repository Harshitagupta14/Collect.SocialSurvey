<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metatag_Model extends CI_Model {

        var $tableName='tbl_metatag';  
        
    function getMetatagList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }    
        
    function getMetatagListById($metatagId) {        
        if ($metatagId != '')
            $this->db->where($this->tableName.'.meta_id', $metatagId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
    function add() {        
             
        if($this->input->post('meta_title'))
            $this->db->set('metatag_title', $this->input->post('meta_title'));
        
         if($this->input->post('meta_description'))
            $this->db->set('metatag_description', $this->input->post('meta_description')); 
          if($this->input->post('url'))
            $this->db->set('metatag_url', $this->input->post('url')); 
            
          $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($metatagId){
            
            
             if($this->input->post('meta_title'))
            $this->db->set('metatag_title', $this->input->post('meta_title'));
        
         if($this->input->post('meta_description'))
            $this->db->set('metatag_description', $this->input->post('meta_description')); 
          if($this->input->post('url'))
            $this->db->set('metatag_url', $this->input->post('url'));        
      
            $this->db->where('meta_id',$metatagId);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
   
    
    public function updateStatus($metatagId,$status) {
        $this->db->set('status',$status);
        $this->db->where('meta_id',$metatagId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($metatagId){        
        $this->db->where('meta_id',$metatagId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
    
    
        
    }
