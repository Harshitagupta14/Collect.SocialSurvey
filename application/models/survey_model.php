<?php

class Survey_Model extends CI_Model {

    public function get_published_survey_feeds_by_args($organization_id = FALSE) {

        $survey_select = 'SELECT `survey`.`id`,`survey`.`survey_id`,`survey`.`user_id_fk`,`survey`.`survey_title`,`survey`.`survey_type`,`survey`.`survey_category`,`survey`.`survey_status`,`survey`.`add_time`';

        $question_count = "COALESCE( survey_question.cnt, 0 ) AS question_count";
        $response_count = "COALESCE( survey_response.cnt, 0 ) AS response_count";

        $final_select = " $survey_select , $question_count , $response_count FROM `tbl_survey` survey";

        $left_join_question = "LEFT JOIN ( SELECT survey_fk_id, COUNT(*) AS cnt FROM tbl_survey_question survey_question GROUP BY survey_fk_id ) survey_question ON survey.id = survey_question.survey_fk_id";

        $left_join_response = "LEFT JOIN ( SELECT survey_fk_id, COUNT(*) AS cnt FROM tbl_survey_response survey_response GROUP BY survey_fk_id ) survey_response ON survey.id = survey_response.survey_fk_id";

        $conditions = "WHERE survey.user_id_fk = " . $organization_id . " && survey.survey_status = 'published'  ORDER BY survey.add_time DESC";

        $query = "$final_select $left_join_question $left_join_response $conditions";

        $final_query = $this->db->query($query);

        return $final_query->result_array();
    }

    public function get_survey_questions_by_args($id = FALSE, $question_no = FALSE) {

        $survey_select = '`survey_question`.*,`survey`.`survey_id` as survey_enc_id,`survey`.`id` as survey_id';
        $final_select = " $survey_select, survey_type.type_small_name, survey_type.type_name";

        $this->db->select($final_select);
        $this->db->from("`tbl_survey_question` as `survey_question`");
        $this->db->join("`tbl_survey_question_type` as `survey_type` ", ' survey_question.type_id_fk = survey_type.id', 'left');
        $this->db->join("`tbl_survey` as `survey` ", 'survey.id = survey_question.survey_fk_id', 'left');
        $this->db->where("`survey_question.survey_fk_id`", $id);
        if ($question_no) {
            $this->db->where("`survey_question.question_no`", $question_no);
        }
        $this->db->order_by('survey_question.question_no', 'ASEC');
        $final_query = $this->db->get();
        return $final_query->result_array();
    }

    public function rearrange_survey_question_no(
    $question_no) {
        $this->db->set('question_no', 'question_no-1', FALSE);
        $this->db->where('question_no >', $question_no);
        $this->db->update('tbl_survey_question');
    }

    public function get_surveyor_by_args($parent_id = FALSE) {
        $survey_select = '`user_accounts`.*';
        $final_select = " $survey_select, `user_profiles`.*";
        $this->db->select($final_select);
        $this->db->from("`user_accounts`");
        $this->db->join("`user_profiles`", ' user_profiles.upro_uacc_fk  = user_accounts.uacc_id', 'left');
        $this->db->where("`user_accounts.uacc_parent_id_fk`", $parent_id);
        $this->db->order_by('user_accounts.uacc_id', 'ASEC');
        $final_query = $this->db->get();
        return $final_query->result_array();
    }

    public function get_survey_respone_feeds_by_args($status = FALSE, $surveyor_id = FALSE) {
        $survey_select = '`survey_response`.*,`survey`.`survey_title`';
        $final_select = " $survey_select ,count(`survey_question`.`id`)as question_count";
        $final_query = $this->db->select($final_select)
                ->from("`tbl_survey_response` as `survey_response`")
                ->join("`tbl_survey` as `survey` ", ' survey.id = survey_response.survey_fk_id', 'left')
                ->join("`tbl_survey_question` as `survey_question` ", ' survey_question.survey_fk_id = survey_response.survey_fk_id', 'left')
                ->where("`survey_response`.`surveyor_fk_id`", $surveyor_id)
                ->where("`survey_response`.`survey_res_status`", $status)
                ->group_by('survey_response.id')
                ->order_by('survey_response.id', 'DESC')
                ->get();
        return $final_query->result_array();
    }

    public function get_published_response_feeds_by_args($survey_id = FALSE, $response_id = FALSE, $status = FALSE) {
        $response_select = '`survey_response`.*,`survey_response`.`id` as response_id,`survey_response_question`.*,`survey_response_question`.`id` as question_response_id';
        $final_select = "$response_select";

        $final_query = $this->db->select($final_select)
                ->from("`tbl_survey_response` as `survey_response`")
                ->join("`tbl_survey_question_response` as `survey_response_question` ", ' survey_response_question.survey_res_fk_id = survey_response.id', 'left')
                ->where("`survey_response`.`id`", $response_id)
                ->where("`survey_response`.`survey_fk_id`", $survey_id)
                ->where("`survey_response`.`survey_res_status`", $status)
                ->group_by('question_response_id')
                ->order_by('question_response_id', 'ASC')
                ->get();
        return $final_query->result_array();
    }

    function add_media_details($media_insert_id, $media_name, $media_path, $media_tpye, $id, $survey_id = FALSE) {
        if ($media_insert_id != '' && $media_insert_id != 0) {
            $this->db->where('id', $media_insert_id);
        } else {
            $this->db->where('session_id', $this->session->userdata('my_session_id'));
        }
        $this->db->where('survey_fk_id', $survey_id);
        $query = $this->db->get('tbl_survey_response_media');
        $nums = $query->num_rows();
        if ($nums > 0) {
            $this->db->set('media_name', $media_name);
            $this->db->set('media_path', $media_path);
            $this->db->set('media_type', $media_tpye);
            $this->db->set('surveyor_fk_id', $this->flexi_auth->get_user_by_identity_row_array()['uacc_id']);
            if ($media_insert_id != '' && $media_insert_id != 0) {
                $this->db->where('id', $media_insert_id);
            } else {
                $this->db->where('session_id', $this->session->userdata('my_session_id'));
            }
            $this->db->where('survey_fk_id', $survey_id);
            $response = $this->db->update('tbl_survey_response_media');
        } else {
            $this->db->set('session_id', $this->session->userdata('my_session_id'));
            $this->db->set('survey_fk_id', $survey_id);
            $this->db->set('media_name', $media_name);
            $this->db->set('media_path', $media_path);
            $this->db->set('media_type', $media_tpye);
            $this->db->set('surveyor_fk_id', $this->flexi_auth->get_user_by_identity_row_array()['uacc_id']);
            $this->db->set('status', 'active');
            $this->db->set('add_time', time());
            $this->db->insert('tbl_survey_response_media');
            $response = $this->db->insert_id();
        }
        return $response;
    }

    function save_response($data, $response_id) {
        //$id = $this->save_post($data);
        $this->db->select('id');
        $this->db->where('survey_res_fk_id', $response_id);
        $survey_response = $this->db->get('tbl_survey_question_response')->result_array();


        $i = 0;
        //check logic
        if (count($data['survey_response_data']) > count($survey_response)) {
            //update and insert
            $update_survey_response = array();
            for ($i = 0; $i < count($survey_response); $i++):
                $update_survey_response[$i] = $data['survey_response_data'][$i];
                $update_survey_response[$i]['id'] = $survey_response[$i]['id'];
            endfor;
            $insert_survey_response = array();
            for ($j = $i, $k = 0; $j < count($data['survey_response_data']); $j++, $k++):
                $insert_survey_response[$k] = $data['survey_response_data'][$j];
            endfor;

            if (!empty($update_survey_response)) {
                $this->db->update_batch('tbl_survey_question_response', $update_survey_response, 'id');
            }
            if (!empty($insert_survey_response)) {
                $this->db->insert_batch('tbl_survey_question_response', $insert_survey_response);
            }
        } else {
            //update then delete
            $changes = count($survey_response) - count($data['survey_response_data']);
            $updatable = array();
            for ($i = 0; $i < count($data['survey_response_data']); $i++):
                $updatable[$i] = $data['survey_response_data'][$i];
                $updatable[$i]['id'] = $survey_response[$i]['id'];
            endfor;
            if (!empty($updatable)) {
                $this->db->update_batch('tbl_survey_question_response', $updatable, 'id');
            }
            if ($changes != 0) {
                //deleting rows
                $ids = array_column(array_slice($survey_response, count($data['survey_response_data'])), 'id');
                $this->db->where_in('id', $ids);
                $this->db->delete('tbl_survey_question_response');
            }
        }
        return $response_id;
    }

}

?>
