<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
            <li class="active">Update Profile</li>
        </ol>
        <?php if (!empty($message)) { ?>
            <div id="message">
                <?php echo $message; ?>
            </div
        <?php } ?>

        <div class="row">
            <div class="col-sm-3 page-sidebar">
                <aside>
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> My Account <a href="#MyClassified" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                                <div class="panel-collapse collapse in" id="MyClassified">
                                    <ul class="acc-list">

                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>"> <i class="icon-home"></i> Dashboard</a></li>
                                        <li class="active"><a href="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">Update Profile</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/order-history') ?>">My Order History</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-email') ?>">Change Email</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/logout') ?>">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <form class="form-horizontal" method="post" action="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">
                        <fieldset>
                            <legend>Personal Information</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">First Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="first_name" name="update_first_name" value="<?php echo set_value('update_first_name', $user['upro_first_name']); ?>" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="last_name" name="update_last_name" value="<?php echo set_value('update_last_name', $user['upro_last_name']); ?>" class="form-control ">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Contact Details</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number', $user['upro_phone']); ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subscribe to Newsletter:</label>
                                <div class="col-sm-9">
                                    <?php $newsletter = ($user['upro_newsletter'] == 1); ?>
                                    <input type="checkbox" id="newsletter" name="update_newsletter" value="1" <?php echo set_checkbox('update_newsletter', 1, $newsletter); ?>/>
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="update_account" id="submit" value="Submit" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>
