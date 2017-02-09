<?php $this->load->view($this->config->item('public_folder_name') . '/header'); ?> 
<ol class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
    <li class="active">Addresses View</li>
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
                                <form class="form-horizontal">
                                    <div class="row">
                                        <?php 
                                
                                        if (!empty($addresses)) {
					 foreach ($addresses as $address) {
						?>
                                        <div class="col-md-4">
                                            <address class="well">
                                                <div class="btn-group">                                            
<!--                                                    <a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-remove"></i></a>-->
                                                    <button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-remove"></i></button>
                                                </div>
                                                <p><big><?php echo $address['uadd_alias'];?></big></p>
                                                <h4><?php echo $address['uadd_recipient'];?></h4>
                                                <p><?php echo $address['uadd_address'];?><br>
                                                    <?php echo $address['uadd_city'];?> - <?php echo $address['uadd_post_code'];?><br>
                                                    <?php echo $address['uadd_county'];?></p>
                                                <p>Phone : <strong><?php echo $address['uadd_phone'];?></strong></p> 
                                                <a href="" class="btn btn-primary btn-block">Make It Default</a>
                                            </address>
                                        </div>                                        
                                        <?php }} else {?>
                                                 <div class="col-md-4">
                                            <address class="well">
                                               <p>There are no addresses in your address book</p>
                                            </address>
                                        </div> 
                                     <?php }?>                                          
                                    </div>     
                                </form>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?> 
