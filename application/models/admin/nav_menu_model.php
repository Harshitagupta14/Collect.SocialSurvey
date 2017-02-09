<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nav_Menu_Model extends CI_Model {

    var $tableName = 'tbl_nav_menu';
    var $tableGroup = 'tbl_nav_groups';

 
    function nav_menu_record(){
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();
        return $result;
    }  
    
    function nav_groups(){
        $query = $this->db->get($this->tableGroup);
        $result = $query->result_array();
        return $result;
    }
    
    function nav_menu_record_by_id($header_linkId) {        
        if ($header_linkId != '')
            $this->db->where($this->tableName.'.nav_menu_id', $header_linkId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }

    function add_nav_menu() {  
        $this->db->set('nav_title',$this->input->post('nav_title'));
        $this->db->set('nav_url', $this->input->post('nav_url'));
        $this->db->set('nav_position', $this->input->post('nav_position'));
        $this->db->set('nav_target', $this->input->post('nav_target'));
//        $this->db->set('is_parent', $this->input->post('is_parent'));
        $this->db->set('group_id_fk', $this->input->post('menu_group_id'));
//      $this->db->set('target', $this->input->post('target'));
        $this->db->set('status', 'active');    
        $query = $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $response;
    }
  
    function update_nav_menu($navMenuId) {
 
        $this->db->set('nav_title',$this->input->post('nav_title'));
        $this->db->set('nav_url', $this->input->post('nav_url'));
        $this->db->set('nav_position', $this->input->post('nav_position'));
        $this->db->set('nav_target', $this->input->post('nav_target'));
        $this->db->set('group_id_fk', $this->input->post('menu_group_id'));
        $this->db->where('nav_menu_id', $navMenuId);
        $response = $this->db->update($this->tableName);
        return $response;
    }
    
    function update_nav_menu_lang($navMenuId) {
        $this->delete_lang_record($navMenuId);
        $this->add_nav_menu_lang($navMenuId);
    }
  
    function update_status($navMenuId, $status) {
        $this->db->set('status', $status);
        $this->db->where('nav_menu_id', $navMenuId);
        $response = $this->db->update($this->tableName);
        return $response;
    }
    
    function delete_nav_menu($navMenuId) {
        $this->db->where('nav_menu_id', $navMenuId);
        $response = $this->db->delete($this->tableName);
        return $response;
    }

    public function delete_lang_record($navMenuId) {
        $this->db->where('nav_id_fk', $navMenuId);
        $response = $this->db->delete($this->tableNameLang);
        return $response;
    }

}
