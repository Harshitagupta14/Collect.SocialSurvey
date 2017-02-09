<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>SocialCop|Login </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= $this->config->item('adminassets'); ?>global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= $this->config->item('adminassets'); ?>global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= $this->config->item('adminassets'); ?>pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        <script>
            var baseurl = '<?= base_url() ?>';
        </script>
    </head>
    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
                    <div class="login-bg" style="background-image:url(http://localhost/pos1/assets/admin/pages/img/login/bg1.jpg)">
                        <!--<img class="login-logo" src="<?= $this->config->item('adminassets'); ?>pages/img/login/logo.png" /> -->
                    </div>
                </div>
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content" style="margin-top:20%;">
                        <h1>SOCIALCOP REGISTRATION</h1>
                        <form action="" class=" " method="post">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>Enter any username and password. </span>
                            </div>

                            <label class="col-md-4 control-label">First Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <input type="hidden" name="customer_type"  value="customer" checked>
                                <input name="register_first_name" value="<?php echo set_value('register_first_name'); ?>" placeholder="First Name" class="form-control input-md" required="" type="text">
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_first_name')) ?></span>
                            </div>
                            <label class="col-md-4 control-label">Last Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <input  name="register_last_name" value="<?php echo set_value('register_last_name'); ?>" placeholder="Last Name" class="form-control input-md" type="text">
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_last_name')) ?></span>
                            </div>
                            <label class="col-md-4 control-label">Phone Number <sup>*</sup></label>
                            <div class="col-md-6">
                                <input name="register_phone_number" value="<?php echo set_value('register_phone_number'); ?>" placeholder="Phone Number" class="form-control input-md" type="text">
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_phone_number')) ?></span>
                            </div>

                            <label for="inputEmail3" class="col-md-4 control-label">Email
                                <sup>*</sup></label>
                            <div class="col-md-6">
                                <input type="email" name="register_email_address" value="<?php echo set_value('register_email_address'); ?>" class="form-control" id="inputEmail3" placeholder="Email">
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_email_address')) ?></span>
                            </div>

                            <label for="inputPassword3" class="col-md-4 control-label">Password </label>
                            <div class="col-md-6">
                                <input type="password" name="register_password" value="<?php echo set_value('register_password'); ?>" class="form-control" id="inputPassword3" placeholder="Password">
                                <span class="help-block" >Password must be 8 characters long.</span>
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('register_password')) ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-4 col-md-6" style="margin-top:20px;">
                                    <input type="submit" name="register_user" id="submit" class="btn btn-primary" value="Register" />
                                    <a href="<?php echo site_url('login') ?>" class="btn btn-danger">Login</a>
                                </div>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        <form class="forget-form" action="javascript:;" method="post">
                            <h3 class="font-green">Forgot Password ?</h3>
                            <p> Enter your e-mail address below to reset your password. </p>
                            <div class="form-group">
                                <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                            <div class="form-actions">
                                <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                                <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                            </div>
                        </form>
                        <!-- END FORGOT PASSWORD FORM -->
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; SOCIALCOP PVT LTD 2016</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
    <script src="<?= $this->config->item('adminassets'); ?>global/plugins/respond.min.js"></script>
    <script src="<?= $this->config->item('adminassets'); ?>global/plugins/excanvas.min.js"></script>
    <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?= $this->config->item('adminassets'); ?>global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= $this->config->item('adminassets'); ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= $this->config->item('adminassets'); ?>pages/scripts/login-5.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>