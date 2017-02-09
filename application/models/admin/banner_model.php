<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_Model extends CI_Model {

        var $tableName='tbl_banner';  
        var $tableBannerCategory = 'tbl_banner_category';

    function getBannerListById($bannerId) {        
        if ($bannerId != '')
            $this->db->where($this->tableName.'.banner_id', $bannerId);           
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
    }
    
    function getCategoryList(){
        $query = $this->db->get($this->tableBannerCategory);
        $result = $query->result_array();
        return $result;
        
    }
    
    function getBannerList() {
        $this->db->select($this->tableName.'.*,tbl_banner_category.bn_category_name');
        $this->db->join($this->tableBannerCategory,$this->tableBannerCategory.'.bn_category_id=tbl_banner.banner_category_id');
        $query = $this->db->get($this->tableName);
        //echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }
   
    
    function add($banner_title,$banner_image) {        
                 
//            $slug = $this->common_model->create_unique_slug_for_common($banner_title,'tbl_banner');
//            $this->db->set('slug',$slug);  

        if($this->input->post('banner_title'))
            $this->db->set('banner_title', $this->input->post('banner_title'));
                  if($banner_image)
            $this->db->set('banner_image', $banner_image);
            if($this->input->post('banner_text'))
            $this->db->set('banner_text', $this->input->post('banner_text'));
            if($this->input->post('banner_link'))
            $this->db->set('banner_link', $this->input->post('banner_link'));
        if($this->input->post('bn_category_id'))
            $this->db->set('banner_category_id', $this->input->post('bn_category_id'));
           
         $this->db->set('status','active');  
            $this->db->set('add_time', time());            

            $query = $this->db->insert($this->tableName);
            $response=$this->db->insert_id();
        return $response;
    }
    function update($bannerId,$banner_image){
            if($banner_image)
            $this->db->set('banner_image',$banner_image);
            
            if($this->input->post('banner_title'))
            $this->db->set('banner_title', $this->input->post('banner_title'));                
            if($this->input->post('banner_text'))
            $this->db->set('banner_text', $this->input->post('banner_text'));
             if($this->input->post('banner_link'))
            $this->db->set('banner_link', $this->input->post('banner_link'));
              if($this->input->post('bn_category_id'))
            $this->db->set('banner_category_id', $this->input->post('bn_category_id'));
//            $this->db->set('status','active');             
//      
            $this->db->where('banner_id',$bannerId);
            $query = $this->db->update($this->tableName);
            return $response;       
    } 
   
    
    public function updateStatus($bannerId,$status) {
        $this->db->set('status',$status);
        $this->db->where('banner_id',$bannerId);
        $response = $this->db->update($this->tableName);
        return $response; 
    }
    
    public function delete($bannerId){        
        $this->db->where('banner_id',$bannerId);
        $response = $this->db->delete($this->tableName);
        return $response; 
    }  
    
    public function getBannerImageName($bannerId){
        $this->db->where('banner_id',$bannerId); 
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();
        return $result;
        
    }
	
	public function getFilterResults($value){
		$this->db->like('banner_id', $value);
		$this->db->or_like('banner_title',$value); 
		$query = $this->db->get($this->tableName);
		$result = $query->result_array();
        return $result;
	}
	
	
}