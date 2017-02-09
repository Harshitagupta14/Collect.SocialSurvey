<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($smtp_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($smtp_id){ ?>Edit<?php } else { ?> Add<?php } ?> Footer Links</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/smtp-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Smtp UserName</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="smtp_user" class="form-control" value="<?= $smtp_user ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('smtp_user'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Smtp Password</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="smtp_password" class="form-control" value=""/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('smtp_password'))?></span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Smtp Host</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="smtp_host" class="form-control" value="<?= $smtp_host?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('smtp_host'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Smtp Port</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="smtp_port" class="form-control" value="<?= $smtp_port ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('smtp_port'))?></span>
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
