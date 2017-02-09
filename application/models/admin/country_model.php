<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_Model extends CI_Model {

    var $tableName = 'tbl_country';
    var $tableCity = 'tbl_city';

    function getCountryList() {
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }

    function getCityList() {
        $query = $this->db->get($this->tableCity);
        $result = $query->result_array();
        return $result;
    }

    function getCountryListById($countryId) {
        $this->db->where($this->tableName . '.ct_id', $countryId);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }

    function add() {

        if ($this->input->post('country_name'))
            $this->db->set('country_name', $this->input->post('country_name'));

        $this->db->set('status', 'active');

        $query = $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $response;
    }

    function update($countryId) {

        if ($this->input->post('country_name'))
            $this->db->set('country_name', $this->input->post('country_name'));

        $this->db->set('status', 'active');
        $this->db->where('ct_id', $countryId);

        $query = $this->db->update($this->tableName);
        return $response;
    }

    public function updateStatus($countryId, $status) {
        $this->db->set('status', $status);
        $this->db->where('ct_id', $countryId);
        $response = $this->db->update($this->tableName);
        return $response;
    }

    public function delete($countryId) {
        $this->db->where('ct_id', $countryId);
        $response = $this->db->delete($this->tableName);
        return $response;
    }

}
