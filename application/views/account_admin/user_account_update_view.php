<?php $this->load->view($this->config->item('adminFolderName') . '/header'); ?> 
<ul class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('admin_login_url') . '/dashboard') ?>">Home</a></li>
    <li class="active">Update User Account</li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title">Update Account of <?php echo $user['upro_first_name'] . ' ' . $user['upro_last_name']; ?></h3>        
                        <div class="pull-right">
                            <a href="<?php echo site_url($this->config->item('admin_login_url') . '/user-management') ?>"  class="btn btn-primary btn-lg">Manage User Accounts</a>
                        </div>
                    </div>
                    <?php if (!empty($message)) { ?>
                        <div role="alert" class="alert alert-danger">
                            <?php echo $message; ?>
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
                                        <input type="text" id="first_name" name="update_first_name" class="form-control" value="<?php echo set_value('update_first_name', $user['upro_first_name']); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last Name:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" id="last_name" name="update_last_name" class="form-control" value="<?php echo set_value('update_last_name', $user['upro_last_name']); ?>"/>
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
                                        <input type="text" id="phone_number" name="update_phone_number" class="form-control" value="<?php echo set_value('update_phone_number', $user['upro_phone']); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Subscribe to Newsletter</label>
                                <div class="col-md-9 col-xs-12">  
                                    <?php $newsletter = ($user['upro_newsletter'] == 1); ?>		
                                    <input type="checkbox" name="update_newsletter" value="1" <?php echo set_checkbox('update_newsletter', '1', $newsletter); ?>/>
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
                                        <input type="text" id="email_address" name="update_email_address" class="form-control" value="<?php echo set_value('update_email_address', $user[$this->flexi_auth->db_column('user_acc', 'email')]); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Username:</label>
                                <div class="col-md-6 col-xs-12">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" id="username" name="update_username" class="form-control" value="<?php echo set_value('update_username', $user[$this->flexi_auth->db_column('user_acc', 'username')]); ?>"/>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Group:</label>
                                <div class="col-md-6 col-xs-12">                                                                                            
                                    <select class="form-control" name="update_group">     
                                        <option value="">Select Group</option>
                                        <?php foreach ($groups as $group) { ?>
                                            <?php $user_group = ($group[$this->flexi_auth->db_column('user_group', 'id')] == $user[$this->flexi_auth->db_column('user_acc', 'group_id')]) ? TRUE : FALSE; ?>
                                            <option value="<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')]; ?>" <?php echo set_select('update_group', $group[$this->flexi_auth->db_column('user_group', 'id')], $user_group); ?>><?php echo $group[$this->flexi_auth->db_column('user_group', 'name')]; ?></option>
                                        <?php } ?>
                                    </select>                    
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>                         
                        <input type="submit" name="update_users_account" id="submit" value="Submit" class="btn btn-primary pull-right"/>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>
<?php $this->load->view($this->config->item('adminFolderName') . '/footer'); ?> 