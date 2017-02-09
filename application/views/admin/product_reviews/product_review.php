<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                 <?php if ($this->session->flashdata('ProductReviewSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('ProductReviewSuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Blog Comment</h3>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Subject</th>
                                                    <th>Review</th>
                                                    <th>Read Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>   
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                   <?php
                                                    if (!empty($product_review_data)) {
                                                        foreach ($product_review_data as $review) {
                                                            ?>
                                                <tr id="trow_<?= $key ?>">
                                                   
                                                    <td><strong><?php echo (isset($review['cust_full_name'])) ? $review['cust_full_name'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($review['email'])) ? $review['email'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($review['subject'])) ? $review['subject'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($review['review'])) ? $review['review'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($review['read_status'])) ? $review['read_status'] : '-'; ?></strong></td>
                                                    <td><?php echo (isset($review['status'])) && $review['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                           
                                                <?php if ($review['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/product_review-status/' . $review['review_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/product_review-status/' . $review['review_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/product_review-delete/' . $review['review_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                           <a data-height="800" style="float: contour;" data-width="790" class="fancybox fancybox.iframe btn btn-default btn-rounded btn-condensed btn-sm" href="<?= base_url() . 'admin/product_review-view/'.$review['review_id'] ;?>"><span class="fa fa-eye" title="view"></span></a> 
                                                
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
                        