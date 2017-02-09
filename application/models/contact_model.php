<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_Model extends CI_Model {

    var $tableName = 'tbl_contact_us';

    function insertNewContact() {
            $this->db->set('full_name', $this->input->post('full_name'));
            $this->db->set('email_id', $this->input->post('email_id'));
            $this->db->set('subject', $this->input->post('subject'));
            $this->db->set('message', $this->input->post('message'));
        //$this->db->set('subscribe_mail', $this->input->post('subscribe_mail'));
        $this->db->set('read_status', 'unread');
        $this->db->set('add_time', time());
        $query = $this->db->insert($this->tableName);
        $response = $this->db->insert_id();
        return $this->db->insert_id();
    }

}
