<script type="text/javascript" src="<?php echo $this->config->item('ckeditor_basepath'); ?>ckeditor.js"></script>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li> 
    <li class="active"><?php echo isset($product_id) ? $breadcum_edit : $breadcum ?></li> 
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">                       
                        <h3 class="panel-title"><?php if($product_id){ ?>Edit<?php } else { ?> Add<?php } ?> Product Type</h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo site_url()?>admin/product-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>
                  
                    <div class="panel-body form-group-separated">

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Image Color</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="image_color" class="form-control" value="<?= $image_color?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('image_color'))?></span>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Sequence Number</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="seq_number" class="form-control" value="<?= $seq_number?>"/>
                                </div>                                            
                                 <span class="help-block" style="color: red;"><?= strip_tags(form_error('seq_number'))?></span>
                            </div>
                        </div> 
       
                        <div class="form-group">
                            <label class="col-md-3 control-label">Is Featured</label>
                            <div class="col-md-9">
                                <label>
                                    <input type="radio" name="is_featured" value="yes" <?php echo isset($is_featured) ? $is_featured == 'yes' ? 'checked' : ""  : '' ?> />Yes                             
                                </label><br>
                                <label>
                                    <input type="radio" name="is_featured" value="no" <?php echo isset($is_featured) ? $is_featured == 'no' ? 'checked' : ""  : '' ?>/>NO                                 
                                </label>                              
                            </div>
                        </div>  
                          
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Product Image</label>
                            <div class="col-md-6 col-xs-12">  
                   Please Choose a file: <input type="file"  class="fileinput btn-primary" onChange="readURL(this);" id="product_image" name="image_name" value="<?= $image_name ?>" title="Browse file" ><br/>
                          <?php if (isset($product_image_id)){ ?>
                              <img id="product_image_preview" src="<?= base_url() ?>assets/uploads/product_images/<?= $image_name ?>" width="50px" height="50px">
                          <?php } else { ?>
                              <img id="product_image_preview" src="<?= $this->config->item('adminassets'); ?>img/upload_image.png" width="50px" height="50px">
                          <?php } ?>                            
                                  <span class="help-block" style="color: red;"><?= strip_tags(form_error('image_name'))?></span>
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
<script type='text/javascript' src='<?= $this->config->item('adminassets'); ?>js/location.js'></script>
