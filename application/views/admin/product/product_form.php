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
                <li class="active">
                    <?php echo isset($product_id) ? $breadcum_edit : $breadcum ?>
                </li>
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
                        <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">


                            <div class="panel-body form-group-separated">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Title</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_title" class="form-control" value="<?= $product_title ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_title')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Category</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            <?php
                                            foreach ($category_list as $category) {//pr($category_list);die;
                                                $sub_category_data = $this->product->getSubCategoryByCategory($category['category_id']);
                                                ?>
                                                <option value="<?= $category['category_id'] ?>"<?php if ($category['category_id'] == $category_id) { ?> selected="selected" <?php } ?>><?= $category['category_name'] ?></option>
                                                <?php
                                                foreach ($sub_category_data as $sub_cat) {
                                                    if ($sub_cat['parent_id'] == $category['category_id']) {
                                                        ////pr($cat_id);die;
                                                        ?>
                                                        <option value="<?= $sub_cat['category_id'] ?>"<?php if ($sub_cat['category_id'] == $sub_cat_id) { ?> selected="selected" <?php } ?>>--------<?= $sub_cat['category_name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block" style="color: Black;">If a Category has SubCategory than Select Specific SubCategory not Category.</span>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('category_id')) ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Location(City)</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="form-control" name="city_id" id="city_id">
                                            <option value="">Select City</option>
                                            <?php
                                            $city_data = $this->common_model->getCityList();
                                            foreach ($city_data as $city) {//pr($category_list);die;
                                                ?>
                                                <option value="<?= $city['city_id'] ?>"<?php if ($city['city_id'] == $city_id) { ?> selected="selected" <?php } ?>><?= $city['city_name'] ?></option>

                                            <?php } ?>
                                        </select>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('city_id')) ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Type</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="form-control select" data-live-search="true" name="prd_type_id" id="prd_type_id">
                                            <option value="">Select Product Type</option>
                                            <?php foreach ($product_type as $type) { ?>
                                                <option value="<?= $type['prd_type_id'] ?>"<?php if ($type['prd_type_id'] == $prd_type_id) { ?> selected="selected" <?php } ?>><?= $type['prd_type_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('prd_type_id')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Group Number</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="group_number" class="form-control" value="<?= $group_number ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('group_number')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Color</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_color" class="form-control" value="<?= $product_color ?>"/>
                                        </div>
                                        <span class="help-block" style="color: black;">Enter color with comma separated.</span>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_color')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Size</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_size" class="form-control" value="<?= $product_size ?>"/>
                                        </div>
                                        <span class="help-block" style="color: black;">Enter Sizes with comma separated.</span>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_size')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Meta Title</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="meta_title" class="form-control" value="<?= $meta_title ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('meta_title')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Meta Keyword</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="meta_keyword" class="form-control" value="<?= $meta_keyword ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('meta_keyword')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Meta Description</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea name="meta_description" class="form-control"><?= $meta_description ?></textarea>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('meta_description')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product MRP</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_mrp" class="form-control" value="<?= $product_mrp ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_mrp')) ?></span>
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
                                    <label class="col-md-3 col-xs-12 control-label">Product Upc Code</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_upc_code" class="form-control" value="<?= $product_upc_code ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_upc_code')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Is New</label>
                                    <div class="col-md-9 col-xs-12">
                                        <input type="radio"  name="is_new" value="yes" <?php if (isset($is_new) && $is_new == "yes") echo "checked"; ?>>Yes<br/>
                                        <input type="radio" name="is_new" value="no" <?php if (isset($is_new) && $is_new == "no") echo "checked"; ?>>No<br/>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('is_new')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Code</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="product_code" class="form-control" value="<?= $product_code ?>"/>
                                        </div>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_code')) ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Description</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control ckeditor" name="product_description"><?= $product_description ?></textarea>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_description')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Specification</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control product_specification" name="product_specifications"><?= $product_specifications ?></textarea>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_specifications')) ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Product Small Description</label>
                                    <div class="col-md-9 col-xs-12">
                                        <textarea class="form-control" name="product_small_description" rows="5"><?= $product_small_description ?></textarea>
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('product_small_description')) ?></span>
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
<script type='text/javascript' src="<?= $this->config->item('adminassets'); ?>js/location.js"></script>
