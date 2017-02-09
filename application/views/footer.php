<div class="addbanner">
    <div class="container">     
        <div class="row">
            <?php
            $promo_banner = $this->common_model->getBannerRecords('2');
            foreach ($promo_banner as $promo) {
                ?>
                <div class="col-sm-3 <?php echo $promo['class'] ?>"><a href="<?= $promo['banner_url'] ?>"><img src="<?= $this->config->item('uploads') ?>banner_images/<?= $promo['banner_image'] ?>" class="img-responsive"></a></div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="login" method="post" action="<?= site_url('login-ajax') ?>" class="formsubmitlogin">   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Login Here</h3>
                    <h4 class="modal-error-login" style=" color: red;"></h4>  
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input  type="email" id="email_login" placeholder="Username Or Email-Id" name="login_identity" class="form-control" required>                               
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input  type="password" id="password_log" placeholder="Password" name="login_password" class="form-control" required>
                        </div>
                    </div>
<!--                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>-->
                    <div class="captcha">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6"><input  type="submit" value="Login" class="btn btn-primary btn-lg btn-block" name="login_user"></div>
                        <div class="col-sm-6"><button class="btn btn-success btn-lg btn-block" data-dismiss="modal" data-toggle="modal" data-target="#register-modal">Register</button></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-helper">
            <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#forgetModal">Forgot your password?</a>
        </div>
    </div>
</div>
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="register" method="post" action="<?= site_url('quick-registration-ajax') ?>" class="formsubmit">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Register Here</h3>
                    <h4 class="modal-error" style=" color: red;"></h4>   
                    <div class="btn-danger password-error"></div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="register_email_address" id="register_email_address" value="<?php echo set_value('register_email_address'); ?>" class="form-control " placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="register_password" id="register_password" value="<?php echo set_value('register_password'); ?>" class="form-control " placeholder="Password"/>
                        </div>
                        <div class="help-block">Password length must be more than 8 characters in length. Only alpha-numeric, dashes, underscores, periods and comma characters are allowed.</div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="register_confirm_password" id="register_confirm_password" value="<?php echo set_value('register_confirm_password'); ?>" class="form-control " placeholder="Confirm Password"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-lg btn-block">Register</button>
                </div>
            </form>
        </div>
        <div class="modal-helper"><a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Already have an account! Sign me in.</a></div>
    </div>
</div>
<div class="modal fade" id="forgetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="register" method="post" action="<?= site_url('forgot-password') ?>" class="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>Lost your password? Please enter your email address. You will receive a link to create a new password.</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="forgot_password_identity" class="form-control " placeholder="Username Or Email-Id" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="send_forgotten_password" value="Send" class="btn btn-primary btn-lg btn-block"/>
                </div>
            </form>
        </div>
        <div class="modal-helper">
            <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Back to log-in</a>
        </div>
    </div>
</div>
<div class="container">
    <footer>
        <div class="col-sm-12 col-md-8">
            <div class="pt20"></div>
            <h2 class="pull-left">Newsletter</h2>
            <div class="input-group">
                <input type="email" name="email_id" id="email" placeholder="your email address ..." class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="submit_subscriber" type="button"><img src="<?= $this->config->item('frontassets') ?>img/arrow.png" alt=""></button>
                </span>
            </div>
            <div class="clearfix"></div>
            <ul>
                <?php
                $footerlinks = $this->common_model->getFooterLinks(); //pr($footerlinks);die;
                foreach ($footerlinks as $footer) {
                    ?>
                    <li><a href="<?= $footer['nav_url'] ?>"><?= $footer['nav_title'] ?></a></li>
                <?php } ?>
            </ul>
            <h2 class="follow">Follow Us :</h2>
            <div class="social">
                <?php
                if ($this->config->item('facebook') != '') {
                    ?>
                    <a href="<?= $this->config->item('facebook') ?>"><i class="fa fa-facebook"></i></a>
                    <?php
                }
                if ($this->config->item('twitter') != '') {
                    ?>
                    <a href="<?= $this->config->item('twitter') ?>"><i class="fa fa-twitter"></i></a>
                    <?php
                }
                if ($this->config->item('google') != '') {
                    ?>
                    <a href="<?= $this->config->item('google') ?>"><i class="fa fa-google-plus"></i></a>
                    <?php
                }
                if ($this->config->item('linkedin') != '') {
                    ?>
                    <a href="<?= $this->config->item('linkedin') ?>"><i class="fa fa-linkedin"></i></a>
                    <?php
                }
                if ($this->config->item('rss') != '') {
                    ?>
                    <a href="<?= $this->config->item('rss') ?>"><i class="fa fa-rss"></i></a>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
            <div class="copyright"><?= $this->config->item('copyright') ?></div>
        </div>
        <div class="col-sm-12 col-md-4">
            <h2>Store Information</h2>
            <p><?= $this->config->item('contact_address'); ?></p>
            <h2>Call us now:</h2>
            <div class="call"><a href="tel:<?= $this->config->item('contact_no') ?>"><?= $this->config->item('contact_no') ?></a></div>
            <p>E-mail:<a href="mailto:<?= $this->config->item('site_email') ?>"> <?= $this->config->item('site_email') ?></a></p>
        </div>
    </footer>
</div>
<link href="<?= $this->config->item('frontassets') ?>fancybox/fancybox.css" rel="stylesheet">
<script src="<?= $this->config->item('frontassets') ?>js/bootstrap.js"></script>
<script src="<?= $this->config->item('frontassets') ?>fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.fancybox').fancybox();

    });
</script>
<script type="text/javascript">
    $('body').delegate('#submit_subscriber', 'click', function () {
        var email = $('#email').val();
        if (email != '') {
            $.ajax({
                type: "POST",
                url: "subscribe-newsletter",
                dataType: "json",
                data: {"email_id": email},
                success: function (msg) {
                    alert(msg);
                    location.reload();
                }
            })
        } else {
            alert("Please enter a valid email");
        }
    });

    $('body').delegate('#loginModal', 'click', function () {
        $('#login-modal').modal('hide');
        //   $('#register-modal').attr('aria-hidden','false');      
    });
    $('body').delegate('#registerModal', 'click', function () {
        $('#register-modal').modal('hide');
        // $('#login-modal').attr('aria-hidden','false');      
    });
</script> 
<script type="text/javascript">
    $(document).ready(function () {
        $(".formsubmit").submit(function (e) {
            e.preventDefault();
            var posturl = $(this).attr('action');

            var email = $('#register_email_address').val();
            var password = $('#register_password').val();
            var confirm_password = $('#register_confirm_password').val();
            $.ajax({
                type: "POST",
                url: posturl,
                dataType: 'json',
                data: {"register_email_address": email, "register_password": password, "register_confirm_password": confirm_password},
                success: function (msg) {
                    // alert(msg.response);
                    if (msg.response == true) {
                        //   alert(msg.response);
                        window.location.href = baseurl + 'account/login';
                    }
                    if (msg.response == false) {
                        $('.password-error').html(msg.message);
                    }
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".formsubmitlogin").submit(function (e) {
            e.preventDefault();
            var posturl = $(this).attr('action');
            var email = $('#email_login').val();
            var password = $('#password_log').val();

            $.ajax({
                type: "POST",
                url: posturl,
                dataType: 'json',
                data: {"login_identity": email, "login_password": password},
                success: function (msg) {
                    // alert(msg);  	
                    if (msg.success == true) {
                        $('#login-modal').modal('hide');
                        location.reload();
                        //window.location.href = baseurl + 'account/login' ;

                    }
                    if (msg.success == false) {
//                          $('.captcha').html('<div class="form-group">\n\
//                                               <label class="control-label">Captcha</label>\n\
//                                            '+ msg.captcha +' = <input type="text" id="captcha" name="login_captcha" class="form-control " placeholder="Captcha Question"/>\n\
//                                               </div> '  );
                        $('.modal-error-login').text('Invalid Login Details');
                    }
                }
            });
            return false;
        });

        $('.cart_text').click(function(){
            $('.cart_text').toggleClass('opencart');
        });
    });
</script>
<script src="<?= $this->config->item('frontassets') ?>js/cart.js"></script> 
</body>
</html>