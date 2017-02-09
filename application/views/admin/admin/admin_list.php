<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
   <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <?php if ($this->session->flashdata('AdminSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('AdminSuccess') ?></div>
                                <?php } if ($this->session->flashdata('AdminError')) { ?>  
                                    <div class="alert alert-danger"> <?= $this->session->flashdata('AdminError') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Admin</h3>
                                    <ul class="panel-controls" style="margin-top: 2px;">                                     
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= base_url()?>admin/admin-add"><span class="fa fa-plus-square"></span>Add New</a></li>
                                             
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>

                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                 <?php
                                                if (!empty($admin_data)) {
                                                    foreach ($admin_data as $key=>$admin) {
                                                        ?>
                                                <tr id="trow_<?= $key ?>">
                                                    <td><strong><?php echo (isset($admin['admin_username'])) ? $admin['admin_username'] : '-'; ?></strong></td>
                                                    <td><?php echo (isset($admin['admin_phone'])) ? $admin['admin_phone'] : '-'; ?></td>
                                                    <td><?php echo (isset($admin['admin_email'])) ? $admin['admin_email'] : '-'; ?></td>                                                 
                                                    <td><?php echo (isset($admin['status'])) && $admin['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                            <?php echo anchor(base_url() . 'admin/admin-edit/' . $admin['admin_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>                                                       
                                                 
                                                <?php 
                                                if ($admin['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/admin-status/' . $admin['admin_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/admin-status/' . $admin['admin_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/admin-delete/' . $admin['admin_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
                                        </td>                                              
                                    </tr>    
                                                  <?php }
                            } else {
                                ?>  
                                <tr><td colspan="6" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
<?php } ?>   
                                            </tbody>
                                        </table>
                                    </div>                                

                                </div>
                            </div>                                                

                        </div>
                    </div>
</div>
<script>   
     $('body').delegate('.delete', 'click', function(evt) {
        var hrefUrl = $(this).attr('data-href');
       var box = $("#mb-remove-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });   
    
     $('body').delegate('.changestatus', 'click', function(evt) {   
	  var hrefUrl = $(this).attr('data-href'); 
         var box = $("#mb-status-row");
        box.addClass("open");
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
             window.location.href = hrefUrl;
        });
    });   
    
</script>
                        