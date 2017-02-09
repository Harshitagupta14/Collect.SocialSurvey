<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($banner_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($banner_id){ ?>Edit<?php } else { ?> Add<?php } ?> Banner</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/banner-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                   
                    
                    <div class="panel-body form-group-separated">
                        
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Banner Category</label>
                            <div class="col-md-6 col-xs-12">                                                                                            
                                <select class="form-control select" data-live-search="true" name="bn_category_id" id="country_id">  
                                    <option value="">Select Category</option>
                                     <?php foreach ($banner_category_list as $category) { ?>
                                    <option value="<?= $category['bn_category_id']?>"<?php if($category['bn_category_id']== $bn_category_id) { ?> selected="selected" <?php }?>><?= $category['bn_category_name']?></option>  
                                     <?php }?>
                                </select>
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('bn_category_id'))?></span>
                            </div>
                        </div> 
                    
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Banner Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="banner_title" class="form-control" value="<?= $banner_title ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('banner_title'))?></span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Banner Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="banner_link" class="form-control" value="<?= $banner_link ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('banner_link'))?></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Banner Image</label>
                            <div class="col-md-6 col-xs-12">  
                   Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="banner_image" name="banner_image" value="<?= $banner_image ?>" title="Browse file" ><br/>
                          <?php if (isset($banner_id)) { ?>
                              <img id="banner_image_preview" src="<?= base_url() ?>assets/uploads/banner_images/<?= $banner_image ?>" width="50px" height="50px">
                          <?php } else { ?>
                              <img id="banner_image_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                          <?php } ?>                            
                                  <span class="help-block" style="color: red;"><?= strip_tags(form_error('banner_image'))?></span>
                            </div>
                        </div>  
                         
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Banner Text</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control ckeditor" name="banner_text"><?= $banner_text ?></textarea>
                                  <span class="help-block" style="color: red;"><?= strip_tags(form_error('banner_text'))?></span>                         
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
