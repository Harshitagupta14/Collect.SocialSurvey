<?php $this->load->view($this->config->item('public_folder_name') . '/header'); ?> 
<ol class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
    <li class="active">Insert Address</li>
</ol>
<div class="mid_panel">
    <?php if (!empty($message)) { ?>
        <div id="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>            

    <div class="row">
        <div id="profile_tab">
            <ul class="profile_nav">
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">Update Profile</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">My Order History</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-email') ?>">Change Email</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/addresses') ?>">Addresses</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/create-address') ?>">Add New Address</a></li>
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/logout') ?>">Logout</a></li>
            </ul>
            <div class="profile_content">
                <div id="tab01">
                    <form class="form-horizontal" method="post" action="<?= site_url($this->config->item('public_login_url') . '/create-address') ?>">
                        <fieldset>                        
                            <legend>Address Alias</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name of your address:</label>
                                <div class="col-sm-6">
                                    <input type="text" id="alias" name="insert_alias" value="<?php echo set_value('insert_alias');?>" class="form-control" required>
                                </div>
                            </div>                        
                        </fieldset>
                        <fieldset>
                            <legend>Recipient Details</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Recipient Name:</label>
                                <div class="col-sm-6">
                                   <input type="text" id="recipient" name="insert_recipient" value="<?php echo set_value('insert_recipient');?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phone Number:</label>
                                <div class="col-sm-6">
                                    <input type="text" id="phone_number" name="insert_phone_number" value="<?php echo set_value('insert_phone_number');?>" class="form-control" required>
                                </div>
                            </div>                        
                        </fieldset>
                        <fieldset>
                            <legend>Address Details</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Landmark:</label>
                                <div class="col-sm-6">
                                   <input type="text" id="landmark" name="insert_landmark" value="<?php echo set_value('insert_landmark');?>" class="form-control" required>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address:</label>
                                <div class="col-sm-6">
                                    <textarea name="insert_address" id="address" class="form-control"><?php echo set_value('insert_address');?></textarea>                           
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">City / Town:</label>
                                <div class="col-sm-6">
                                   <input type="text" id="city" name="insert_city" value="<?php echo set_value('insert_city');?>" class="form-control" required>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State:</label>
                                <div class="col-sm-6">
                                    <input type="text" id="county" name="insert_county" value="<?php echo set_value('insert_county');?>" class="form-control" required>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Post Code:</label>
                                <div class="col-sm-6">
                                    <input type="text" id="post_code" name="insert_post_code" value="<?php echo set_value('insert_post_code');?>" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Country:</label>
                                <div class="col-sm-6">
                                     <p class="help-block">India</p>
                                     <p class="note">
                                         Note: Our Service available only in india.
                                     </p> 
                                </div>
                            </div>                                                                            
                        </fieldset>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                               <input type="submit" name="create_address" id="submit" value="Submit" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div> 

<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?> 
