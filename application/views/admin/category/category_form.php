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
                <?php if ($category_id) { ?>
                    <li class="active"><?php echo isset($prnt_id) && $prnt_id == '0' ? $breadcum_edit . ' > ' . $category_title : $breadcum_edit_sub . ' > ' . $cat_name . ' > ' . $cat_title . ' > ' . $category_title ?></li>
                <?php } else { ?>
                    <li class="active"><?php echo isset($catId) && $catId != '' ? $breadcum_sub : $breadcum ?></li>
                <?php } ?>
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
                            <i class="fa fa-globe"></i><?php if ($category_id) { ?><?php echo isset($prnt_id) && $prnt_id == '0' ? $breadcum_edit : $breadcum_edit_sub ?><?php } else { ?> <?php echo isset($catId) ? $breadcum_sub : $breadcum ?><?php } ?> </div>

                    </div>
                    <div class="portlet-body">
                        <div class="page-content-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">

                                        <div class="panel-body form-group-separated">
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Category Title</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="category_name" class="form-control" value="<?= $category_name ?>"/>
                                                    </div>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('category_name')) ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Parent Category</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select class="form-control select" data-live-search="true" name="parent_id" id="parent_id">
                                                        <option value="">Select Category</option>
                                                        <?php foreach ($parent_category as $parent) { ?>
                                                            <option value="<?= $parent['category_id'] ?>"<?php if ($parent['category_id'] == $prnt_id) { ?> selected="selected" <?php } ?>><?= $parent['category_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('parent_id')) ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Category Description</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <textarea class="form-control ckeditor" name="category_description"><?= $category_description ?></textarea>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('category_description')) ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Category Image</label>
                                                <div class="col-md-6 col-xs-12">
                                                    Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="category_image" name="category_image" value="<?= $category_image ?>" title="Browse file" ><br/>
                                                    <?php if (isset($category_id)) { ?>
                                                        <img id="category_image_preview" src="<?= base_url() ?>assets/uploads/category_images/<?= $category_image ?>" width="50px" height="50px">
                                                    <?php } else { ?>
                                                        <img id="category_image_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                                                    <?php } ?>
                                                    <span class="help-block" style="color: red;"><?= strip_tags(form_error('category_image')) ?></span>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="panel-footer">
                                            <button class="btn btn-default" type="reset">Clear Form</button>
                                            <button class="btn btn-primary pull-right">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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


