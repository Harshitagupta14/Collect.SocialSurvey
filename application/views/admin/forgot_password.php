<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?= $this->config->item('sitename'); ?> | Forgot Password</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?= $this->config->item('adminassets') ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        <div class="registration-container">            
            <div class="registration-box animated fadeInDown">
                <div class="registration-logo"></div>
                <div class="registration-body">
                    <div class="registration-title"><strong>Forgot</strong> Password?</div>
                    <?php  if(validation_errors() || $is_error) { ?>
                            <div class="alert alert-error" style=" margin:10px; color: cadetblue;">                
                                   <?= validation_errors() ?> 
                               <strong>Error!</strong> <?= $is_error ?>
                            </div>
                        <?php } ?>
                    <!--                    <div class="registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In odio mauris, maximus ac sapien sit amet. </div>-->
                    <form class="form-horizontal" method="post">                        
                        <h4>Your E-mail</h4>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" placeholder="email@domain.com"/>
                            </div>
                        </div>                                                            
                        <div class="form-group push-up-20">
                            <div class="col-md-6">
                                <a href="<?= site_url($this->config->item('adminFolder') . '/login') ?>" class="btn btn-link btn-block">Login Here</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--                <div class="registration-footer">
                                    <div class="pull-left">
                                        &copy; 2015 AppName
                                    </div>
                                    <div class="pull-right">
                                        <a href="#">About</a> |
                                        <a href="#">Privacy</a> |
                                        <a href="#">Contact Us</a>
                                    </div>
                                </div>-->
            </div>
        </div>
    </body>
</html>