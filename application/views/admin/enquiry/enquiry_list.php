<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <?php if ($this->session->flashdata('EnquirySuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('EnquirySuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Enquiry</h3>                                   
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>         
                                                    <th>Email</th>     
                                                    <th>Company Name</th>
                                                    <th>Message</th> 
                                                    <th>Read Status</th>
                                                    <th>Action</th>   
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <?php
                                                if (!empty($enquiry_data)) {
                                                    foreach ($enquiry_data as $enquiry) {
                                                        ?>
                                                <tr id="trow_<?= $key ?>">
                                                   
                                                    <td><?php echo (isset($enquiry['full_name'])) ? $enquiry['full_name'] : '-'; ?></td>
                                                    <td><?php echo (isset($enquiry['email_id'])) ? $enquiry['email_id'] : '-'; ?></td>
                                                    <td><?php echo (isset($enquiry['company_name'])) ? $enquiry['company_name'] : '-'; ?></td>
                                                    <td><?php echo (isset($enquiry['message'])) ? $enquiry['message'] : '-'; ?></td>
                                                    <td><?php echo (isset($enquiry['read_status'])) && $enquiry['read_status'] == 'read' ? "Read" : "Unread"; ?></td>
                                                                                              
                                                    <td>
                                                           <a data-height="800" style="float: contour;" data-width="790" class="fancybox fancybox.iframe btn btn-default btn-rounded btn-condensed btn-sm" href="<?= base_url() . 'admin/enquiry-view/'.$enquiry['client_id'] ;?>"><span class="fa fa-eye" title="view"></span></a> 
                                                           
<!--                                                 <a href="javascript:" data-href="<?= base_url() . 'admin/change-password/' . $enquiry['client_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm changepassword" data-toggle="modal" data-target="#modal_change_password" data-id="<?= $key ?>"><span class="fa fa-powe-off" title="change"></span></a>              -->                                        
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/enquiry-delete/' . $enquiry['client_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
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
    
</script>
                        