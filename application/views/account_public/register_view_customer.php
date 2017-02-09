<?php $this->load->view($this->config->item('public_folder_name') . '/header'); ?>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2"><i class="icon-user-add"></i> Create customer account, Its free </h2>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?= site_url('account-customer') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-group required">
                                        <label class="col-md-4 control-label">You are a <sup>*</sup></label>
                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="customer_type" id="job-seeker" value="customer" checked>
                                                    Customer</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-md-4 control-label">First Name <sup>*</sup></label>
                                        <div class="col-md-6">
                                            <input name="register_first_name" value="<?php echo set_value('register_first_name'); ?>" placeholder="First Name" class="form-control input-md" required="" type="text">
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_first_name')) ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-md-4 control-label">Last Name <sup>*</sup></label>
                                        <div class="col-md-6">
                                            <input  name="register_last_name" value="<?php echo set_value('register_last_name'); ?>" placeholder="Last Name" class="form-control input-md" type="text">
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_last_name')) ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="col-md-4 control-label">Phone Number <sup>*</sup></label>
                                        <div class="col-md-6">
                                            <input name="register_phone_number" value="<?php echo set_value('register_phone_number'); ?>" placeholder="Phone Number" class="form-control input-md" type="text">
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_phone_number')) ?></span>
                                        </div>
                                    </div>

                                   
                                    <div class="form-group required">
                                        <label for="inputEmail3" class="col-md-4 control-label">Email
                                            <sup>*</sup></label>
                                        <div class="col-md-6">
                                            <input type="email" name="register_email_address" value="<?php echo set_value('register_email_address'); ?>" class="form-control" id="inputEmail3" placeholder="Email">
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_email_address')) ?></span>
                                        </div>

                                    </div>
                                    <div class="form-group required">
                                        <label for="inputPassword3" class="col-md-4 control-label">Password </label>
                                        <div class="col-md-6">
                                            <input type="password" name="register_password" value="<?php echo set_value('register_password'); ?>" class="form-control" id="inputPassword3" placeholder="Password">
                                            <span class="help-block" >Password must be 8 characters long.</span>
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_password')) ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <div class="termbox mb10">
                                                <!-- <label class="checkbox-inline" for="checkboxes-1">
                                                     <input name="checkboxes" id="checkboxes-1" value="1" type="checkbox">
                                                     I have read and agree to the <a href="terms-conditions.html">Terms
                                                         & Conditions</a> </label> -->
                                            </div>
                                            <div style="clear:both"></div>
                                            <input type="submit" name="register_user" id="submit" class="btn btn-primary" value="Register" />
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 reg-sidebar">
                <div class="reg-sidebar-inner text-center">
                    <div class="promo-text-box"><i class=" icon-briefcase fa fa-4x icon-color-1"></i>
                        <h3><strong>Post a Job </strong></h3>
                        <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. </p>
                    </div>
                    <div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>
                        <h3><strong>Create and Manage Jobs</strong></h3>
                        <p> Nam sit amet dui vel orci venenatis ullamcorper eget in lacus.
                            Praesent tristique elit pharetra magna efficitur laoreet.</p>
                    </div>
                    <div class="promo-text-box"><i class="  icon-heart-2 fa fa-4x icon-color-3"></i>
                        <h3><strong>Create your Favorite Jobs list.</strong></h3>
                        <p> PostNullam quis orci ut ipsum mollis malesuada varius eget metus.
                            Nulla aliquet dui sed quam iaculis, ut finibus massa tincidunt.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?>