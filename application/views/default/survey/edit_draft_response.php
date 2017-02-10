<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<style>
    .question-active{background-color:#32c5d2;}
    .question-row{ margin-left: -12px; margin-right: -12px;}
</style>
<style>
    .question-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0,0,0,0.1);
        z-index: 100001;
        display:none;
    }
    .question-modal {
        width: 300px;
        height: 200px;
        line-height: 200px;
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        margin-left: -150px;
        background-color: #46545f;
        border-radius: 5px;
        text-align: center;
        z-index: 11;
        display:none;/* 1px higher than the overlay layer */
    }
    .question-required-label:after {
        content:"*";
        color:red;
        float:right;
        margin-top:10px;
    }
    .overflow{overflow:auto !important;}
    .question-response-actions{
        padding: 2px;
        text-align: center;
        position: fixed;
        width:100%;
        right:0px;
        bottom:0px;
        display: block;
        z-index:10001;
        background-color: rgb(255, 255, 255);
    }
    @media screen and (min-width: 1024px) {
        .question-response-actions{ width: calc(100% - 196px); }
    }
</style>
<!-- END PAGE LEVEL PLUGINS -->

<div class="page-content-wrapper">
    <div class="page-content overflow">
        <div class="question-overlay"></div>
        <div class="question-modal"></div>

        <div class="col-md-6">
            <h1 class="page-title"> <?php echo ucfirst($survey_data['survey_title']); ?>
                <small>Survey</small>
            </h1>

            <div id="survey-questions-block">

                <form method="post" id="survey_response_form" >
                    <input type="hidden" value="<?php echo $survey_id; ?>" name="survey_id" />
                    <input type="hidden" value="<?php echo count($survey_question_data); ?>" name="total_question" id="total_question" />
                    <?php foreach ($survey_question_data as $key => $value) { ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class=" icon-social-twitter font-dark hide"></i>
                                            <span class="badge badge-default" id="question_<?php echo $value['question_no']; ?>_badge"> <?php echo $value['question_no']; ?> </span>
                                            <span class="caption-subject font-dark bold uppercase"><?php echo $value['type_name']; ?></span>
                                        </div>
                                        <span class="question-required-label"></span>
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
                                                                        <input type="hidden" id="question_title_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_title']; ?>" />
                                                                        <input type="hidden" id="question_help_text_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_help_text']; ?>" />
                                                                        <input type="hidden" id="question_one_word_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_one_word']; ?>" />
                                                                        <input type="hidden" id="question_limit_lower_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_limit_lower']; ?>" />
                                                                        <input type="hidden" id="question_limit_upper_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_limit_upper']; ?>" />
                                                                        <input type="hidden" id="question_multiple_options_<?php echo $value['question_no']; ?>" value="<?php echo $value['question_multiple_options']; ?>" />
                                                                        <input type="hidden" id="question_type_<?php echo $value['question_no']; ?>" value="<?php echo $value['type_name']; ?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-action-row">
                                                                <div class="col-md-12" style="padding-top:10px;">
                                                                    <!-- input-group -->
                                                                    <a class="input-group" data-toggle="modal" href="#modal_<?php echo $value['question_no']; ?>" onclick="create_modal(<?php echo $value['question_no']; ?>);" data-question-type="<?php echo $value['type_name']; ?>" style="cursor:pointer;" onclick="create_modal(<?php echo $value['question_no']; ?>);">
                                                                        <input class="form-control" id="response_<?php echo $value['question_no']; ?>" name="response_<?php echo $value['question_no']; ?>" placeholder="" readonly="" type="text" style="cursor:pointer;" >
                                                                        <span class="input-group-btn">
                                                                            <i class="btn blue fa fa-arrow-right"></i>
                                                                        </span>
                                                                    </a>
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
            <button type="button" class="btn btn-success" id="save_question_response" onclick="publish_question_response();" style="width:49%;"><i class="icon-cloud-upload"></i> Save</button>
        </div>

    </div>

    <div id="modals">
    </div>
</div>


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.id);
            reader.onload = function (e) {
                $('#' + input.id + '_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $this->config->item('adminassets'); ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?= $this->config->item('adminassets'); ?>global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?= $this->config->item('adminassets'); ?>global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
<script type="text/javascript">
    function display_error(error_message) { //common function for displayinga ll the error
        'use strict';
        var snackbarContainer = document.querySelector('#toast-notify');
        'use strict';
        var data = {message: error_message};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
    }
</script>
<div id="modals">

</div>
<script>

    function create_modal(id, question_type) {

        if (document.getElementById('modal_' + id) === null) {

            var content_body = create_response_body(id);
            console.log(content_body);
            var modal_div = document.createElement('div');
            modal_div.className = 'modal fade';
            modal_div.setAttribute('id', 'modal_' + id);
            var modal_header = document.createElement('div');
            modal_header.className = 'modal-header';
            var modal_dimiss_btn = document.createElement('button');
            modal_dimiss_btn.className = 'close';
            modal_dimiss_btn.setAttribute('type', 'button');
            modal_dimiss_btn.setAttribute('data-dismiss', 'modal');
            modal_dimiss_btn.setAttribute('aria-hidden', 'true');
            var modal_title = document.createElement('h4');
            modal_title.className = 'modal-title';
            modal_title.innerHTML = document.getElementById("question_title_" + id).value;
            modal_header.appendChild(modal_dimiss_btn);
            modal_header.appendChild(modal_title);
            var modal_body = document.createElement('div');
            modal_body.className = 'modal-body';
            var modal_body_row = document.createElement('div');
            modal_body_row.className = 'row';
            var modal_footer = document.createElement('div');
            modal_footer.className = 'modal-footer';
            modal_body.appendChild(modal_body_row);
            var modal_close_btn = document.createElement('button');
            modal_close_btn.className = 'btn btn-outline dark';
            modal_close_btn.setAttribute('type', 'button');
            modal_close_btn.setAttribute('id', 'close_modal_btn_' + id);
            modal_close_btn.setAttribute('data-dismiss', 'modal');
            modal_close_btn.setAttribute('aria-hidden', 'true');
            modal_close_btn.innerHTML = "Close";
            var modal_save_btn = document.createElement('button');
            modal_save_btn.className = 'btn btn-outline btn-primary';
            modal_save_btn.setAttribute('type', 'button');
            modal_save_btn.setAttribute('onclick', 'save_response(' + id + ')');
            modal_save_btn.innerHTML = "Save";
            modal_footer.appendChild(modal_save_btn);
            modal_footer.appendChild(modal_close_btn);
            modal_div.appendChild(modal_header);
            modal_div.appendChild(modal_body);
            modal_body.appendChild(modal_body_row);
            modal_body_row.appendChild(content_body);
            modal_div.appendChild(modal_footer);
            document.querySelector('.page-content-wrapper').insertBefore(modal_div, document.getElementById('modals'));
            document.querySelector('#modal_' + id).click();
        } else {
            document.querySelector('#modal_' + id).click();
        }

    }

    function create_response_body(id) {
        var question_type = document.querySelector('#question_type_' + id).value;
        if (question_type == "SUBJECTIVE") {
            return create_response_subjective(id);
        } else if (question_type == "MULTIPLE CHOICE") {
            return create_response_multiple_choice(id);
        }

    }

    function create_response_subjective(id) {
        var modal_body_subjective_col = document.createElement('div');
        modal_body_subjective_col.className = 'col-md-12';
        var question_help_text = document.querySelector('#question_help_text_' + id).value;
        var modal_body_subjective_content_label = document.createElement('label');
        modal_body_subjective_content_label.innerHTML = question_help_text;
        var modal_body_subjective_content = document.createElement('input');
        modal_body_subjective_content.className = 'form-control';
        modal_body_subjective_content.setAttribute('id', 'modal_response_' + id);
        modal_body_subjective_content.setAttribute('type', 'text');
        modal_body_subjective_content.setAttribute('placeholder', 'Type your answer');
        modal_body_subjective_col.appendChild(modal_body_subjective_content_label);
        modal_body_subjective_col.appendChild(modal_body_subjective_content);
        return modal_body_subjective_col;
    }

    function create_response_multiple_choice(id) {

        var modal_body_subjective_col = document.createElement('div');
        modal_body_subjective_col.className = 'col-md-12';
        var question_multiple_options = document.querySelector('#question_multiple_options_' + id).value;
        question_multiple_options = question_multiple_options.split(",");
        var question_limit_lower = document.querySelector('#question_limit_lower_' + id).value;
        var question_limit_upper = document.querySelector('#question_limit_upper_' + id).value;
        var modal_body_multiple_choice_checkbox_help_label = document.createElement('label');
        modal_body_multiple_choice_checkbox_help_label.innerHTML = "<b style='color:orange;'>" + question_limit_upper + " out of " + question_multiple_options.length + "</b>";
        var modal_body_multiple_choice_checkbox_list_div = document.createElement('div');
        modal_body_multiple_choice_checkbox_list_div.className = 'mt-checkbox-list';
        for (var i = 0; i < question_multiple_options.length; i++) {

            var modal_body_multiple_choice_checkbox_label = document.createElement('label');
            modal_body_multiple_choice_checkbox_label.className = 'mt-checkbox mt-checkbox-outline';
            var modal_body_multiple_choice_checkbox_input = document.createElement('input');
            modal_body_multiple_choice_checkbox_input.setAttribute('type', 'checkbox');
            modal_body_multiple_choice_checkbox_input.setAttribute('name', 'modal_response_' + id);
            modal_body_multiple_choice_checkbox_input.setAttribute('value', question_multiple_options[i]);
            modal_body_multiple_choice_checkbox_input.setAttribute('onclick', 'multiple_choice_restriction(' + id + ',' + question_limit_upper + ')');
            var checbox_name = document.createTextNode(question_multiple_options[i]);
            var modal_body_multiple_choice_checkbox_span = document.createElement('span');
            modal_body_multiple_choice_checkbox_label.appendChild(modal_body_multiple_choice_checkbox_input);
            modal_body_multiple_choice_checkbox_label.appendChild(checbox_name);
            modal_body_multiple_choice_checkbox_label.appendChild(modal_body_multiple_choice_checkbox_span);
            modal_body_multiple_choice_checkbox_list_div.appendChild(modal_body_multiple_choice_checkbox_label);
        }

        modal_body_subjective_col.appendChild(modal_body_multiple_choice_checkbox_help_label);
        modal_body_subjective_col.appendChild(modal_body_multiple_choice_checkbox_list_div);
        return modal_body_subjective_col;
    }

    function multiple_choice_restriction(id, upperlimit) {
        var maxCheckboxes = upperlimit;
        $('input[name="modal_response_' + id + '"]').change(function () {
            var checkedNum = $('input[name="modal_response_' + id + '"]:checked').length;
            var allCheckoxesChecked = $('input[name="modal_response_' + id + '"]:checked');
            var allCheckboxes = $('input[name="modal_response_' + id + '"]');
            //alert(checkedNum + " - " + maxCheckboxes);

            if (checkedNum == maxCheckboxes) {
                $(allCheckboxes).attr('disabled', 'disabled');
                $(allCheckoxesChecked).removeAttr('disabled');
                $(allCheckoxesChecked).attr('checked', 'checked');
                alert("You have already checked maximum options allowed!");
            } else {
                $(allCheckboxes).removeAttr('disabled');
            }

        });
    }

    function save_response(id) {
        var question_type = document.querySelector('#question_type_' + id).value;
        if (question_type == "SUBJECTIVE") {
            var response = document.querySelector('#modal_response_' + id).value;
            document.querySelector('#response_' + id).value = response;
        } else if (question_type == "MULTIPLE CHOICE") {
            var response = [];
            $('input[name="modal_response_' + id + '"]:checked').each(function () {
                console.log(this.value);
                response.push(this.value);
                response.join('|');
            });
            document.querySelector('#response_' + id).value = response;
        }
        if (response != '') {
            document.querySelector('#question_' + id + '_badge').className = 'badge badge-success';
        } else {
            display_error("Empty Response , Unable to Save.");
        }
        document.querySelector('#close_modal_btn_' + id).click();
    }

    function exit_question_response() {
        if (confirm("Are you sure? All changes will be lost.") == true) {
            window.location.href = '<?php echo site_url('dashboard'); ?>';
            return false;
        }
    }

    function publish_question_response() {
        var valid = validate_survey_response();
        if (valid == true) {
            var str = $("#survey_response_form").serialize();
            console.log(str);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "ajax-publish-survey-response",
                dataType: 'json',
                data: {str: str},
                beforeSend: function () {
                    $('.question-overlay').show();
                    $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_1.gif" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:#fff;">Publishing Response , Please wait...</p>');
                    $('.question-modal').show();
                },
                success: function (stat) {
                    //var response = stat.responseText;
                    //var data = JSON.parse(response);
                    console.log(stat);
                    if (stat.success === "true") {
                        $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_1.gif" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:green;">Publishing Response Done...</p>');
                        setTimeout(function () {
                            $('.question-overlay').hide();
                            $('.question-modal').html('');
                            $('.question-modal').hide();
                        }, 2000);
                        window.location.href = '<?php echo site_url('dashboard'); ?>';
                    } else if (stat.success === "false") {
                        $('.question-modal').html('<img class="alignleft wp-image-725 size-full" draggable="false" src="http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_1.gif" alt="Loading icon cube" width="64" height="64"><p style="margin:-130px 0 16px; color:green;">Publishing Response Unsuccessfull, Try again. ...</p>');
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
            alert(valid);
        }
    }

    function validate_survey_response() {
        var reponse_invalid_list = [];
        var valid = true;
        var total_question = document.querySelector('#total_question').value;
        for (var i = 1; i <= total_question; i++) {
            var response = document.querySelector('#response_' + i).value;
            if (response == '') {
                reponse_invalid_list.push(i);
                valid = false;
            }
        }
        return valid;
    }
</script>
