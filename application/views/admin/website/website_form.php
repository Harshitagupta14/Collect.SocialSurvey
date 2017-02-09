<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li>  
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title">Website Settings</h3>
                        <ul class="panel-controls">
                            <li><a href="" onclick="history.back()"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Paypal Email</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope-o"></span></span>
                                    <input type="text" name="paypal_email" class="form-control" value="<?= $paypal_email ?>"/>
                                </div>                                            
                                 <span class="help-block">Please enter paypal email</span>
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Site Email</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope-o"></span></span>
                                    <input type="text" name="site_email" class="form-control" value="<?= $site_email ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter site email</span>
                            </div>
                        </div>                        
                          
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Contact Address</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control" name="contact_address"><?= $contact_address ?></textarea>
                               <span class="help-block">Please enter contact address</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Contact No</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input type="text" name="contact_no" class="form-control" value="<?= $contact_no ?>"/>
                                </div>                                            
                                  <span class="help-block">Please enter contact no</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Page Size Front</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="number" name="page_size_front" class="form-control" value="<?= $page_size_front ?>"/>
                                </div>                                            
                                 <span class="help-block">Please enter page size front</span>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Facebook Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="facebook" class="form-control" value="<?= $facebook ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter facebook link</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Twitter Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="twitter" class="form-control" value="<?= $twitter ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter twitter link</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Google Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="google" class="form-control" value="<?= $google ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter google link</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Youtube Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="youtube" class="form-control" value="<?= $youtube ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter youtube link</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Linkedin Link</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="linkedin" class="form-control" value="<?= $linkedin ?>"/>
                                </div>                                            
                                 <span class="help-block">Please enter linkedin link</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Site Title</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="site_title" class="form-control" value="<?= $site_title ?>"/>
                                </div>                                            
                                <span class="help-block">Please enter site title</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Keywords</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control" name="meta_keywords"><?= $meta_keywords ?></textarea>
                              <span class="help-block">Please enter meta keywords</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Meta Description</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <textarea class="form-control" name="meta_description"><?= $meta_description ?></textarea>
                                <span class="help-block">Please enter meta description</span>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Site Logo</label>
                            <div class="col-md-6 col-xs-12">  
                             Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="logo" name="logo" value="<?= $logo ?>" title="Browse file" ><br/>
                          <?php if (isset($id)) { ?>
                              <img id="logo_preview" src="<?= base_url() ?>assets/uploads/site_images/<?= $logo ?>" width="50px" height="50px">
                          <?php } else { ?>
                              <img id="logo_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                          <?php } ?>                            
                                <span class="help-block">Please enter Site Logo</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Site Favicon</label>
                            <div class="col-md-6 col-xs-12">  
                             Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="favicon" name="favicon" value="<?= $favicon ?>" title="Browse file" ><br/>
                          <?php if (isset($id)) { ?>
                              <img id="favicon_preview" src="<?= base_url() ?>assets/uploads/site_images/<?= $favicon ?>" width="50px" height="50px">
                          <?php } else { ?>
                              <img id="favicon_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                          <?php } ?>                            
                                <span class="help-block">Please enter Site Favicon</span>
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
