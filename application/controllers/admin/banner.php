<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in_via_password() || !$this->flexi_auth->is_admin()) {
            $this->flexi_auth->set_error_message('You must login as an admin to access this area.', TRUE);
            $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect($this->config->item('admin_login_url'));
            exit;
        }
        $this->load->model($this->config->item('adminFolder') . '/banner_model', 'banner');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['banner_data'] = $this->banner->getBannerList();
        //pr($data);die;
        $data['page_name'] = 'Banner';
        $data['breadcum'] = 'Manage Banner';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/banner/banner_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function add() {
        if (!empty($_POST)) {

            $this->form_validation->set_rules('banner_title', 'Banner Title', 'trim|required');
            if ($_FILES["banner_image"]['name'] == '')
                $this->form_validation->set_rules('banner_image', 'Banner Image', 'trim|required');
            $this->form_validation->set_rules('bn_category_id', 'Banner Category Id', 'trim|required');


            if ($this->form_validation->run()) {
                if ($_FILES["banner_image"]['name']) {
                    $config['upload_path'] = './assets/uploads/banner_images';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('banner_image')) {
                        $error_msg = $this->upload->display_errors();
                        echo $error_msg;
                        die;
                    } else {
                        $detail = array('upload_data' => $this->upload->data());
                    }
                }

                $bannerData = $this->banner->add($this->input->post('banner_title'), $detail['upload_data']['file_name']);
                $this->session->set_flashdata('BannerSuccess', 'Banner Has Been Added Successfully');
                redirect($this->config->item('adminFolder') . '/banner-list');
                exit;
            } else {
                $data['bn_category_id'] = $this->input->post('bn_category_id');
                $data['banner_title'] = $this->input->post('banner_title');
                $data['banner_link'] = $this->input->post('banner_link');
                $data['banner_image'] = $this->input->post('banner_image');
                $data['banner_text'] = $this->input->post('banner_text');
            }
        }
        $data['banner_category_list'] = $this->banner->getCategoryList();
        $data['page_name'] = 'banner';
        $data['breadcum'] = 'Add Banner';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/banner/banner_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function edit($bannerId) {

        if (!empty($_POST)) {
            $this->form_validation->set_rules('banner_title', 'Banner Title', 'trim|required');
            $this->form_validation->set_rules('bn_category_id', 'Banner Category Id', 'trim|required');
            if ($this->form_validation->run()) {
                if ($_FILES["banner_image"]['name']) {
                    $config['upload_path'] = './assets/uploads/banner_images';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('banner_image')) {
                        $error_msg = $this->upload->display_errors();
                    } else {
                        $detail = array('upload_data' => $this->upload->data());
                    }
                }
                $bannerData = $this->banner->update($bannerId, $detail['upload_data']['file_name']);
                $this->session->set_flashdata('BannerSuccess', 'Banner Has Been Updated Successfully');
                redirect($this->config->item('adminFolder') . '/banner-list');
                exit;
            } else {
                $data['bn_category_id'] = $this->input->post('bn_category_id');
                $data['banner_title'] = $banner_title = $this->input->post('banner_title');
                $data['banner_link'] = $this->input->post('banner_link');
                $data['banner_image'] = $this->input->post('banner_image');
                $data['banner_text'] = $this->input->post('banner_text');
            }
        }
        $lists = $this->banner->getBannerListById($bannerId);
        // pr($lists);die;
        $data['bn_category_id'] = $lists['banner_category_id'];
        $data['banner_id'] = $lists['banner_id'];
        $data['banner_title'] = $lists['banner_title'];
        $data['banner_link'] = $lists['banner_link'];
        $data['banner_image'] = $lists['banner_image'];
        $data['banner_text'] = $lists['banner_text'];
        $data['banner_category_list'] = $this->banner->getCategoryList();
        $data['page_name'] = 'banner';
        $data['breadcum_edit'] = 'Edit Banner';
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/banner/banner_form');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function approve($bannerId, $status) {
        if ($bannerId != '') {
            $bannerData = $this->banner->updateStatus($bannerId, $status);
            $this->session->set_flashdata('BannerSuccess', 'Status Of This Record Has Been Updated Successfully');
            redirect($this->config->item('adminFolder') . '/banner-list');
            exit;
        }
        $this->load->view($this->config->item('adminFolder') . '/header', $data);
        $this->load->view($this->config->item('adminFolder') . '/banner/banner_list');
        $this->load->view($this->config->item('adminFolder') . '/footer');
    }

    public function delete($bannerId) {
        $filename = $this->banner->getBannerImageName($bannerId);
        $banner_name = $filename['banner_image'];
        if (isset($bannerId) && $bannerId != '') {
            unlink('assets/uploads/banner_images/' . $banner_name);
            $this->banner->delete($bannerId);
            $this->session->set_flashdata('BannerSuccess', 'Banner Has Been Deleted Successfully');
            redirect($this->config->item('adminFolder') . '/banner-list');
            exit;
        }
    }

	public function ajax_banner_data(){

		$banner_data = $this->banner->getBannerList();
		$totalData = count($banner_data);
		$totalFiltered = $totalData;


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
if( !empty($requestData['search']['value']) ) {  
$banner_data = $this->banner->getFilterResults($requestData['search']['value']);
$totalFiltered = count($banner_data);
}
 
                                               
  
$data = array();

foreach($banner_data as $row){// preparing an array
	$nestedData=array(); 
	$nestedData[] = $row["banner_id"];
	$nestedData[] = $row["banner_title"];
	$nestedData[] = $row["banner_text"];
	$file_path = FCPATH . "assets/uploads/banner_images/" . $row['banner_image'];
	 if ($row['banner_image'] != '' && file_exists($file_path)) {
	 $nestedData[] =  '<a class="fancybox fancybox.iframe" href="'. site_url('assets/uploads/banner_images/'.$row['banner_image']).'">
  <img class="media-object" width="50px" height="50px"  src="'.site_url('assets/uploads/banner_images/'.$row['banner_image']).'" alt="'.$row['banner_title'].'" ></a>';
      } else{
		  $nestedData[] =  '<img width="50px" height="50px"  src="'.site_url('assets/uploads/banner_images/image_not_available.jpg').'" >';
	  }
	if ($row['status'] == 'active'){
		$nestedData[] = '<span class="label label-success">Active</span>';
	}else{
		$nestedData[] = '<span class="label label-danger">Inactive</span>';
	}
	
	
	if ($row['status'] == 'active'){
		$nestedData[] = '<a href="javascript:" data-href="'. base_url() . 'admin/banner-status/' . $row['banner_id'] . '/inactive'.'" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
		<a href="javascript:"  data-href="'. base_url() . 'admin/banner-delete/' . $row['banner_id'] .'" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times" title="delete"></span></a>';
	 
	}else{
		$nestedData[] = '<a href="javascript:" data-href="'. base_url() . 'admin/banner-status/' . $row['banner_id'] . '/active'.'" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Active"></span></a>
	    <a href="javascript:"  data-href="'. base_url() . 'admin/banner-delete/' . $row['banner_id'] .'" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times" title="delete"></span></a>';
	}
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format
	}
	
}
