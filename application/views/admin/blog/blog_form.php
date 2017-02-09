<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($blog_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($blog_id){ ?>Edit<?php } else { ?> Add<?php } ?> Blog</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/blog-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Category</label>
                            <div class="col-md-6 col-xs-12">                                                                                            
                                <select class="form-control select" data-live-search="true" name="category_id" id="category_id">     
                                    <option value="">Select Category</option>
                                     <?php foreach ($blog_category as $category) { ?>
                                    <option value="<?= $category['bg_cat_id']?>"<?php if($category['bg_cat_id']== $category_id) { ?> selected="selected" <?php }?>><?= $category['bg_category_title']?></option>  
                                     <?php }?>
                                </select>
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('category_id'))?></span>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Blog Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="blog_title" class="form-control" value="<?= $blog_title ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('blog_title'))?></span>
                            </div>
                        </div>
                        
                          
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Blog Description</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control ckeditor" name="blog_description"><?= $blog_description ?></textarea>
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('blog_description'))?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Show Image</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <input type="radio"  name="show_image" value="yes" <?php if (isset($show_image) && $show_image=="yes") echo "checked";?>>Yes<br/>
                                <input type="radio" name="show_image" value="no" <?php if (isset($show_image) && $show_image=="no") echo "checked";?>>No<br/>
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('show_image'))?></span>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Blog Image</label>
                            <div class="col-md-6 col-xs-12">  
                             Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="blog_image" name="blog_image" value="<?= $blog_image ?>" title="Browse file" ><br/>
                          <?php if (isset($blog_image) && $blog_image!='') { ?>
                              <img id="blog_image_preview" src="<?= base_url() ?>assets/uploads/blog_images/<?= $blog_image ?>" width="50px" height="50px">
                          <?php } else { ?>
                              <img id="blog_image_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                          <?php } ?>                            
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('blog_image'))?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="meta_title" class="form-control" value="<?= $meta_title ?>"/>
                                </div>                                            
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Keywords</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control" name="meta_keywords"><?= $meta_keywords ?></textarea>                              
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Description</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control" name="meta_description"><?= $meta_description ?></textarea>                               
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
<script>
       function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            //alert(input.id);
                                            reader.onload = function(e) {
                                                $('#' + input.id + '_preview').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
       
   
</script>
