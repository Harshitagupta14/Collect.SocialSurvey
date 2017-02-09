<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($page_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($page_id){ ?>Edit<?php } else { ?> Add<?php } ?> Page</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/page-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Page Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="page_title" class="form-control" value="<?= $page_title ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('page_title'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Page Heading</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="page_heading" class="form-control" value="<?= $page_heading ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('page_heading'))?></span>    
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Page Content</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control ckeditor" name="page_content"><?= $page_content ?></textarea>
                                  <span class="help-block" style="color: red;"><?= strip_tags(form_error('page_content'))?></span>                         
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
