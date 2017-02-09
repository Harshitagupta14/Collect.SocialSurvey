<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title><?= $this->config->item('sitename'); ?> | Login</title>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?= $this->config->item('adminassets'); ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        <div class="login-container">
            <div class="login-box animated fadeInDown">
               
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                        <?php $errormsg = $this->session->flashdata('errormsg'); if(validation_errors() || $errormsg) { ?>
                            <div class="alert alert-error" style=" margin:10px; color: cadetblue;">                
                                   <?=validation_errors()?> 
                               <strong>Error!</strong> <?=$errormsg?>
                            </div>
                        <?php } ?>
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="admin_username" class="form-control" placeholder="Username"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" name="admin_password" class="form-control" placeholder="Password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="<?= site_url($this->config->item('adminFolder').'/forgot-password') ?>" class="btn btn-link btn-block">Forgot your password?</a>
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-info btn-block" value="Log In" name="submit">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2015 <?= $this->config->item('sitename'); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>