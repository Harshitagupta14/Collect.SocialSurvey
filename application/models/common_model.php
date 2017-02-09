<?php

class Common_Model extends CI_Model {

    var $tableCategory = 'tbl_category';
    var $tableBlog = 'tbl_blog';
    var $tableBlogCategory = 'tbl_blog_category';
    var $tableBanner = 'tbl_banner';
    var $tableSubscriber = 'tbl_subscriber';
    var $tableOrder = 'tbl_order';
    var $tableOrderItem = 'tbl_order_item';

    public function __construct() {
        global $URI, $CFG, $IN;
        $ci = get_instance();
        $ci->load->config('config');
        $websitelist = $this->getWebsiteList();
        $this->config->set_item('site_email', $websitelist['site_email']);
        $this->config->set_item('paypal_email', $websitelist['paypal_email']);
        $this->config->set_item('contact_address', $websitelist['contact_address']);
        $this->config->set_item('contact_no', $websitelist['contact_no']);
        $this->config->set_item('facebook', $websitelist['facebook']);
        $this->config->set_item('twitter', $websitelist['twitter']);
        $this->config->set_item('google', $websitelist['google']);
        $this->config->set_item('youtube', $websitelist['youtube']);
        $this->config->set_item('linkedin', $websitelist['linkedin']);
        $this->config->set_item('favicon', $websitelist['favicon']);
        $this->config->set_item('logo', $websitelist['logo']);
        $this->config->set_item('site_currency', $websitelist['site_currency']);
        $this->config->set_item('google_map', $websitelist['google_map']);
        $this->config->set_item('site_title', $websitelist['site_title']);
        $this->config->set_item('copyright', $websitelist['copyright']);
        $this->config->set_item('meta_keywords', $websitelist['meta_keywords']);
        $this->config->set_item('meta_description', $websitelist['meta_description']);
        if (!$this->session->userdata('my_session_id')) {
            $uniqueId = uniqid($this->input->ip_address(), TRUE);
            $this->session->set_userdata("my_session_id", md5($uniqueId));
        }
        $orderTax = $this->getTaxByCountryProvinceId($this->session->userdata('country_id'), $this->session->userdata('state_id'));
        $this->config->set_item('gst', $orderTax['gst']);
        $this->config->set_item('hst', $orderTax['hst']);
        $this->config->set_item('pst', $orderTax['pst']);
        if (!$this->session->userdata('language')) {
            $this->session->set_userdata("language", 'en');
            $this->config->set_item('lang_abbr', $this->session->userdata('language'));
        } else {
            $this->config->set_item('lang_abbr', $this->session->userdata('language'));
        }
    }

    public function getCategoryList() {
        $this->db->where('status', 'active');
        $query = $this->db->get($this->tableCategory);
        $result = $query->result_array();
        return $result;
    }

    #=============Function Create Unique Slug===========================================================#

    function create_unique_slug_for_common($app_title, $table) {
        $slug = url_title($app_title);
        $slug = strtolower($slug);
        $i = 0;
        $params = array();
        $params['slug'] = $slug;
        while ($this->db->where($params)->get($table)->num_rows()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $params ['slug'] = $slug;
        }
        $app_title = $slug;
        return $app_title;
    }

    function getSingleFieldFromAnyTable($field_name, $condition_coloum, $condition_value, $table_name) {
        $this->db->select($field_name);
        $this->db->where($condition_coloum, $condition_value);
        $query = $this->db->get($table_name);
        $data = $query->row();
        return $data->$field_name;
    }

    function getSingleRowFromAnyTable($condition_coloum, $condition_value, $table_name) {
        $this->db->select($field_name);
        $this->db->where($condition_coloum, $condition_value);
        $query = $this->db->get($table_name);
        $data = $query->row();
        return $data;
    }

    function getCountAllFromAnyTable($condition_coloum, $condition_value, $table_name, $status) {
        $this->db->where($condition_coloum, $condition_value);
        if ($status)
            $this->db->where('status', $status);
        $query = $this->db->get($table_name);
        $nums = $query->num_rows();
        return $nums;
    }

    function getFieldsFromAnyTable($condition_coloum, $condition_value, $table_name, $order_coloum, $order_by, $status) {
        if ($condition_coloum)
            $this->db->where($condition_coloum, $condition_value);
        if ($status)
            $this->db->where('status', $status);
        if ($order_coloum && $order_by)
            $this->db->order_by($order_coloum, $order_by);
        $query = $this->db->get($table_name);
        $data = $query->result();
        return $data;
    }

    function getFieldsFromAnyTableTwoCondtion($condition_coloum1, $condition_value1, $condition_coloum2, $condition_value2, $table_name, $order_coloum, $order_by, $status, $limit, $group_by) {
        $this->db->where($condition_coloum1, $condition_value1);
        if ($condition_coloum2)
            $this->db->where($condition_coloum2, $condition_value2);
        if ($status)
            $this->db->where('status', $status);
        if ($limit)
            $this->db->limit($limit);
        if ($order_coloum)
            $this->db->order_by($order_coloum, $order_by);
        if ($group_by)
            $this->db->group_by($group_by);
        $query = $this->db->get($table_name);
        $data = $query->result();
        return $data;
    }

    function checkAdminLogin() {
        if ($this->session->userdata('admin_id') == '') {
            redirect('admin/login');
            exit;
        }
    }

    function curPageURL() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    function showLimitedText($string, $len) {
        $string = strip_tags($string);
        if (strlen($string) > $len)
            $string = substr($string, 0, $len - 3) . "...";
        return $string;
    }

    function getAdminRecords() {
        $this->db->where('username', $this->session->userdata('admin_user_name'));
        $query = $this->db->get('tbl_admin');
        $result = $query->result_array();
        return $result;
    }

    function getLoggedInAdminRecords() {
        $this->db->where('id', $this->session->userdata('admin_id'));
        $query = $this->db->get('tbl_admin');
        $result = $query->row_array();
        return $result;
    }

    function getBlogRecords() {
        $this->db->order_by('tbl_blog.add_time', 'desc');
        $this->db->limit(2);
        $query = $this->db->get('tbl_blog');
        $result = $query->result_array();
        return $result;
    }

    function getCategoryLevel($cat_id) {
        for ($i = 1; $i <= 10; $i++) {
            $this->db->select('parent_id');
            $this->db->where('cat_id', $cat_id);
            $query = $this->db->get('tbl_category');
            $result = $query->row();
            if ($result->parent_id == 0) {
                return $i;
            } else {
                $cat_id = $result->parent_id;
            }
        }
    }

    function getParentHeaderLinks() {
        $this->db->select('*');
        $this->db->from('tbl_content');
        $this->db->where('tbl_content.status', 'active');
        $this->db->where('tbl_content.parent_menu', '0');
        $this->db->where('tbl_content.header_type', 'parent');
        $this->db->where('tbl_content.link_showing', 'yes');
        $this->db->where('tbl_content.show_header', 'yes');
        $this->db->order_by('tbl_content.header_order', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getSubMenuHeaderLinks($parentHeaderId) {
        $this->db->select('*');
        $this->db->from('tbl_content');
        $this->db->where('tbl_content.status', 'active');
        $this->db->where('tbl_content.parent_menu', $parentHeaderId);
        $this->db->order_by('tbl_content.footer_order', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getMetaTags($current_url) {
        $this->db->where('metatag_url', $current_url);
        $query = $this->db->get('tbl_metatag');
        $result = $query->row_array();
        return $result;
    }

    function getWebsiteList() {
        $query = $this->db->get('tbl_website_settings');
        $result = $query->row_array();
        return $result;
    }

    function getHeaderLinks() {
        $this->db->where('group_id_fk', 1);
        $query = $this->db->get('tbl_nav_menu');
        $result = $query->result_array();

        return $result;
    }

    function getFooterLinks() {
        $this->db->where('group_id_fk', 2);
        $query = $this->db->get('tbl_nav_menu');
        $result = $query->result_array();
        return $result;
    }

    function getCountryList() {
        $query = $this->db->get('tbl_country');
        $result = $query->result_array();
        return $result;
    }

    function getProvinceList() {
        $query = $this->db->get('tbl_province');
        $result = $query->result_array();
        return $result;
    }

    function getProvinceByCountry($country_id) {
        $this->db->where('country_id', $country_id);
        $query = $this->db->get('tbl_province');
        $result = $query->result_array();
        return $result;
    }

    function getCityList() {
        $query = $this->db->get('tbl_city');
        $result = $query->result_array();
        return $result;
    }

    public function getTaxByCountryProvinceId($countryId, $provinceId) {
        $this->db->where('country_id', $countryId);
        $this->db->where('province_id', $provinceId);
        $query = $this->db->get('tbl_province');
        $result = $query->row_array();
        return $result;
    }

    public function getBannerRecords($banner_category_id = FALSE) {
        $this->db->where('banner_category_id', $banner_category_id);
        $this->db->where('status', 'active');
        $query = $this->db->get($this->tableBanner);
        $result = $query->result_array();
        //pr($result);die;
        return $result;
    }

    public function getCouponData($couponCode) {
        $this->db->where('coupon_code', $couponCode);
        $query = $this->db->get('tbl_coupons');
        $result = $query->row_array();
        return $result;
    }

    public function countCartItems() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $query = $this->db->get('tbl_cart_items');
        $result = $query->num_rows();
        return $result;
    }

    public function getCartItemDetail() {
        $customer_id = $this->session->userdata('SofaByFancy_Sessions')['user_id'];
        $session_id = $this->session->userdata('my_session_id');
        // pr($session_id);die;
        if (isset($customer_id) && $customer_id != '') {
            $this->db->where('customer_id', $customer_id);
        } else {
            $this->db->where('session_id', $session_id);
        }
        $query = $this->db->get('tbl_cart_items');
        $result = $query->result_array();
        // pr($result);die;
        return $result;
    }

    public function getBlogCategory() {
        $this->db->where($this->tableBlogCategory . '.status', 'active');
        $query = $this->db->get($this->tableBlogCategory);
        $result = $query->result_array();
        return $result;
    }

    public function getRecentBlog() {
        $this->db->where($this->tableBlog . '.status', 'active');
        $this->db->order_by("blog_id", "desc");
        $this->db->limit(2);
        $query = $this->db->get($this->tableBlog);
        $result = $query->result_array();
        return $result;
    }

    function addSubscriber() {
        $this->db->set('email_id', $this->input->post('email_id'));
        $this->db->set('status', 'active');
        $this->db->set('add_time', time());
        $query = $this->db->insert($this->tableSubscriber);
        $response = $this->db->insert_id();
        return $response;
    }

    public function getOrderDetailById($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->tableOrder);
        $result = $query->row_array();
        //pr($result);die;
        return $result;
    }

    public function getOrderItems($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->tableOrderItem);
        $result = $query->result();
        //pr($result);die;
        return $result;
    }

    public function check_is_city_set() {
        $city = $this->session->userdata('city');

        if ($city == "" || $city == 0) {
            $current_url = current_url();
            if ($current_url == site_url('')) {
                $this->session->set_userdata('city', '0');
            } else {
                $this->session->set_userdata('city', '0');
                redirect(site_url(''));
            }
        }
    }

    function num_rows($table, $cond) {
        $this->db->where($cond);
        return $this->db->get($table)->num_rows();
    }

    /**
     * insert a row data
     * @param type $table
     * @param type $value
     * @return boolean
     */
    function insert_data($table, $value) {
        $this->db->insert($table, $value);
        return $this->db->affected_rows();
    }

    /**
     * replaces or insert a row
     * @param type $table
     * @param type $value
     * @return boolean
     */
    function replace_data($table, $value) {
        $this->db->replace($table, $value);
        return $this->db->affected_rows();
    }

    /**
     * update data
     * @param type $table
     * @param type $value
     * @return boolean
     */
    function update_data($table, $cond, $data) {
        $this->db->where($cond);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * update data
     * @param type $table
     * @param type $value
     * @return boolean
     */
    function update_batch($table, $data, $id) {
        $this->db->update_batch($table, $data, $id);
        return $this->db->affected_rows();
    }

    /**
     *
     * @param type $table
     * @param type $cond
     * @return boolean
     */
    function delete_data($table, $cond) {
        $this->db->where($cond);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    /**
     * insert n rows
     * @param type $table
     * @param type $value
     * @return type
     */
    function insert_batch($table, $value) {
        $this->db->insert_batch($table, $value);
        return $this->db->affected_rows();
    }

    /**
     * get AI id of last transaction
     * @return type
     */
    function insert_id() {
        return $this->db->insert_id();
    }

    /**
     *
     * @param type $table
     * @param type $item
     * @param type $basedOn
     */
    function fetch_maxItem($table, $item) {
        $this->db->select_max($item);
        $row = $this->db->get($table)->row_array();
        return $row[$item];
    }

    /**
     * get a single cell returned as it is
     * @param type $table
     * @param type $select
     * @param type $cond
     */
    function fetch_cell($table, $select, $cond) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($cond);
        $row = $this->db->get()->row_array();
        if ($row) {
            return $row[$select];
        }
    }

    /**
     *
     * @param type $table
     * @param type $select
     * @param type $cond
     * @return type
     */
    function fetch_where($table, $select = '*', $cond = NULL) {
        $this->db->select($select);
        $this->db->from($table);
        if ($cond !== NULL) {
            $this->db->where($cond);
        }
        return $this->db->get()->result_array();
    }

    /**
     *
     * @param type $table
     * @param type $select
     * @param type $cond
     * @return type
     */
    function fetch_row($table, $select = '*', $cond = NULL) {
        $this->db->select($select);
        $this->db->from($table);
        if ($cond !== NULL) {
            $this->db->where($cond);
        }
        $result = $this->db->get()->row_array();
        return $result ? $result : array();
    }

    /**
     * where from a list of items like ids
     * @param type $table
     * @param type $select
     * @param type $cond
     * @return type
     */
    function fetch_where_in($table, $select, $item, $array) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where_in($item, $array);
        return $this->db->get()->result_array();
    }

    /**
     * for fetching items ordered by something
     * @param type $table
     * @param type $select
     * @param type $cond
     * @param type $orderBy
     * @param type $desc_asc
     * @param type $limit
     * @return type
     */
    function fetch_orderBy($table, $select, $cond, $orderBy, $desc_asc, $limit = NULL) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($cond);
        $this->db->order_by($orderBy, $desc_asc);
        if ($limit) {
            $limits = explode(',', $limit);
            if (count($limits) > 1 && $limits[0] < $limits[1]) {
                $this->db->limit($limits[0], $limits[1]);
            } else {
                $this->db->limit($limits[0]);
            }
        }
        return $this->db->get()->result_array();
    }

    /**
     *  where in makes it posiible to add a list of a condition
     * @param type $table
     * @param type $select
     * @param type $where
     * @param type $in
     * @param type $orderBy
     * @param type $desc_asc
     * @param type $limit
     * @return type
     */
    function fetch_where_in_orderBy($table, $select, $where, $in, $orderBy, $desc_asc, $limit = NULL) {
        $this->db - select($select);
        $this->db->from($table);
        $this->db->where_in($where, $in);
        $this->db->orderBy($orderBy, $desc_asc);
        if ($limit) {
            $limits = explode(',', $limit);
            if (count($limits) > 1 && $limits[0] < $limits[1]) {
                $this->db->limit($limits[0], $limits[1]);
            } else {
                $this->db->limit($limits[0]);
            }
        }
        return $this->db->get()->result_array();
    }

}
