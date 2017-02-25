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

    public function get_published_response_feeds_by_args($survey_id = FALSE, $response_id = FALSE, $status = FALSE) {
        $survey_select = '`survey_response`.*,`survey_response`.`id` as response_id,`survey_question`.*,`survey_response_question`.`survey_res_fk_id`,`survey_response_question`.`question_no`,`survey_response_question`.`question_response`,`survey_response_question`.`add_time`,`survey_response_question`.`modify_time`,`survey_response_question`.`id` as question_response_id,`survey`.`survey_id`,`survey`.`survey_title`';
        $final_select = " $survey_select, survey_type.type_small_name, survey_type.type_name";

        $final_query = $this->db->select($final_select)
                ->from("`tbl_survey_response` as `survey_response`")
                ->join("`tbl_survey` as `survey` ", ' survey.id = survey_response.survey_fk_id', 'left')
                ->join("`tbl_survey_question_response` as `survey_response_question` ", ' survey_response_question.survey_res_fk_id = survey_response.id', 'left')
                ->join("`tbl_survey_question` as `survey_question` ", 'survey_response_question.question_no = survey_question.question_no', 'left')
                ->join("`tbl_survey_question_type` as `survey_type` ", ' survey_question.type_id_fk = survey_type.id', 'left')
                ->where("`survey_response`.`id`", $response_id)
                ->where("`survey_question`.`survey_fk_id`", $survey_id)
                ->where("`survey_response`.`survey_res_status`", $status)
                ->group_by('question_response_id')
                ->order_by('question_response_id', 'ASC')
                ->get();
        return $final_query->result_array();
    }

}

?>
