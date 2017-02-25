<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('content_model', 'post');
        $this->load->model('survey_model', 'survey');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('components');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in()) {
            $this->flexi_auth->set_error_message('You must login to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('login_url'));
        }
    }

    public function survey_collect_response($id = NULL) {
        $data['survey_data'] = $survey_data = $this->common_model->fetch_where('tbl_survey', '*', array('survey_id' => $id))[0];
        $data['survey_question_data'] = $question_data = $this->survey->get_survey_questions_by_args($survey_data['id']);
        $data['METATITLE'] = "Create Survey - Step 1";
        $data['METAKEYWORDS'] = "Create Survey - Step 1";
        $data['METADESCRIPTION'] = "Create Survey - Step 1";
        $data['id'] = $this->flexi_auth->get_user_by_identity_row_array()['uacc_id'];
        $data['breadcrumb'] = '<li class="active">Services</li>';
        $data['survey_types'] = $this->common_model->fetch_where('tbl_survey_question_type');
        $data['survey_id'] = $survey_data['survey_id'];
        $this->load->view($this->config->item('template') . '/survey/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/survey/main_contents/collect_response');
        $this->load->view($this->config->item('template') . '/survey/footer/footer_dashboard');
    }

    public function ajax_publish_survey_response() {
        parse_str($_POST['str'], $_POST);
        $response = $this->handle_publish_survey_response();
        if ($response) {
            $data['success'] = "true";
        } else {
            $data['success'] = "false";
        }
        echo json_encode($data);
        die;
    }

    public function handle_publish_survey_response() {
        $data_question_response = array();
        $survey_encrypted_id = $this->input->post("survey_id");
        $survey_total_question = $this->input->post("total_question");
        $survey_data = $this->common_model->fetch_where('tbl_survey', '*', array('survey_id' => $survey_encrypted_id))[0];
        $survey_id = $survey_data['id'];
        $surveyor_id = $this->flexi_auth->get_user_by_identity_row_array()['uacc_id'];
        $data_response['survey_fk_id'] = $survey_id;
        $data_response['surveyor_fk_id'] = $surveyor_id;
        $survey_publish_status = $this->input->post('survey_publish_status');
        if (isset($survey_publish_status) && $survey_publish_status == 'publish_insert') {
            $data_response['survey_res_status'] = 'published';
            $data_response['add_time'] = date('Y-m-d H:i:s');
            $this->common_model->insert_data('tbl_survey_response', $data_response);
            $id = $this->db->insert_id();
            for ($i = 1; $i <= $survey_total_question; $i++) {
                $data_question_response[$i]['survey_res_fk_id'] = $id;
                $data_question_response[$i]['question_no'] = $i;
                $data_question_response[$i]['question_type'] = $this->input->post('question_type_' . $i);
                $data_question_response[$i]['question_response'] = $this->input->post('response_' . $i);
                $data_question_response[$i]['add_time'] = date('Y-m-d H:i:s');
            }
            $response = $this->common_model->insert_batch('tbl_survey_question_response', $data_question_response);
        } else if (isset($survey_publish_status) && $survey_publish_status == 'publish_update') {
            $data_response['survey_res_status'] = 'published';
            $data_response['modify_time'] = date('Y-m-d H:i:s');
            $survey_response_id = $this->input->post('survey_response_id');
            $this->common_model->update_data('tbl_survey_response', array('id' => $survey_response_id), $data_response);
            for ($i = 1; $i <= $survey_total_question; $i++) {
                $data_question_response[$i]['id'] = $this->input->post('question_response_id_' . $i);
                $data_question_response[$i]['question_no'] = $i;
                $data_question_response[$i]['question_type'] = $this->input->post('question_type_' . $i);
                $data_question_response[$i]['question_response'] = $this->input->post('response_' . $i);
                $data_question_response[$i]['modify_time'] = date('Y-m-d H:i:s');
            }
            $response = $this->common_model->update_batch('tbl_survey_question_response', $data_question_response, 'id');
        } else if (isset($survey_publish_status) && $survey_publish_status == 'draft_insert') {
            $data_response['survey_res_status'] = 'draft';
            $data_response['add_time'] = date('Y-m-d H:i:s');
            $this->common_model->insert_data('tbl_survey_response', $data_response);
            $id = $this->db->insert_id();
            for ($i = 1; $i <= $survey_total_question; $i++) {
                $data_question_response[$i]['survey_res_fk_id'] = $id;
                $data_question_response[$i]['question_no'] = $i;
                $data_question_response[$i]['question_type'] = $this->input->post('question_type_' . $i);
                $data_question_response[$i]['question_response'] = $this->input->post('response_' . $i);
                $data_question_response[$i]['add_time'] = date('Y-m-d H:i:s');
            }
            $response = $this->common_model->insert_batch('tbl_survey_question_response', $data_question_response);
        } else if (isset($survey_publish_status) && $survey_publish_status == 'draft_update') {
            $data_response['survey_res_status'] = 'draft';
            $data_response['modify_time'] = date('Y-m-d H:i:s');
            $survey_response_id = $this->input->post('survey_response_id');
            $this->common_model->update_data('tbl_survey_response', array('id' => $survey_response_id), $data_response);
            for ($i = 1; $i <= $survey_total_question; $i++) {
                $data_question_response[$i]['id'] = $this->input->post('question_response_id_' . $i);
                $data_question_response[$i]['question_no'] = $i;
                $data_question_response[$i]['question_type'] = $this->input->post('question_type_' . $i);
                $data_question_response[$i]['question_response'] = $this->input->post('response_' . $i);
                $data_question_response[$i]['modify_time'] = date('Y-m-d H:i:s');
            }
            $response = $this->common_model->update_batch('tbl_survey_question_response', $data_question_response, 'id');
        }

        return $response;
    }

    public function ajax_get_survey_questions() {
        $id = $this->input->post('survey_id');
        $question_data = $this->survey->get_survey_questions_by_args($id);
        $question_list = '';
        foreach ($question_data as $key => $value) {
            $active = "class='row question-row'";
            if ($key == 0) {
                $active = "class='question-active row question-row'";
            }
            $question_list .= "<div data-question-id='" . $value['question_no'] . "' style='margin-bottom:10px;'" . $active . "><span class='badge badge-danger' style='margin-right:10px;'> " . $value['question_no'] . " </span>" . $value['question_title'] . "</br><div class='col-lg-7 col-md-7 col-sm-7 col-xs-7'><label class='label label-warning'>" . $value['type_name'] . "</label></div><div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><span class='btn btn-icon-only btn-default' onclick='edit_question(" . $value['question_no'] . ");'><i class='fa fa-edit'></i></span></div></div>";
        }
        if (count($question_data[0]) > 0) {
            $data = array('question_list' => $question_list,
                'first_question' => $question_data[0], 'success' => "true");
        } else {
            $data = array('success' => "false");
        }
        echo json_encode($data);
        die;
    }

    public function ajax_edit_survey_question() {
        $id = $this->input->post('survey_id');
        $question_no = $this->input->post('question_no');
        $question_list_data = $this->survey->get_survey_questions_by_args($id);
        $question_data = $this->survey->get_survey_questions_by_args($id, $question_no);
        $question_list = '';
        foreach ($question_list_data as $key => $value) {
            $active = "class='row question-row'";
            if ($key == $question_no - 1) {
                $active = "class='question-active row question-row'";
            }
            $question_list .= "<div data-question-id='" . $value['question_no'] . "' style='margin-bottom:10px;'" . $active . "><span class='badge badge-danger' style='margin-right:10px;'> " . $value['question_no'] . " </span>" . $value['question_title'] . "</br><div class='col-lg-7 col-md-7 col-sm-7 col-xs-7'><label class='label label-warning'>" . $value['type_name'] . "</label></div><div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><span class='btn btn-icon-only btn-default' onclick='edit_question(" . $value['question_no'] . ");'><i class='fa fa-edit'></i></span></div></div>";
        }
        if (count($question_data[0]) > 0) {
            $data = array('question_list' => $question_list, 'question_data' => $question_data[0], 'success' => "true");
        } else {
            $data = array('success' => "false");
        }
        echo json_encode($data);
        die;
    }

    public function ajax_delete_survey_question() {
        $id = $this->input->post('survey_id');
        $question_no = $this->input->post('question_no');
        $cond = array('question_no' => $question_no,
            'survey_fk_id' => $id);
        $response = $this->common_model->delete_data('tbl_survey_question', $cond);
        $this->survey->rearrange_survey_question_no($question_no);
        if ($response) {
            $data = array('response' => $response, 'success' => "true");
        } else {
            $data = array('success' => "false");
        }
        echo json_encode($data);
        die;
    }

    public function published_response() {
        $surveyor_id = $this->flexi_auth->get_user_by_identity_row_array()['uacc_id'];
        $data['survey_feeds'] = $this->survey->get_survey_respone_feeds_by_args('published', $surveyor_id);
        $data['response_title'] = 'Published Responses';
        $this->load->view($this->config->item('template') . '/survey/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/survey/main_contents/other_response_feeds');
        $this->load->view($this->config->item('template') . '/survey/footer/footer_dashboard');
    }

    public function draft_response() {
        $surveyor_id = $this->flexi_auth->get_user_by_identity_row_array()['uacc_id'];
        $data['survey_feeds'] = $this->survey->get_survey_respone_feeds_by_args('draft', $surveyor_id);
        $data['response_title'] = 'Draft Responses';
        $this->load->view($this->config->item('template') . '/survey/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/survey/main_contents/other_response_feeds');
        $this->load->view($this->config->item('template') . '/survey/footer/footer_dashboard');
    }

    public function survey_response_published($survey_response_id = NULL) {
        $survey_id = $this->common_model->fetch_cell('tbl_survey_response', 'survey_fk_id', array('id' => $survey_response_id));
        $data['survey_question_data'] = $this->survey->get_published_response_feeds_by_args($survey_id, $survey_response_id, 'published');
        $this->load->view($this->config->item('template') . '/survey/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/survey/main_contents/edit_publish_response');
        $this->load->view($this->config->item('template') . '/survey/footer/footer_dashboard');
    }

    public function survey_response_draft($survey_response_id = NULL) {
        $survey_id = $this->common_model->fetch_cell('tbl_survey_response', 'survey_fk_id', array('id' => $survey_response_id));
        $data['survey_question_data'] = $this->survey->get_published_response_feeds_by_args($survey_id, $survey_response_id, 'draft');
        $this->load->view($this->config->item('template') . '/survey/header/header_dashboard', $data);
        $this->load->view($this->config->item('template') . '/survey/main_contents/edit_publish_response');
        $this->load->view($this->config->item('template') . '/survey/footer/footer_dashboard');
    }

//    public function ajax_update_survey_response() {
//        print_r($_POST);
//        die;
//        parse_str($_POST['str'], $_POST);
//        $response = $this->update_publish_survey_response();
//        if ($response) {
//            $data['success'] = "true";
//        } else {
//            $data['success'] = "false";
//        }
//        echo json_encode($data);
//        die;
//    }

    public function ajax_upload_media() {
        if ($this->input->post('label') == 'MEDIAIMAGEUPLOAD') {
            $id = $this->input->post('response_id');
            $_FILES['mediaFile']['name'] = time() . $_FILES['mediaFile']['name']; //Changing FIlename
            if (!empty($_FILES)) {
                $config['upload_path'] = 'assets/uploads/response_images';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                if ($_FILES['mediaFile']['name'] != '') {
                    if (!$this->upload->do_upload('mediaFile')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        $data['success'] = 'false';
                    } else {
                        $fileData = $this->upload->data();
                        $data['file_name'] = $fileData['file_name'];
                        $data['full_path'] = $fileData['full_path'];
                        $data['success'] = 'true';
                        $file_name = 'file_name' . $id;
                        $full_path = 'full_path' . $id;
                        if ($this->session->userdata($file_name)) {
                            $this->session->unset_userdata($file_name);
                            $this->session->unset_userdata($full_path);
                        }
                        if ($id != '') {
                            $this->session->set_userdata('file_name1', $data['file_name']);
                            $this->session->set_userdata('full_path1', $data['full_path']);
                            $data['session_filename'] = $this->session->userdata('file_name1');
                            $data['session_filename_no'] = $file_name;
                            //$this->apply->add_bank_statement($data['file_name'], $data['full_path'], $id, $app_id);
                        }
                    }
                }
                echo json_encode($data);
                die;
            }
        }
    }

}
