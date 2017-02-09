<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('content_model', 'post');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        //$this->common_model->check_is_city_set();
    }

    public function index() {
        $data['category_data'] = $this->common_model->getFieldsFromAnyTable('parent_id', 0, 'tbl_category', FALSE, FALSE, 'active');
        $data['METATITLE'] = "Hotels";
        $data['METAKEYWORDS'] = "All Hotels";
        $data['METADESCRIPTION'] = "All Hotels";
        $data['current_page_slug'] = "categories";
        $data['breadcrumb'] = '<li class="active">Services</li>';
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/category');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function productsByCategory($categorySlug) {
        $data['category_detail'] = $category_detail = $this->common_model->getSingleRowFromAnyTable('slug', $categorySlug, 'tbl_category');
        $count_sub_category = $this->common_model->getCountAllFromAnyTable('parent_id', $category_detail->category_id, 'tbl_category', 'active');
        $data['METATITLE'] = $category_detail->meta_title;
        $data['METAKEYWORDS'] = $category_detail->meta_keyword;
        $data['METADESCRIPTION'] = $category_detail->meta_description;
        $breadcumb = '<li class="active">' . $category_detail->category_name . '</li>';
        $parent_id = $category_detail->parent_id;
        for (; $parent_id != 0;) {
            $parent_category_row = $this->common_model->getSingleRowFromAnyTable('category_id', $parent_id, 'tbl_category');
            $parent_id = $parent_category_row->parent_id;
            $breadcumb = '<li>' . $parent_category_row->category_name . '</li>' . $breadcumb;
        }
        $breadcumb = '<li><a href="' . site_url('category') . '">Services</a></li>' . $breadcumb;
        if ($count_sub_category == 0) {
            $data['dataURL'] = 'category/getProductsData/' . $category_detail->category_id . '/?';
            $data['current_page_slug'] = "categories";
            $data['breadcrumb'] = $breadcumb;

            $this->load->view($this->config->item('template') . '/header', $data);
            $this->load->view($this->config->item('template') . '/productList');
            $this->load->view($this->config->item('template') . '/footer');
        } else {
            $data['category_data'] = $sub_category = $this->common_model->getFieldsFromAnyTable('parent_id', $category_detail->category_id, 'tbl_category', FALSE, FALSE, 'active');
            $data['breadcrumb'] = $breadcumb;
            $this->load->view($this->config->item('template') . '/header', $data);
            $this->load->view($this->config->item('template') . '/category');
            $this->load->view($this->config->item('template') . '/footer');
        }
    }

    public function getProductsData($catId) {

        $data['dataURL'] = $dataURL = 'category/getProductsData/' . $catId . '/?';
        $countRecord = $this->product->get_products_count($catId, FALSE);
        $config['base_url'] = base_url() . $dataURL;
        $config['per_page'] = 9;
        $config['total_rows'] = $countRecord;
        $config['page_query_string'] = TRUE;
        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $paging = $this->pagination->create_links();
        $data['product_data'] = $this->product->getProductByArguments($catId, FALSE, FALSE, $config['per_page'], $currentpage);

        $data['paging'] = $paging;
        $this->load->view($this->config->item('template') . '/more_products', $data);
    }

    public function productdetail($productSlug) {
        $data['product_detail'] = $product_detail = $this->common_model->getSingleRowFromAnyTable('slug', $productSlug, $this->product->tableProduct);
        $product_id = $product_detail->product_id;
        if (!empty($_POST)) {
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('review', 'Review', 'trim|required');
            if ($this->form_validation->run()) {
                $this->product->add_review($product_id);
                $this->session->set_flashdata('ReviewSuccess', 'Review submitted Successfully');
                redirect('product/' . $productSlug);
                exit;
            }
        }
        $data['review_html'] = $this->load->view($this->config->item('template') . '/product_review_form', $data, true);
        $data['category_detail'] = $category_detail = $this->common_model->getSingleRowFromAnyTable('category_id', $product_detail->category_id, 'tbl_category');
        $data['product_featured_image'] = $this->product->get_product_featured_image($product_detail->product_id);
        $data['product_image'] = $this->product->get_product_image($product_detail->product_id);
        $data['similar_product'] = $this->product->get_similar_products($product_detail->product_id, $product_detail->group_number);
        $data['METATITLE'] = $product_detail->meta_title;
        $data['METAKEYWORDS'] = $product_detail->meta_keyword;
        $data['METADESCRIPTION'] = $product_detail->meta_description;

        $data['page_title'] = $product_detail->product_title;
        $data['breadcrumb'] = '<li><a href="' . site_url('category/' . $category_detail->slug) . '">' . $category_detail->category_name . '</a></li> <li>' . $product_detail->product_title . '</li>';
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/productDetail');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function productsByType($typeSlug) {
        $data['type_detail'] = $product_type_detail = $this->common_model->getSingleRowFromAnyTable('slug', $typeSlug, 'tbl_product_types');
        $data['dataURL'] = 'category/getProductsTypeData/' . $product_type_detail->prd_type_id . '/?';
        $data['METATITLE'] = $product_type_detail->prd_type_name;
        $data['METAKEYWORDS'] = $product_type_detail->prd_type_name;
        $data['METADESCRIPTION'] = $product_type_detail->prd_type_name;
        $data['page_title'] = $product_type_detail->prd_type_name;
        $breadcumb = '<li>' . $product_type_detail->prd_type_name . '</li>';
        $data['breadcrumb'] = $breadcumb;
        $data['current_page_slug'] = $product_type_detail->slug;
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/productList');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function getProductsTypeData($prdId) {
        $data['dataURL'] = $dataURL = 'category/getProductsTypeData/' . $prdId . '/?';
        $countRecord = sizeof($this->product->getProductByArguments(FALSE, $prdId, FALSE, FALSE, FALSE));
        //pr($countRecord);die;
        $config['base_url'] = base_url() . $dataURL;
        $config['per_page'] = 9;
        $config['total_rows'] = $countRecord;
        $config['page_query_string'] = TRUE;
        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $paging = $this->pagination->create_links();
        $data['product_data'] = $this->product->getProductByArguments(FALSE, $prdId, FALSE, $config['per_page'], $currentpage);
        $data['paging'] = $paging;
        $this->load->view($this->config->item('template') . '/more_products', $data);
    }

    public function productSearch() {
        if (isset($_GET['search']) && $_GET['search'] != '') {
            $searchKeyword = $this->input->get('search');
            $data['product_data'] = $this->product->getProductByArguments(FALSE, FALSE, $searchKeyword, FALSE, FALSE);
            $data['breadcrumb'] = '<li>' . "SearchBy" . ' "' . $searchKeyword . '"' . '</li>';
            $this->load->view($this->config->item('template') . '/header', $data);
            $this->load->view($this->config->item('template') . '/productSearch');
            $this->load->view($this->config->item('template') . '/footer');
        }
    }

}
