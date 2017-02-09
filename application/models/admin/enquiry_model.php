<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enquiry_Model extends CI_Model {

       var $tableName='tbl_contact_us';
       
  
    function getEnquiryList() {  
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }
    
    function viewContactById($enquiryId) { 
        $this->db->where('client_id', $enquiryId);         
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }
    
    public function updateReadStatus($enquiryId,$status)
    {        
      //  pr($enquiryId);die;
        $this->db->set('read_status',$status);
        $this->db->where('client_id',$enquiryId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($enquiryId){        
        $this->db->where('client_id',$enquiryId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }
}
