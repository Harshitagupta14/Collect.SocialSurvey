<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
            <li class="active">Update Email</li>
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
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a></li>
                                        <li  class="active"><a href="<?= site_url($this->config->item('public_login_url') . '/update-email') ?>">Change Email</a></li>
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
                        <legend>Change Email via Email Verification</legend>
                        <form action="<?= site_url($this->config->item('public_login_url') . '/update-email') ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Email Address:</label>
                                <div class="col-sm-6">
                                    <input type="email" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="submit" name="update_email" id="submit" value="Submit" class="btn btn-primary"/>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>

            </div>

        </div>

    </div>
    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>
