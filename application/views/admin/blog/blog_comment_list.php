<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                 <?php if ($this->session->flashdata('BlogSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('BlogSuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Blog Comment</h3>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Comment By</th>
                                                    <th>Email</th>
                                                    <th>Comment</th>
                                                    <th>Status</th>
                                                    <th>Action</th>   
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                   <?php
                                                    if (!empty($comment_data)) {
                                                        foreach ($comment_data as $comment) {
                                                            ?>
                                                <tr id="trow_<?= $key ?>">
                                                   
                                                    <td><strong><?php echo (isset($comment['full_name'])) ? $comment['full_name'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($comment['email'])) ? $comment['email'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($comment['comment'])) ? $comment['comment'] : '-'; ?></strong></td>
                                                    <td><?php echo (isset($comment['status'])) && $comment['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                           
                                                <?php if ($comment['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/comment-status/' . $comment['bg_comment_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/comment-status/' . $comment['bg_comment_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/comment-delete/' . $comment['bg_comment_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
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
                        