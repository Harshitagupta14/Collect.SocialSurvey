<?php $this->load->view($this->config->item('public_folder_name') . '/header'); ?> 
<section class="main-section" id="innerheading">
    <header class="section-header">
        <h2>Login/Signup</h2>
        <div class="divider-section-header"></div>
    </header><!-- end of section head -->
</section><!-- end of Services setion -->
<!-- Services Section -->
<section class="main-section" id="innercontent">
    <div class="container">
        <?php if (!empty($message)) { ?>
            <?php echo $message; ?>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <div class="reg_form">
                    <h2>Signin Here</h2>
                    <form id="login_form" method="post" action="<?= site_url('login') ?>">
                        <div class="form-group">
                            <label class="control-label">Username Or Email-Id</label>
                            <input type="text" name="login_identity" class="form-control " placeholder="Username Or Email-Id" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" name="login_password" class="form-control " placeholder="Password"/>
                        </div>
                        <?php
                        if (isset($captcha)) {
                            echo "<div class=\"form-group\">";
                            echo " <label class=\"control-label\">Captcha</label>";
                            echo $captcha . ' = <input type="text" id="captcha" name="login_captcha" class="form-control " placeholder="Captcha Question"/>' . "\n";
                            echo "</div>";
                        }
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg" value="Submit" name="login_user">
                        </div>
                    </form>

                </div>
                <div class="clearfix"></div>
                <div class="reg_form">
                    <h2>Forgot Password</h2>
                    <form id="forgot_password_form" method="post" action="<?= site_url('forgot-password') ?>">
                        <div class="form-group">
                            <label class="control-label">Username Or Email-Id</label>
                            <input type="text" name="forgot_password_identity" class="form-control " placeholder="Username Or Email-Id" required/>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="send_forgotten_password" value="Submit" class="btn btn-primary btn-lg"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="reg_form">
                    <h2>Signup Here</h2>
                    <form action="<?= site_url('registration') ?>" method="post" id="registration_form">
                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input type="text" class="form-control " name="register_first_name" value="<?php echo set_value('register_first_name'); ?>" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input type="text" name="register_last_name" value="<?php echo set_value('register_last_name'); ?>" class="form-control " placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input type="email" name="register_email_address" value="<?php echo set_value('register_email_address'); ?>" class="form-control " placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input type="text" name="register_username" value="<?php echo set_value('register_username'); ?>" class="form-control " />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone Number</label>
                            <input type="text" name="register_phone_number" value="<?php echo set_value('register_phone_number'); ?>" class="form-control " placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" name="register_password" value="<?php echo set_value('register_password'); ?>" class="form-control " placeholder="Password"/>
                            <div class="help-block">Password length must be more than 8 characters in length. Only alpha-numeric, dashes, underscores, periods and comma characters are allowed.</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" name="register_password" value="<?php echo set_value('register_password'); ?>" class="form-control " placeholder="Confirm Password"/>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" name="register_newsletter" value="1" <?php echo set_checkbox('register_newsletter', 1); ?>/>Subscribe to Newsletter</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register_user" id="submit" value="Submit" class="btn btn-primary btn-lg"/>
                            <a class="btn btn-link" href="<?= site_url('login') ?>">Login Here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?> 