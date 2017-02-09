<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                    <?php if ($this->session->flashdata('StateSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('StateSuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Province</h3>
                                     <a href="<?= base_url()?>admin/province-add" class="btn btn-primary pull-right">Add New</a>
                                    
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions datatable">
                                            <thead>
                                                <tr>
                                                   <th>Country Name</th>                                    
                                                   <th>Province Name</th> 
                                                   <th>Gst</th> 
                                                   <th>Pst</th> 
                                                   <th>Hst</th> 
                                                   <th>Status</th>
                                                   <th>Action</th>  
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                 <?php
                                                if (!empty($province_data)) {
                                                    foreach ($province_data as $province) {
                                                        ?>
                                                <tr id="trow_<?= $key ?>">                                                
                                                    <td><strong><?php echo (isset($province['country_name'])) ? $province['country_name'] : '-'; ?></strong></td>   
                                                    <td><?php echo (isset($province['province_name'])) ? $province['province_name'] : '-'; ?></td> 
                                                    <td><?php echo (isset($province['gst'])) ? $province['gst'] : '-'; ?></td> 
                                                    <td><?php echo (isset($province['pst'])) ? $province['pst'] : '-'; ?></td> 
                                                    <td><?php echo (isset($province['hst'])) ? $province['hst'] : '-'; ?></td> 
                                                    <td><?php echo (isset($province['status'])) && $province['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                            <?php echo anchor(base_url() . 'admin/province-edit/' . $province['province_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>                                                       
                                        
                                                <?php if ($province['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/province-status/' . $province['province_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/province-status/' . $province['province_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/province-delete/' . $province['province_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
                                        </td> 
                                    </tr>    
                                                  <?php }
                            } else {
                                ?>  
                                <tr><td colspan="4" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
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
             
                        