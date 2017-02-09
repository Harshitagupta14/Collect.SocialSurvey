<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Account</a></li>
            <li class="active">Upload Identity Image</li>
        </ol>
       

        <div class="row">
         
            <div class="col-sm-12 page-content">
                <div class="inner-box">
                    <form class="form-horizontal" method="post" action="<?= site_url($this->config->item('public_login_url') . '/upload-identity-image') ?>" enctype="multipart/form-data">
                       
                        <fieldset>
                            <legend>Upload Identity Image</legend>
								<div class="required">
									<input name="register_identity_image" class="input-md" type="file">
									<span class="help-block" style="color: red;"><?= strip_tags(form_error('register_identity_image')) ?></span>
								</div>
                        </fieldset>

                        <div>
                         
                                <input type="submit" name="update_account" id="submit" value="Submit" class="btn btn-primary"/>
                           
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>
