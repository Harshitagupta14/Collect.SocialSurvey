<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Province_Model extends CI_Model {

    var $tableName = 'tbl_province';
    var $tableCountry = 'tbl_country';

    function getProvinceList() {
        $this->db->select($this->tableName.'.*,tbl_country.country_name');
        $this->db->join($this->tableCountry,$this->tableCountry.'.ct_id=tbl_province.country_id');
        $query = $this->db->get($this->tableName);
        //echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }
   
    
    function getProvinceListById($provinceId) {             
        $this->db->where('province_id', $provinceId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }
    
    function getCountryList() {  
        $query = $this->db->get($this->tableCountry);
        
        $result = $query->result_array();
        return $result;
    }    

    function add($province_name) {       
       
        if ($this->input->post('province_name'))
            $this->db->set('province_name', $this->input->post('province_name'));
        if ($this->input->post('country_id'))
            $this->db->set('country_id', $this->input->post('country_id')); 
        if ($this->input->post('gst'))
            $this->db->set('gst', $this->input->post('gst')); 
        if ($this->input->post('pst'))
            $this->db->set('pst', $this->input->post('pst')); 
        if ($this->input->post('hst'))
            $this->db->set('hst', $this->input->post('hst')); 
         
        $this->db->set('status', 'active');

        $query = $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $response;
    }

    function update($provinceId) {
        if ($this->input->post('province_name'))
            $this->db->set('province_name', $this->input->post('province_name'));
        if ($this->input->post('country_id'))
            $this->db->set('country_id', $this->input->post('country_id')); 
         if ($this->input->post('gst'))
            $this->db->set('gst', $this->input->post('gst')); 
        if ($this->input->post('pst'))
            $this->db->set('pst', $this->input->post('pst')); 
        if ($this->input->post('hst'))
            $this->db->set('hst', $this->input->post('hst')); 
         
        $this->db->set('status', 'active');
        $this->db->where('province_id', $provinceId);

        $query = $this->db->update($this->tableName);
        return $response;
    }

    public function updateStatus($provinceId, $action) {
        $this->db->set('status', $action);
        $this->db->where('province_id', $provinceId);
        $response = $this->db->update($this->tableName);
        return $response;
    }

    public function delete($provinceId) {
        $this->db->where('province_id', $provinceId);
        $response = $this->db->delete($this->tableName);
        return $response;
    }
    
    function getProvinceByCountry($country_id){                         
        $this->db->where('country_id',$country_id);
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    } 

}