<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($province_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($province_id){ ?>Edit<?php } else { ?> Add<?php } ?> State</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/province-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">
                        
                          <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Country</label>
                            <div class="col-md-6 col-xs-12">                                                                                            
                                <select class="form-control select" data-live-search="true" name="country_id" id="country_id">  
                                    <option value="">Select Country</option>
                                     <?php foreach ($country_list as $country) { ?>
                                    <option value="<?= $country['ct_id']?>"<?php if($country['ct_id']== $country_id) { ?> selected="selected" <?php }?>><?= $country['country_name']?></option>  
                                     <?php }?>
                                </select>
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('country_id'))?></span>
                            </div>
                        </div> 
                      
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Province Name</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="province_name" class="form-control" value="<?= $province_name ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('province_name'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Gst</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="gst" class="form-control" value="<?= $gst ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('gst'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Pst</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="pst" class="form-control" value="<?= $pst ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('pst'))?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Hst</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="hst" class="form-control" value="<?= $hst ?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('hst'))?></span>
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
