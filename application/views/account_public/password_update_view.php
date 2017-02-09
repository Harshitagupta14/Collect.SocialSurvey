<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
            <li class="active">Change Password</li>
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
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">Update Profile</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/order-history') ?>">My Order History</a></li>
                                        <li class="active"><a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a></li>
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
                    <fieldset>
                        <legend>Change Password</legend>
                        <form action="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Current Password</label>
                                <div class="col-sm-6">
                                    <input type="password" id="current_password" name="current_password" value="<?php echo set_value('current_password'); ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Paswword</label>
                                <div class="col-sm-6">
                                    <input type="password" id="new_password" name="new_password" value="<?php echo set_value('new_password'); ?>" class="form-control" required>
                                    <div class="help-block">Password length must be more than 8 characters in length. Only alpha-numeric, dashes, underscores, periods and comma characters are allowed.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Confirm Paswword</label>
                                <div class="col-sm-6">
                                    <input type="password" id="confirm_new_password" name="confirm_new_password" value="<?php echo set_value('confirm_new_password'); ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="submit" name="change_password" id="submit" value="Update" class="btn btn-primary"/>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>

            </div>

        </div>

    </div>
    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>







