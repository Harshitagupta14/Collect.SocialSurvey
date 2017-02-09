<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smtp_Model extends CI_Model {

        var $tableName='tbl_smtp_settings';  
        
    function getSmtpList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }    
    
    function getSmtpListById($SmtpId) {        
        if ($SmtpId != '')
            $this->db->where($this->tableName.'.smtp_id', $SmtpId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
    function add() {
        if($this->input->post('smtp_user'))
           $this->db->set('smtp_user', $this->input->post('smtp_user'));
        if($this->input->post('smtp_password'))
           $this->db->set('smtp_password', md5($this->input->post('smtp_password')));
        if($this->input->post('smtp_host'))
           $this->db->set('smtp_host', $this->input->post('smtp_host'));
         if($this->input->post('smtp_port'))
           $this->db->set('smtp_port', $this->input->post('smtp_port'));
            
        $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($smtpId){
         if($this->input->post('smtp_user'))
           $this->db->set('smtp_user', $this->input->post('smtp_user'));
        if($this->input->post('smtp_password'))
           $this->db->set('smtp_password', md5($this->input->post('smtp_password')));
        if($this->input->post('smtp_host'))
           $this->db->set('smtp_host', $this->input->post('smtp_host'));
         if($this->input->post('smtp_port'))
           $this->db->set('smtp_port', $this->input->post('smtp_port'));
          
           $this->db->where('smtp_id',$smtpId);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
     public function updateStatus($smtpId,$status) {
        $this->db->set('status',$status);
        $this->db->where('smtp_id',$smtpId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($smtpId){        
        $this->db->where('smtp_id',$smtpId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
    }
    