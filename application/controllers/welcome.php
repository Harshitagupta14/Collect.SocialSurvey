<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('content_model', 'post_data');
        $this->load->library('form_validation');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        $city1 = $this->session->userdata('city');
        $this->common_model->check_is_city_set();
    }

    public function index() {
        $data['METATITLE'] = "Home";
        $data['METAKEYWORDS'] = "Home";
        $data['METADESCRIPTION'] = "Home";
        $data['current_page_slug'] = "Home";
        $this->load->view($this->config->item('template') . '/header', $data);
        $this->load->view($this->config->item('template') . '/home');
        $this->load->view($this->config->item('template') . '/footer');
        //redirect(site_url('login'));
    }

    public function compare() {
        $this->load->view($this->config->item('template') . '/header');
        $this->load->view($this->config->item('template') . '/compare');
        $this->load->view($this->config->item('template') . '/footer');
    }

    public function productByTypeId() {
        $typeId = $this->input->post('prd_type_id');
        $data['product_data'] = $product_list = $this->product->getProductByArguments(FALSE, $typeId, FALSE, FALSE, FALSE, 6);
        if ($product_list) {
            $response['html'] = $this->load->view($this->config->item('template') . '/product_html/product_div', $data, true);
        }
        $response['success'] = true;
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function subscriber() {
        if (!empty($_POST)) {
            $this->form_validation->set_rules('email_id', 'Email Id', 'trim|required|valid_email|is_unique[tbl_subscriber.email_id]');
            if ($this->form_validation->run()) {
                $this->common_model->addSubscriber();
                $msg = 'Subscribed succesfully';
                echo json_encode($msg);
                die;
            } else {
                $msg = 'Please Enter a valid email or Email Already Subscribed';
                echo json_encode($msg);
                die;
            }
        }
    }

    function change_language($lang_abbr) {
        $this->session->set_userdata('language', $lang_abbr);
        redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    function fetch_survey_feeds() {
        $last_survey_id = 1;
        $survey_html = '';
        for ($i = 0; $i < 10; $i++) {
            $survey_html .= '<div class="col-md-4">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <ul class="nav nav-pills">
                            <li class="tooltips" data-container="body" data-placement="top" data-original-title="Questios">
                                <a href="#" style="background-color:#eee;"> <i class="fa fa-question-circle m-r-5"></i>
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li  class="tooltips" data-container="body" data-placement="top" data-original-title="Responses">
                                <a href="#" style="background-color:#eee;"> <i class="fa fa-area-chart"></i>
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li style="float:right;"><i class="fa fa-clock-o" aria-hidden="true"></i> 12 seconds ago</li>
                        </ul>

                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Survey Title</h4>
                                <span class="label label-warning"> Draft/Pubished </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="actions" style="float:right;">
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-cloud-upload"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>';
        }
        header("Content-type: text/plain");
        $str = preg_replace('/\\\"/', "\"", $survey_html);
        $data = array(
            'html' => $survey_html,
            'id' => $last_survey_id + 1
        );
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        die;
    }

}
