<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?> 
<section class="content_section">
    <div class="container">
        <div class="page-heading">
            <h1>Change Forgotten Password</h1>
            <ol class="breadcrumb">
                <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
                <li class="active">Reset Password</li>
            </ol>
        </div>
   <div class="row">
            <div class="contact-address col-sm-6">
                <img src="<?= site_url('assets/uploads/site_images') ?>/forgot-password.gif" />
            </div>

            <div class="contact-form col-sm-6">
                <?php if (!empty($message)) { ?>
                    <?php echo $message; ?>
                <?php } ?>
       
            <form id="update_forgotten_password_form" method="post">
                <div class="form-group">
                    <label class="control-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control " placeholder="New Password" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Confirm New Password</label>
                    <input type="password" name="confirm_new_password" class="form-control " placeholder="Confirm New Password"/>
                </div>

                <div class="form-group">
                    <input type="submit" name="change_forgotten_password" value="Submit" class="btn btn-primary btn-lg"/>
                </div>
            </form>

        
    </div>
   </div>
    </div></section>

<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?>