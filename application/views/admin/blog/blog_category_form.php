<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($cat_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($cat_id){ ?>Edit<?php } else { ?> Add<?php } ?> Blog Category</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/blog-category-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Blog Category</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="bg_category_title" class="form-control" value="<?= $bg_category_title ?>"/>
                                </div>                                            
                                <span class="help-block" style="color: red;"><?= strip_tags(form_error('bg_category_title'))?></span>
                            </div>
                        </div>                        
                          
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Blog Category Description</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control ckeditor" name="bg_category_description"><?= $bg_category_description ?></textarea>
                                  <span class="help-block" style="color: red;"><?= strip_tags(form_error('bg_category_description'))?></span>                              
                            </div>
                        </div>                        
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="bg_meta_title" class="form-control" value="<?= $bg_meta_title ?>"/>
                                </div>                                         
                                 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Keywords</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <textarea class="form-control" name="bg_meta_keywords"><?= $bg_meta_keywords ?></textarea>                                                    
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Description</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <textarea class="form-control" name="bg_meta_description"><?= $bg_meta_description ?></textarea>                                                     
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

