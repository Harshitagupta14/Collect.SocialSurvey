<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website_Model extends CI_Model {

    var $tableName = 'tbl_website_settings';

    function website_list() {
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }

    function update($settingId, $logo, $favicon) {
       // pr($_POST);die;
        if ($this->input->post('site_email'))
            $this->db->set('site_email', $this->input->post('site_email'));
           if($this->input->post('paypal_email'))
            $this->db->set('paypal_email', $this->input->post('paypal_email'));
        if ($this->input->post('contact_no'))
            $this->db->set('contact_no', $this->input->post('contact_no'));
        if ($this->input->post('contact_address'))
            $this->db->set('contact_address', $this->input->post('contact_address'));        
            if($this->input->post('page_size_front'))
            $this->db->set('page_size_front', $this->input->post('page_size_front'));
        if ($this->input->post('facebook'))
            $this->db->set('facebook', $this->input->post('facebook'));
        if ($this->input->post('twitter'))
            $this->db->set('twitter', $this->input->post('twitter'));
        if ($this->input->post('google'))
            $this->db->set('google', $this->input->post('google'));
          if($this->input->post('youtube'))
            $this->db->set('youtube', $this->input->post('youtube'));
           if($this->input->post('linkedin'))
           $this->db->set('linkedin', $this->input->post('linkedin'));         
        if ($this->input->post('site_title'))
            $this->db->set('site_title', $this->input->post('site_title'));
        if ($this->input->post('meta_keywords'))
            $this->db->set('meta_keywords', $this->input->post('meta_keywords'));
        if ($this->input->post('meta_description'))
            $this->db->set('meta_description', $this->input->post('meta_description'));
           $this->db->set('google_indexing',$this->input->post('google_indexing')); 
           if($this->input->post('google_analytic_code'))
           $this->db->set('google_analytic_code', $this->input->post('google_analytic_code'));  
        if ($logo)
            $this->db->set('logo', $logo);
        if($favicon)
          $this->db->set('favicon', $favicon); 

        $this->db->set('status', 'yes');
        $this->db->set('updated_time', time());

        $this->db->where('website_id', $settingId);
        $query = $this->db->update($this->tableName);
        return $response;
    }

}
