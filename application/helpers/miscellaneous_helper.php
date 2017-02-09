<?php

/* * ***** Purpose : Function for use to print array in formatted way****** */

function pr($ary = array()) {
    echo '<pre>';
    print_r($ary);
    echo '</pre>';
}

/* * ***** Purpose : Function for use to print message in formatted way****** */

function show_message($message = null, $class = null) {
    return '<div class="alert alert-' . $class . ' display-hide" style="display: block;">			
				<button data-close="alert" class="close"></button>
				<span>' . $message . '</span></div>';
}

/* * ***** Purpose : Function for use to print message in formatted way****** */

function classifications_list() {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('classifications');
    $ci->db->where('status', 1);
    $query = $ci->db->get();
    $results = $query->result_array();

    $response = array();
    $response[''] = 'Select Classification';

    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['name'];
        }
    }
    return $response;
}

/* * ***** Purpose : Function for use to print message in formatted way****** */

function customer_list($selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('customer_type');
    $ci->db->where('is_active', '1');
    $ci->db->order_by('customer_type_id', 'asc');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Customer Type';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['customer_type_id']] = $result['customer_type_name'];
        }
    }
    return $response;
}

function customer_detail_list($selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('customers');
    $ci->db->where('account_status', '1');
    $ci->db->order_by('customer_id', 'asc');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Customer';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['customer_id']] = ucwords($result['first_name'] . ' ' . $result['last_name']);
        }
    }
    return $response;
}

function customer_company_list($selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('customers');
    $ci->db->where('account_status', '1');
    $ci->db->order_by('customer_id', 'asc');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Company';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['customer_id']] = $result['company_name'];
        }
    }
    return $response;
}

function countries_list($selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('countries');
    $ci->db->where('is_active', '1');
    $ci->db->order_by('country_name', 'asc');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Country';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['country_id']] = $result['country_name'];
        }
    }
    return $response;
}

function get_country_name($id) {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('countries');
    $ci->db->where('is_active', '1');
    $ci->db->where('country_id', $id);

    $query = $ci->db->get();
    $results = $query->result_array();
    if (isset($results[0]['country_name']))
        return $results[0]['country_name'];
}

function get_state_name($id) {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('states');
    $ci->db->where('is_active', '1');
    $ci->db->where('state_id', $id);

    $query = $ci->db->get();
    $results = $query->result_array();
    if (isset($results[0]['state_name']))
        return $results[0]['state_name'];
}

function get_city_name($id) {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('cities');
    $ci->db->where('is_active', '1');
    $ci->db->where('city_id', $id);
    $query = $ci->db->get();
    $results = $query->result_array();
    if (isset($results[0]['city_name']))
        return $results[0]['city_name'];
}

function state_list($selected = 'false') {

    if ($selected != '' && $selected != 0) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('states');
        $ci->db->where('is_active', '1');
        $ci->db->where('country_id', $selected);
        $ci->db->order_by('state_name', 'asc');
        $query = $ci->db->get();
        $results = $query->result_array();

        $response = array();
        $response[''] = 'Select State';
        if (!empty($results)) {
            foreach ($results as $result) {
                $response[$result['state_id']] = $result['state_name'];
            }
        }
    } else {
        $response[''] = "Select State";
    }
    return $response;
}

function city_list($selected = 'false') {
    if ($selected != '' && $selected != 0) {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('cities');
        $ci->db->where('is_active', '1');
        $ci->db->where('state_id', $selected);
        $ci->db->order_by('city_name', 'asc');
        $query = $ci->db->get();
        $results = $query->result_array();
        $response = array();
        $response[''] = 'Select City';
        if (!empty($results)) {
            foreach ($results as $result) {
                $response[$result['city_id']] = $result['city_name'];
            }
        }
    } else {
        $response[''] = "Select City";
    }
    return $response;
}

function warehouse_list($selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('warehouses');
    $ci->db->where('status', 1);
    $ci->db->order_by('id', 'asc');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    if ($selected == 'false')
        $response[''] = 'Select Warehouses';
    elseif ($selected == "all")
        $response[''] = 'All Warehouses';


    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['warehouse_name'];
        }
    }
    return $response;
}

function location_list($warehouseId = '0', $selected = 'false') {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('locations');
    $ci->db->where('status', 1);
    $ci->db->order_by('id', 'asc');
//    if($warehouseId!='0')
    $ci->db->where('warehouse_id', $warehouseId);
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    if ($selected == 'false') {
        $response[''] = 'Select Location';
    }

    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['location_name'];
        }
    }
    return $response;
}

function all_location_list($all = '') {

    if (strtolower($all) != "all") {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('locations');
        $ci->db->where('status', 1);
        $ci->db->order_by('id', 'asc');

        $query = $ci->db->get();
        $results = $query->result_array();
        $response = array();

        if (!empty($results)) {
            $response[''] = "Select Location";
            foreach ($results as $result) {
                $response[$result['id']] = $result['location_name'];
            }
        }
    } else {
        $response[''] = "All";
    }
    return $response;
}

function all_reason_list() {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('reasons');
    $ci->db->where('status', 1);

    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Reason';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['name'];
        }
    }
    return $response;
}

function add_reason_list() {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('reasons');
    $ci->db->where('status', 1);
    $ci->db->where('type', 1);
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Reason To Add';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['name'];
        }
    }
    return $response;
}

function remove_reason_list() {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('reasons');
    $ci->db->where('status', 1);
    $ci->db->where('type', 2);
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select Reason To Remove';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['name'];
        }
    }
    return $response;
}

function admin_users_list() {
    $ci = &get_instance();
    $ci->db->select('*');
    $ci->db->from('admin');
    $query = $ci->db->get();
    $results = $query->result_array();
    $response = array();
    $response[''] = 'Select User';
    if (!empty($results)) {
        foreach ($results as $result) {
            $response[$result['id']] = $result['username'];
        }
    }
    return $response;
}

function type_list() {
    return array("" => "Select User", "super" => "super", "normal" => "normal");
}

function classification_type_list() {
    return array("" => "Select Type", "product" => "Unique Identifier", "accessories" => "Without Unique Identifier");
}

function account_type_list() {
    return array("" => "Select Active/Inactive", "1" => "Active", "0" => "Inactive");
}

function shipped_list() {
    return array("2" => "All");
}

function reason_blank_list() {
    return array("" => "All");
}

function inventory_type_list() {
    return array("all" => "all", "add" => "Add", "remove" => "Remove", "shipped" => "Shipped");
}

function available_list() {
    return array("all" => "All", "available" => "Available", "no" => "Not Available");
}

function sales_list() {
    return array("" => "Select Sales Type", "Pending" => "Pending", "Ready To Ship" => "Ready To Ship", "Completed" => "Completed", "Cancelled" => "Cancelled", "Shipped: Unpaid" => "Shipped: Unpaid");
}

function convertTimeStamp($date) {
    $month = array("jan" => 1, "feb" => 2, "mar" => 3, "apr" => 4, "may" => 5, "jun" => 6, "jul" => 7, "aug" => 8, "sep" => 9, "oct" => 10, "nov" => 11, "dec" => 12);
    $parts = explode('-', $date);
    $parts[0] = $month[strtolower($parts[0])];
    return $timestamp = mktime(0, 0, 0, $parts[0], $parts[1], $parts[2]);
}

function convertTimeStamp2($date) {
    $month = array("jan" => 1, "feb" => 2, "mar" => 3, "apr" => 4, "may" => 5, "jun" => 6, "jul" => 7, "aug" => 8, "sep" => 9, "oct" => 10, "nov" => 11, "dec" => 12);
    $parts = explode('-', $date);
    $parts[0] = $month[strtolower($parts[0])];
    return $timestamp = mktime(23, 59, 59, $parts[0], $parts[1], $parts[2]);
}

function encode($key) {
    return base64_encode($key);
}

function decode($key) {
    return base64_decode($key);
}

function printingSize() {
    return array("Horizontal:3x1" => "-- Select a Layout --",
        "Horizontal:1x.5" => "Horizontal 1.5x0.5",
        "Horizontal:1.5x1" => "Horizontal 1.5x1",
        "Horizontal:2.25x0.75" => "Horizontal 2.25x0.75",
        "Horizontal:2.25x0.75:Small" => "Horizontal 2.25x0.75 (Small)",
        "Horizontal:3x1" => "Horizontal 3x1",
        "Horizontal:3x1" => "Horizontal 3x1 (Large Code)",
        "Horizontal:3x1" => "Horizontal 3x1 (Large SKU)",
        "Horizontal:3x2" => "Horizontal 3x2",
        "Horizontal:3x2:LargeCode" => "Horizontal 3x2 (Large Code)",
        "Horizontal:3x2:LargeSku" => "Horizontal 3x2 (Large SKU)",
        "Horizontal:4x2.5" => "Horizontal 4x2.5",
        "Horizontal:4x6" => "Horizontal 6x4",
        "Horizontal:6.75x1.6" => "Horizontal 6.75x1.6",
        "Horizontal:2.25x1.25" => "Horizontal 2.25x1.25",
        "Vertical:.5x1.5" => "Vertical 0.5x1.5",
        "Vertical:0.75x2.25" => "Vertical 0.75x2.25",
        "Vertical:0.75x2.25:Small" => "Vertical 0.75x2.25 (Small)",
        "Vertical:1x1.5" => "Vertical 1x1.5",
        "Vertical:1x3" => "Vertical 1x3",
        "Vertical:1x3:LargeCode" => "Vertical 1x3 (Large Code)",
        "Vertical:1x3:LargeSku" => "Vertical 1x3 (Large SKU)",
        "Vertical:2x3" => "Vertical 2x3",
        "Vertical:2x3:LargeCode" => "Vertical 2x3 (Large Code)",
        "Vertical:2x3:LargeSku" => "Vertical 2x3 (Large Sku)",
        "Vertical:4x2" => "Vertical 2.5x4",
        "Vertical:4x6" => "Vertical 4x6",
        "Vertical:1.6x6.75" => "Vertical 1.6x6.75",
        "Vertical:1.25x2.25" => "Vertical 1.25x2.25",
        "Horizontal:8.27x11.7" => "A4 (8.27 x 11.7)",
        "Vertical:8x11" => "8.5 x 11"
    );
}
