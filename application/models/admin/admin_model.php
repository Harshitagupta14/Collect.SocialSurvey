<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Model extends CI_Model {

       var $tableName='tbl_admin';  
   
    function getAdminRecords() { 
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }  
    
    function getAdminRecordById($adminId) { 
        $this->db->where('admin_id', $adminId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }  
   
    function add() {     
           
            if($this->input->post('username'))
            $this->db->set('admin_username', $this->input->post('username'));
            if($this->input->post('password'))
            $this->db->set('admin_password', md5($this->input->post('password')));
            if($this->input->post('phone'))
            $this->db->set('admin_phone', $this->input->post('phone'));
            if($this->input->post('email'))
            $this->db->set('admin_email', $this->input->post('email'));
         
            $this->db->set('status','active');  
            $this->db->set('add_time', time());

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    
    function update($adminId) {
           // pr($_POST);die;
            if($this->input->post('username'))
            $this->db->set('admin_username', ($this->input->post('username')));
            if($this->input->post('phone'))
            $this->db->set('admin_phone', $this->input->post('phone'));
            if($this->input->post('email'))
            $this->db->set('admin_email', $this->input->post('email'));
            $this->db->set('update_time', time());
            
            $this->db->where('admin_id',$adminId);
            $query = $this->db->update($this->tableName);
            return $response;            
    }
    
    function checkEmail($adminId){
        $this->db->where('admin_id',$adminId); 
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;  
    }
    
    public function updateStatus($adminId,$status) {       
   
         $this->db->set('status',$status);
         $this->db->where('admin_id',$adminId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function updatePassword() {  
        $this->db->set('password',$_POST['newpass']);
        $this->db->where('password',$_POST['pass']);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
     function countAllAdmin() {
        $this->db->where('status','active');
        $query = $this->db->get($this->tableName);         
        $result = $query->num_rows();
        return $result;
    } 
    
    public function getFileName($adminId){ 
        $this->db->where('admin_id',$adminId); 
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }
    
    public function delete($adminId){        
        $this->db->where('admin_id',$adminId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }
    
  
}
