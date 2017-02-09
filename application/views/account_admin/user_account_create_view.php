<?php $this->load->view($this->config->item('adminFolderName') . '/header'); ?> 
<ul class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('admin_login_url') . '/dashboard') ?>">Home</a></li>
    <li class="active">Create User Account</li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title">Create User Account</h3>        
                        <div class="pull-right">
                            <a href="<?php echo site_url($this->config->item('admin_login_url') . '/user-management') ?>"  class="btn btn-primary btn-lg">Manage User Accounts</a>
                        </div>
                    </div>
                    <?php if (!empty($message)) { ?>
                        <div role="alert" class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty(validation_errors())) { ?>
                        <div role="alert" class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <div class="panel-body">
                        <fieldset>
                            <legend>Personal Details</legend>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">First Name:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" id="first_name" name="register_first_name" class="form-control" value="<?php echo set_value('register_first_name'); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last Name:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" id="last_name" name="register_last_name" class="form-control" value="<?php echo set_value('register_last_name'); ?>"/>
                                    </div>     
                                </div>
                            </div>                    
                        </fieldset>
                        <fieldset>
                            <legend>Contact Details</legend>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Phone Number:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" id="phone_number" name="register_phone_number" class="form-control" value="<?php echo set_value('register_phone_number'); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Subscribe to Newsletter</label>
                                <div class="col-md-9 col-xs-12">  	
                                    <input type="checkbox" name="register_newsletter" value="1" <?php echo set_checkbox('register_newsletter', '1'); ?>/>
                                </div>                        
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Login Details</legend>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email Address:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="register_email_address" class="form-control" value="<?php echo set_value('register_email_address'); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Password:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" class="form-control" name="register_password" value="<?php echo set_value('register_password'); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Confirm Password:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" class="form-control" name="register_confirm_password" value="<?php echo set_value('register_confirm_password'); ?>"/>
                                    </div>     
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>
                        <input type="submit" name="register_user" value="Submit" class="btn btn-primary pull-right"/>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>
<?php $this->load->view($this->config->item('adminFolderName') . '/footer'); ?>