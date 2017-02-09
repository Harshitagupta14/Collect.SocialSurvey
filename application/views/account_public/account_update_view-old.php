<?php $this->load->view($this->config->item('public_folder_name') .'/header'); ?> 

<div class="content_wrap main_content_bg">
    <div class="content clearfix">
        <div class="col100">
            <?php if (!empty($message)) { ?>
                <div id="message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            
            <section class="main-section" id="innercontent">
    <div class="container">
        <div id="profile_tab">
            <ul class="profile_nav">
                <li><a href="#tab01">My Profile</a></li>
                <li><a href="#tab02">My Order History</a></li>
                <li><a href="#tab03">Change Password</a></li>
                <li><a href="#tab04">Lorem Ipsum</a></li>
            </ul>
            <div class="profile_content">
                <div id="tab01">
                    <form class="form-horizontal" method="post" action="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">
                        <fieldset>                        
                            <legend>Personal Information Edit</legend>
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
                                    <input type="text" id="phone_number" name="update_phone_number" value="<?php echo set_value('update_phone_number',$user['upro_phone']);?>" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subscribe to Newsletter:</label>
                                <div class="col-sm-9">
                                   <input type="checkbox" id="newsletter" name="update_newsletter" value="1" <?php echo set_checkbox('update_newsletter',1,$newsletter); ?>/>
                                </div>
                            </div>                        
                        </fieldset>
                        <fieldset>
                            <legend>Login Details</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="update_email" value="<?php echo set_value('update_email',$user[$this->flexi_auth->db_column('user_acc', 'email')]);?>" class="form-control ">
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Username:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="username" name="update_username" value="<?php echo set_value('update_username',$user[$this->flexi_auth->db_column('user_acc', 'username')]);?>" class="form-control ">
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password:</label>
                              <a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a>
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
</section>
        </div>
    </div>
</div>	
<?php $this->load->view($this->config->item('public_folder_name') .'/footer'); ?> 
