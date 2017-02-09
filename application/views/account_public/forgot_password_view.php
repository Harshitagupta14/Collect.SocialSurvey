<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>


<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
            <li class="active">Forgot Password</li>
        </ol>
        <div class="row">
            <div class="col-sm-5 login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title">

                            <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> BOOT<span>CLASSIFIED </span>
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form id="forgot_password_form" method="post">
                            <div class="form-group">
                                <label for="sender-email" class="control-label">Email:</label>
                                <div class="input-icon"><i class="icon-user fa"></i>
                                    <input type="text" name="forgot_password_identity" class="form-control " placeholder="Username Or Email-Id" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="send_forgotten_password" value="Submit" class="btn btn-primary btn-lg"/>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p class="text-center "><a href="<?= site_url($this->config->item('login_url')) ?>"> Back to Login </a></p>
                        <div style=" clear:both"></div>
                    </div>
                </div>
                <div class="login-box-btm text-center">
                    <p> Don't have an account? <br>
                        <a href="<?= site_url('account') ?>"><strong>Sign Up !</strong> </a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('public_folder_name') . '/footer'); ?>