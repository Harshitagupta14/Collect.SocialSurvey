<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $this->config->item('adminassets'); ?>pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <h3><i class="fa fa-users" style="margin-right: 10px; margin-left: 10px; margin-bottom:12px;"></i>Organization
            </h3>
        </div>


        <?php if ($this->session->flashdata('ProductSuccess')) { ?>
            <div class="alert alert-success"> <?= $this->session->flashdata('ProductSuccess') ?></div>
        <?php } ?>
        <style>
            //.profile-sidebar{width:350px;}
            .profile-stat-title{font-size:15px;}
            .profile-stat-text{font-size:10px;}
        </style>
        <!-- END PAGE HEADER-->
        <div class="row">

            <div class="col-md-4">
                <div class="btn-group btn-block" style="margin-bottom:5px !important;">
                    <a type="button" id="add_surveyor" data-toggle="modal" href="#surveyor_registration_modal"  class="btn btn-primary col-lg-12 col-sm-12 col-xs-12 col-md-12 ">
                        <span><i class="fa fa-plus m-r-5"></i> Add a new Surveyor</span>
                    </a>
                </div>
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-content">
                    <!-- PORTLET MAIN -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">

                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase"><?php echo $organization['upro_company']; ?></span>
                                        <span class="caption-helper hide">weekly stats...</span>
                                    </div>
                                </div>
                                <!-- END SIDEBAR USER TITLE -->
                                <!-- SIDEBAR BUTTONS -->

                                <div class="row list-separated profile-stat">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class=" profile-stat-title"> <?php echo $organization['upro_first_name']; ?> </div>
                                        <div class="uppercase profile-stat-text"> Owner Name </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class=" profile-stat-title"> Admin </div>
                                        <div class="uppercase profile-stat-text"> Role </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <div class=" profile-stat-title"> <?php echo $organization['upro_company_type']; ?> </div>
                                        <div class="uppercase profile-stat-text"> Organization Type  </div>
                                    </div>
                                </div>

                                <div class="profile-userbuttons">
                                    <div class="uppercase profile-stat-text"> Current Plan  </div>
                                    <button type="button" class="btn btn-circle red btn-sm"><i class="fa fa-exclamation-circle m-r-5"></i> Limited </button>
                                </div>

                                <!-- END SIDEBAR BUTTONS -->
                                <!-- SIDEBAR MENU -->
                                <div class="profile-usermenu" style="margin-top:20px;">
                                    <ul class="nav">
                                        <li class="active">
                                            <a href="<?php echo site_url('organization'); ?>">
                                                <i class="icon-home"></i> Overview </a>
                                        </li>
                                        <li>
                                            <a type="button"  data-toggle="modal" href="#organization_details_modal"  >
                                                <i class="icon-settings"></i> Organization Settings </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END MENU -->
                            </div>  </div>  </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="portlet light ">
                            <div class="uppercase profile-stat-title"> <?php echo count($organization_surveyor_data); ?> <a type="button" id="add_surveyor" data-toggle="modal" href="#surveyor_registration_modal" >
                                    <span><i class="fa fa-plus m-r-5"></i></span>
                                </a> </div>
                            <div class="uppercase profile-stat-text"> Auditors </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-2 col-md-5">
                    <div class="row">
                        <div class="portlet light ">
                            <div class="uppercase profile-stat-title"> 1 </div>
                            <div class="uppercase profile-stat-text"> Admin </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Your Surveyors</span>
                                        <span class="caption-helper hide">weekly stats...</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row number-stats margin-bottom-30">
                                        <div class="col-md-12 col-sm-6 col-xs-6">

                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                        <tr class="uppercase">
                                                            <th colspan="2"> MEMBER </th>
                                                            <th> USERNAME </th>
                                                            <th> EMAIL </th>
                                                            <th> CONTACT NUMBER </th>
                                                            <th> ACTION </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($organization_surveyor_data as $surveyor_data) { ?>
                                                            <tr>
                                                                <td class="fit">
                                                                    <i class="fa fa-user"></i> </td>
                                                                <td>
                                                                    <a href="javascript:;" class="primary-link"><?php echo $surveyor_data['upro_first_name'] . ' ' . $surveyor_data['upro_last_name']; ?></a>
                                                                </td>
                                                                <td><?php echo $surveyor_data['uacc_username']; ?></td>
                                                                <td> <?php echo $surveyor_data['uacc_email']; ?> </td>
                                                                <td> <?php echo $surveyor_data['upro_phone']; ?></td>
                                                                <td>
                                                                    <?php if ($surveyor_data['uacc_suspend'] == 0) { ?>
                                                                        <button class="btn btn-primary surveyor_action" data-userid="<?php echo $surveyor_data['uacc_id']; ?>" data-user-status="<?php echo $surveyor_data['uacc_suspend']; ?>"><i class="fa fa-lock"></i>SUSPEND</button>
                                                                    <?php } else { ?>
                                                                        <button class="btn btn-primary surveyor_action" data-userid="<?php echo $surveyor_data['uacc_id']; ?>" data-user-status="<?php echo $surveyor_data['uacc_suspend']; ?>"><i class="fa fa-unlock-alt"></i>ACTIVATE</button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody></table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="surveyor_registration_modal" class="modal fade" style="top:40%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">New Surveyor Registration</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surveyor_first_name">First Name:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="First Name" name="surveyor_first_name" id="surveyor_first_name" type="text">
                                <span class="input-group-addon">
                                    <i class="fa fa-user font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="surveyor_first_name_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="surveyor_contact_number">Contact Number:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Contact Number" name="surveyor_contact_number" id="surveyor_contact_number" type="text">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="surveyor_contact_number_error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surveyor_last_name">Last Name:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Last Name" name="surveyor_last_name" id="surveyor_last_name" type="text">
                                <span class="input-group-addon">
                                    <i class="fa fa-user font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="surveyor_last_name_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surveyor_email">Email Address:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Email Address" type="text" name="surveyor_email" id="surveyor_email">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="surveyor_email_error"></span>
                        </div>
                    </div> <div class="col-md-6">
                        <div class="form-group">
                            <label for="surveyor_password">Password</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Password" name="surveyor_password" id="surveyor_password" type="password">
                                <span class="input-group-addon">
                                    <i class="fa fa-key font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="surveyor_password_error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline dark">Close</button>
                <button type="button" class="btn btn-primary" id="register_surveyor">Add Surveyor</button>
            </div>
        </div>

        <div id="surveyor_login_details_modal" class="modal fade" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Surveyor Log-in Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p> Email:
                            <input class="form-control" id="surveyor_login_email" readonly="" type="text" disabled="">
                        </p>
                        <p> Username:
                            <input class="form-control" id="surveyor_login_username" readonly="" type="text" disabled="">
                        </p>
                        <p> Password:
                            <input class="form-control" id="surveyor_login_password" readonly="" type="text" disabled="">
                        </p>
                    </div>
                    <div class="col-md-12"><p id="surveyor_login_help" style="color:green"></p></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
            </div>
        </div>

        <div id="organization_details_modal" class="modal fade" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Organization Details Edit</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6"> <h2>Welcome,<br><b class="overflow-ellipsis" id="first_name"><?php echo $organization['upro_first_name']; ?></b></h2>
                        <p>Before you continue,help us know about your organization so that we can help customize your experience for data collection.</p></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="organization_name">Organization Name:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Organization Name" name="organization_name" id="organization_name" value="<?php echo $organization['upro_company']; ?>" type="text">
                                <span class="input-group-addon">
                                    <i class="fa fa-building-o font-red"></i>
                                </span>
                            </div>
                            <span class="error-block" style="color: red;" id="organization_name_error"></span>
                        </div>
                        <?php $organization_type = array('0' => 'Non-profit Organization', '1' => 'Private Limited Company', '2' => 'Social Enterprise', '3' => 'Citizen Group/Project Team', '4' => 'Other'); ?>
                        <div class="form-group">
                            <label for="organization_type">Organization Type:</label>
                            <div class="input-group">
                                <select class="form-control" placeholder="Organization Type" name="organization_type" id="organization_type" >
                                    <?php foreach ($organization_type as $type) { ?>
                                        <option value="<?php echo $type; ?>" <?php if ($type == $organization['upro_company_type']) { ?>selected="selected" <?php } ?>><?php echo $type; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <span class="error-block" style="color: red;" id="organization_type_error"></span>
                        </div>
                    </div>
                    <div class="col-md-12"><p id="surveyor_login_help" style="color:green"></p></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-orgainization-id="<?php echo $organization['uacc_id']; ?>" id="update_organization" class="btn btn-outline btn-primary">Update</button>
                <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
            </div>
        </div>
    </div>
    <!-- END PORTLET MAIN -->
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
    $("#create_survey").click(function (event) {
        event.preventDefault();
        var valid = validate_form();
        if (valid) {
            $("#survey_form").submit();
        }
    });
    function validate_form() {
        var survey_title = $("#survey_title").val();
        if (survey_title == '') {
            var error = "TITLE OF THE SURVEY IS A REQUIRED FIELD";
            display_error(error);
            return false;
        }
        return true;
    }
</script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $this->config->item('adminassets'); ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= $this->config->item('adminassets'); ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
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
<script>
    $("#add_surveyor").click(function (e) {
        e.preventDefault();
        reset_surveyor_registration();
    });

    $("#register_surveyor").click(function (e) {
        e.preventDefault();
        var surveyor_first_name = $('#surveyor_first_name').val();
        var surveyor_contact_number = $('#surveyor_contact_number').val();
        var surveyor_last_name = $('#surveyor_last_name').val();
        var surveyor_email = $('#surveyor_email').val();
        var surveyor_password = $('#surveyor_password').val();
        //var valid = validate_form();
        var valid = true;
        if (valid) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "ajax-register-surveyor",
                dataType: 'json',
                data: {'surveyor_first_name': surveyor_first_name, 'surveyor_contact_number': surveyor_contact_number, 'surveyor_last_name': surveyor_last_name, 'surveyor_email': surveyor_email, 'surveyor_password': surveyor_password},
                //beforeSend: function () {},
                complete: function (stat) {
                    var response = stat.responseText;
                    var data = JSON.parse(response);
                    console.log(data);
                    if (data.success === "true") {
                        $('#surveyor_login_email').val(data.email);
                        $('#surveyor_login_username').val(data.username);
                        $('#surveyor_login_password').val(data.password);
                        $('#surveyor_login_help').html('** Surveyor <b>' + data.username + '</b> can start collecting survey using the mentioned Username/Email , Password combination.');
                        $('#surveyor_registration_modal').modal('toggle');
                        $('#surveyor_login_details_modal').modal('toggle');
                    } else if (data.success === "false") {
                        $('#surveyor_first_name_error').html(data.surveyor_first_name_error);
                        $('#surveyor_last_name_error').html(data.surveyor_last_name_error);
                        $('#surveyor_contact_number_error').html(data.surveyor_contact_number_error);
                        $('#surveyor_email_error').html(data.surveyor_email_error);
                        $('#surveyor_password_error').html(data.surveyor_password_error);
                    }

                }
            });
        }
    }
    );
    function reset_surveyor_registration() {
        $('#surveyor_first_name').val('');
        $('#surveyor_contact_number').val('');
        $('#surveyor_last_name').val('');
        $('#surveyor_email').val('');
        $('#surveyor_password').val();
        $('#surveyor_first_name_error').html('');
        $('#surveyor_last_name_error').html('');
        $('#surveyor_contact_number_error').html('');
        $('#surveyor_email_error').html('');
        $('#surveyor_password_error').html('');
    }

    //Reload the page once login detail modal is closed
    $('#surveyor_login_details_modal').on('hidden.bs.modal', function () {
        window.location.reload(true);
    });

    $(".surveyor_action").click(function (e) {
        e.preventDefault();
        var userid = $(this).attr('data-userid');
        var user_status = $(this).attr('data-user-status');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax-change-surveyor-status",
            dataType: 'json',
            data: {'surveyor_id': userid, 'surveyor_status': user_status},
            //beforeSend: function () {},
            complete: function (stat) {
                var response = stat.responseText;
                var data = JSON.parse(response);
                console.log(data);
                if (data.success === "true") {
                    if (data.status === "Activated") {
                        $('.surveyor_action[data-userid="' + userid + '"]').html('<i class="fa fa-lock"></i>SUSPEND');
                        $('.surveyor_action[data-userid="' + userid + '"]').attr('data-user-status', 0);
                    } else if (data.status === "Suspended") {
                        $('.surveyor_action[data-userid="' + userid + '"]').html('<i class="fa fa-unlock-alt"></i>ACTIVATE');
                        $('.surveyor_action[data-userid="' + userid + '"]').attr('data-user-status', 1);
                    }
                } else if (data.success === "false") {

                }

            }
        });
    });


    $("#update_organization").click(function (e) {
        e.preventDefault();
        var userid = $(this).attr('data-orgainization-id');
        var organization_type = $('#organization_type option:selected').val();
        var organization_name = $('#organization_name').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax-update-organization-details",
            dataType: 'json',
            data: {'organization_id': userid, 'organization_type': organization_type, 'organization_name': organization_name},
            complete: function (stat) {
                var response = stat.responseText;
                var data = JSON.parse(response);
                console.log(data);
                if (data.success === "true") {
                    $('#organization_details_modal').modal('toggle');
                    window.location.reload();
                } else if (data.success === "false") {
                    $('#organization_details_modal').modal('toggle');
                    //alert("Error!!,Please try again later.");
                    //window.location.reload();
                }

            }
        });
    });
</script>