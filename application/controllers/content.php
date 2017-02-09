<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('content_model', 'post');
        $this->load->library('form_validation');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index($page_id) {
        // pr($page_id);die;
        #============Static Page Content According to Language=========================================#
        if (is_numeric($page_id)) {
            $output['page_detail'] = $page_detail = $this->post->getContentRecordByAttributes($page_id, FALSE);
            if ($page_detail->page_id == '') {
                $this->session->set_userdata('ERROR_MESSAGE', 'Sorry! The page you are requested is Not Found');
                redirect(site_url());
            }
        } else {
            $output['page_detail'] = $page_detail = $this->post->getContentRecordByAttributes(FALSE, $page_id);
            if ($page_detail->slug == '') {
                $this->session->set_userdata('ERROR_MESSAGE', 'Sorry! The page you are requested is Not Found');
                redirect(site_url());
            }
        }
        $output['current_page_slug'] = $page_detail->slug;
        $output['breadcrumb'] = $page_detail->page_breadcrumb;
        //pr($output);
        #============Static Page Views=================================================================#
        $this->load->view($this->config->item('template') . '/header', $output);
        $this->load->view($this->config->item('template') . '/static_pages');
        $this->load->view($this->config->item('template') . '/footer');
    }

}
