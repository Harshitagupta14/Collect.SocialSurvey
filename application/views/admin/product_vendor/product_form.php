<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= site_url('admin/dashboard') ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active"><?php echo isset($product_id) ? $breadcum_edit : $breadcum ?></li>
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
                            <i class="fa fa-globe"></i><?php if ($product_id) { ?>Edit<?php } else { ?> Add<?php } ?> Product</div>
                    </div>
                    <div class="portlet-body">
                        <div class="page-content-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <div class="panel-body form-group-separated">
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Product Quantity</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="product_quantity" class="form-control" value="<?= $product_vendor_quantity ?>"/>
                                                    </div>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_quantity')) ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Product Discount</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="product_discount" class="form-control" value="<?= $product_discount ?>"/>
                                                    </div>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_discount')) ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Product Price</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="product_price" class="form-control" value="<?= $product_price ?>"/>
                                                    </div>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_price')) ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Product UPC Code</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="product_upc_code" class="form-control" value="<?= $product_upc_code ?>"/>
                                                    </div>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_upc_code')) ?></span>
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

