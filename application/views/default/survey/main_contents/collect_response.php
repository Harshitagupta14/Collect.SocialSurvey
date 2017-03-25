<div class="page-content-wrapper">
    <div class="page-content overflow">
        <div class="question-overlay"></div>
        <div class="question-modal"></div>

        <div class="col-md-12">
            <h1 class="page-title"> <?php echo ucfirst($survey_data['survey_title']); ?>
                <small>Survey</small>
            </h1>
            <div id="survey-questions-block">

                <form method="post" id="survey_response_form" >
                    <input type="hidden" value="<?php echo $id; ?>" name="survey_id" id="survey_id"/>
                    <input type="hidden" value="<?php echo count($survey_question_data); ?>" name="total_question" id="total_question" />
                    <?php foreach ($survey_question_data as $key => $value) { ?>
                        <div class="col-md-12">
                            <div class="row">
                                <?php if ($value['type_name'] != 'SECTION BREAK') { ?>
                                    <div class="portlet light ">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class=" icon-social-twitter font-dark hide"></i>
                                                <span class="badge badge-default" id="question_<?php echo $value['question_no']; ?>_badge"> <?php echo $value['question_no']; ?> </span>
                                                <span class="caption-subject font-dark bold uppercase"><?php echo $value['type_name']; ?></span>
                                            </div>
                                            <?php if ($value['question_mandatory'] == '1') { ?><span class="question-required-label"></span><?php } ?>
                                        </div>

                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_actions_pending">
                                                    <!-- BEGIN: Actions -->
                                                    <div class="mt-actions">
                                                        <div class="mt-action">
                                                            <div class="mt-action-body">
                                                                <div class="mt-action-row">
                                                                    <div class="mt-action-info ">
                                                                        <div class="mt-action-icon ">
                                                                            <i class="icon-magnet"></i>
                                                                        </div>
                                                                        <div class="mt-action-details ">
                                                                            <span class="mt-action-author"><?php echo $value['question_title']; ?></span>
                                                                            <p class="mt-action-desc"><?php echo (isset($value['question_help_text']) && $value['question_help_text'] != '') ? $value['question_help_text'] : 'Please Answer'; ?></p>
                                                                            <input type="hidden" id="question_mandatory_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_mandatory']; ?>" />
                                                                            <input type="hidden" id="question_title_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_title']; ?>" />
                                                                            <input type="hidden" id="question_help_text_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_help_text']; ?>" />
                                                                            <input type="hidden" id="question_one_word_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_one_word']; ?>" />
                                                                            <input type="hidden" id="question_limit_lower_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_limit_lower']; ?>" />
                                                                            <input type="hidden" id="question_limit_upper_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_limit_upper']; ?>" />
                                                                            <input type="hidden" id="question_multiple_options_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_multiple_options']; ?>" />
                                                                            <input type="hidden" id="question_type_<?php echo $value['question_no']; ?>" value="<?php echo $value['type_name']; ?>" name="question_type_<?php echo $value['question_no']; ?>"/>
                                                                            <input type="hidden" id="response_media_fk_id<?php echo $value['question_no']; ?>" value="<?php echo $value['response_media_fk_id']; ?>" name="response_media_fk_id<?php echo $value['question_no']; ?>"/>
                                                                            <input type="hidden" id="start_time" value="<?php echo date('H:i:s'); ?>" name="start_time"/>

                                                                            <input type="hidden" id="question_key_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_key']; ?>" name="question_key_<?php echo $value['question_no']; ?>" />

                                                                            <input type="hidden" id="response_media_fk_id<?php echo $value['question_no']; ?>" value="<?php echo $value['response_media_fk_id']; ?>" name="response_media_fk_id<?php echo $value['question_no']; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-row">
                                                                    <div class="col-md-12" style="padding-top:10px;">
                                                                        <!-- input-group -->
                                                                        <div class="form-group" id="response_form_group_<?php echo $value['question_no']; ?>">
                                                                            <a class="input-group" data-toggle="modal" href="#modal_<?php echo $value['question_no']; ?>" onclick="create_modal(<?php echo $value['question_no']; ?>);" data-question-type="<?php echo $value['type_name']; ?>" style="cursor:pointer;" onclick="create_modal(<?php echo $value['question_no']; ?>);">
                                                                                <input class="form-control" id="response_<?php echo $value['question_no']; ?>" name="response_<?php echo $value['question_no']; ?>" placeholder="" readonly="" type="text" style="cursor:pointer;" >
                                                                                <span class="input-group-btn">
                                                                                    <i class="btn blue fa fa-arrow-right"></i>
                                                                                </span>
                                                                            </a>
                                                                            <span class="help-block" style="display:none;" id="response_error_block_<?php echo $value['question_no']; ?>" >Please answer this question.</span>
                                                                            <!-- /input-group -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else if ($value['type_name'] == 'SECTION BREAK') { ?>
                                    <input type="hidden" id="question_mandatory_<?php echo $value['question_no']; ?>" value="0" />
                                    <div class="portlet light" style="background-color:#91BAE1 !important; padding:0px 20px 0px !important;">
                                        <div class="portlet-title" style="border-bottom:none !important; min-height: 0px !important; margin-bottom: 0px !important;">
                                            <div class="caption">
                                                <span class="caption-subject font-dark bold uppercase"><?php echo $value['type_name']; ?> </span><br/>
                                                <span class="section-break-title" style="font-size:14px;"><?php echo $value['question_title']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>
                </form>
            </div>
        </div>
        <div id="toast-notify" class="mdl-js-snackbar mdl-snackbar" style="bottom:40px;">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
        </div>

        <div class="question-response-actions">
            <button type="button" class="btn btn-danger" id="exit_question_response" onclick="exit_question_response();" style="width:49%;"><i class="icon-close"></i>Exit</button>
            <a type="button" id="add_surveyor" data-toggle="modal" href="#survey_response_save_options"  class="btn btn-success" style="width:49%;">Save</a>

        </div>

    </div>
    <div id="survey_response_save_options" class="modal fade" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Save Options</h4>
        </div>
        <div class="modal-body">
            <center>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" data-dismiss="modal" class="btn btn-outline btn-warning" onclick="save_question_response('draft_insert');" style="width:100%;">Save as Draft</button><br/>
                    </div>
                </div>
                <div class="row" style="margin-top:10%;">
                    <div class="col-md-12">
                        <button type="button" data-dismiss="modal" class="btn btn-outline btn-primary" onclick="save_question_response('publish_insert');" style="width:100%;">Publish</button>
                    </div>
                </div>
            </center>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
        </div>
    </div>
    <div id="modals"></div>
</div>
<script>
    var preloading_icon = '<?php echo $this->config->item('frontassets'); ?>images/Preloader_1.gif';
    function save_question_response(response_sumbit_status = '') {
        var valid = validate_survey_response();
        if (valid == true) {
            var str = $("#survey_response_form").serialize();
            str += '&survey_publish_status=' + response_sumbit_status;
            console.log(str);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "ajax-publish-survey-response",
                dataType: 'json',
                data: {str: str},
                beforeSend: function () {
                    $('.question-overlay').show();
                    $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="' + preloading_icon + '" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:#fff;">Publishing Response , Please wait...</p>');
                    $('.question-modal').show();
                },
                success: function (stat) {
                    //var response = stat.responseText;
                    //var data = JSON.parse(response);
                    console.log(stat);
                    if (stat.success === "true") {
                        $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="' + preloading_icon + '" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:green;">Publishing Response Done...</p>');
                        setTimeout(function () {
                            $('.question-overlay').hide();
                            $('.question-modal').html('');
                            $('.question-modal').hide();
                        }, 2000);
                        window.location.href = '<?php echo site_url('dashboard'); ?>';
                    } else if (stat.success === "false") {
                        $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="' + preloading_icon + '" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:green;">Publishing Response Unsuccessfull, Try again. ...</p>');
                        setTimeout(function () {
                            $('.question-overlay').hide();
                            $('.question-modal').html('');
                            $('.question-modal').hide();
                        }, 2000);
                    }
                },
                error: function (stat) {

                }
            });
        } else {
            alert("Please answer the questions marked with red.");
        }
    }
</script>
