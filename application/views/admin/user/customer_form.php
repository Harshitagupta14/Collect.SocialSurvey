<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= site_url('admin/dashboard') ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active"><?php echo isset($id) ? $breadcum_edit : $breadcum ?></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('ProductSuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('ProductSuccess') ?></div>
                <?php } ?>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i><?php if ($id) { ?>Edit<?php } else { ?> Add<?php } ?> Admin</div>

                    </div>

                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">


                        <div class="panel-body form-group-separated">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">First Name</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" name="username" class="form-control" value="<?php echo $username ?>"/>
                                    </div>
                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('username')) ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" name="username" class="form-control" value="<?php echo $username ?>"/>
                                    </div>
                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('username')) ?></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Phone</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>"/>
                                    </div>
                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('phone')) ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-envelope-o"></span></span>
                                        <input type="email" name="email" class="form-control" value="<?php echo $email ?>"/>
                                    </div>
                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('email')) ?></span>
                                </div>
                            </div>




                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default" type="reset">Clear Form</button>
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.id);
            reader.onload = function (e) {
                $('#' + input.id + '_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script type='text/javascript' src='<?= $this->config->item('adminassets'); ?>js/location.js'></script>