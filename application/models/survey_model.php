<?php

class Survey_Model extends CI_Model {

    public function get_published_survey_feeds_by_args($organization_id = FALSE) {
        $survey_select = '`survey`.`id`,`survey`.`survey_id`,`survey`.`user_id_fk`,`survey`.`survey_title`,`survey`.`survey_type`,`survey`.`survey_category`,`survey`.`survey_status`,`survey`.`add_time`';
        $final_select = " $survey_select ,count(`survey_question`.`id`)as question_count";

        $final_query = $this->db->select($final_select)
                ->from("`tbl_survey` as `survey`")
                ->join("`tbl_survey_question` as `survey_question` ", ' survey_question.survey_fk_id = survey.id', 'left')
                ->where("`survey`.`user_id_fk`", $organization_id)
                ->where("`survey`.`survey_status`", 'published')
                ->group_by('survey.survey_id')
                ->order_by('survey.add_time', 'DESC')
                ->get();
        return $final_query->result_array();
    }

    public function get_survey_questions_by_args($id = FALSE, $question_no = FALSE) {

        $survey_select = '`survey_question`.*';
        $final_select = " $survey_select, survey_type.type_small_name, survey_type.type_name";

        $this->db->select($final_select);
        $this->db->from("`tbl_survey_question` as `survey_question`");
        $this->db->join("`tbl_survey_question_type` as `survey_type` ", ' survey_question.type_id_fk = survey_type.id', 'left');
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

    public function get_published_response_feeds_by_args($response_id = FALSE, $status = FALSE) {
        $survey_select = '`survey_response`.*,`survey_question`.*,`survey_response_question`.*';
        $final_select = " $survey_select, survey_type.type_small_name, survey_type.type_name";

        $final_query = $this->db->select($final_select)
                ->from("`tbl_survey_response` as `survey_response`")
                ->join("`tbl_survey_question` as `survey_question` ", ' survey_question.survey_fk_id = survey_response.survey_fk_id', 'left')
                ->join("`tbl_survey_question_type` as `survey_type` ", ' survey_question.type_id_fk = survey_type.id', 'left')
                ->join("`tbl_survey_question_response` as `survey_response_question` ", ' survey_response_question.question_no = survey_question.question_no', 'left')
                ->where("`survey_response`.`id`", $response_id)
                ->where("`survey_response`.`survey_res_status`", $status)
                ->group_by('survey_response_question.question_no')
                ->order_by('survey_response_question.question_no', 'DESC')
                ->get();
        return $final_query->result_array();
    }

}

?>
