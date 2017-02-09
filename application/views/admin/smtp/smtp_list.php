<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                    <?php if ($this->session->flashdata('SmtpSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('SmtpSuccess') ?></div>
                                <?php } ?>
                                    <?php if ($this->session->flashdata('SmtpError')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('SmtpError') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Smtp Links</h3>
                                     <a href="<?= base_url()?>admin/smtp-add" class="btn btn-primary pull-right">Add New</a>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Smtp User</th>                      
                                                    <th>Smtp Host</th>    
                                                    <th>Smtp Port</th>
                                                    <th>Status</th>
                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                 <?php
                                                if (!empty($smtp_data)) {
                                                    foreach ($smtp_data as $smtp) {
                                                        ?>
                                                <tr id="trow_<?= $key ?>">
                                                    <td><strong><?php echo (isset($smtp['smtp_user'])) ? $smtp['smtp_user'] : '-'; ?></strong></td>                               
                                                     <td><strong><?php echo (isset($smtp['smtp_host'])) ? $smtp['smtp_host'] : '-'; ?></strong></td>
                                                     <td><strong><?php echo (isset($smtp['smtp_port'])) ? $smtp['smtp_port'] : '-'; ?></strong></td>
                                                    <td><?php echo (isset($smtp['status'])) && $smtp['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                            <?php echo anchor(base_url() . 'admin/smtp-edit/' . $smtp['smtp_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>                                                       
                                        
                                                <?php if ($smtp['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/smtp-status/' . $smtp['smtp_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/smtp-status/' . $smtp['smtp_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/smtp-delete/' . $smtp['smtp_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
                                        </td> 
                                    </tr>    
                                                  <?php }
                            } else {
                                ?>  
                                <tr><td colspan="5" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
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
             
                        