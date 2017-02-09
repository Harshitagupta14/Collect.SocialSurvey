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
                        <h3 class="panel-title"><?php echo $breadcum ?></h3>
                        <ul class="panel-controls">
                            <li><a href="<?php echo $this->config->item('admin_base_url') ?>nav-menu-list"><span class="fa fa-backward" title="Back"></span></a></li>
                        </ul>
                    </div>

                    <div class="panel-body form-group-separated"><br>
                        <div class="row">
                           
                              
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Nav Title</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="nav_title" class="form-control" value="<?=$nav_title?>"/>
                                            </div>                                            
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('nav_title')) ?></span>
                                        </div>
                                    </div>                                  

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Nav Position</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="nav_position" class="form-control" value="<?= $nav_position ?>"/>
                                        </div>                                            
                                        <span class="help-block" style="color: red;"><?= strip_tags(form_error('nav_position')) ?></span>
                                    </div>
                                </div>                                  
                              

                                   <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Nav Url</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="nav_url" class="form-control" value="<?= $nav_url ?>"/>
                                            </div>                                            
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('nav_url')) ?></span>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Group</label>
                                        <div class="col-md-6 col-xs-12">                                                                                            
                                            <select class="form-control select" data-live-search="true" name="menu_group_id" id="menu_group_id">  
                                                <option value="">Select Group</option>
                                                <?php 
                                                    foreach ($nav_groups as $group) { ?> 
                                                    <option value="<?= $group['group_id'] ?>"<?php if ($group['group_id'] == $menu_group_id) { ?> selected="selected" <?php } ?>><?= $group['group_title'] ?></option>  
                                                <?php } ?>
                                            </select>
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('menu_group_id')) ?></span>
                                        </div>
                                    </div>
<!--                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Parent Menu</label>
                                        <div class="col-md-6 col-xs-12">                                                                                            
                                            <select class="form-control select" data-live-search="true" name="parent_id" id="parent_id">  
                                                <option value="0">Select Parent Menu</option>
                                                <?php                                   
                                                foreach ($menu_list as $menu) { ?> 
                                                    <option value="<?= $menu['nav_menu_id'] ?>" <?php if ($menu['nav_menu_id'] == $parent_id) { ?> selected="selected" <?php } ?>><?= $menu['nav_title'] ?></option>  
                                                <?php } ?>
                                            </select>
                                            <span class="help-block" style="color: red;"><?= strip_tags(form_error('parent_id')) ?></span>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Is Parent</label>
                                        <div class="col-md-9 col-xs-12">                                            
                                            <input type="radio" name="is_parent" value="yes" <?php if ($is_parent == 'yes') { ?> checked="checked" <?php } ?>/> Yes &nbsp;
                                            <input type="radio" name="is_parent" value="no" <?php if ($is_parent == 'no') { ?> checked="checked" <?php } ?>/> No                                    
                                        </div>
                                    </div>                                    
                                    -->
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

