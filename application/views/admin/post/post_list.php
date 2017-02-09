<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                    <?php if ($this->session->flashdata('PostSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('PostSuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Post</h3>
                                       <a href="<?= base_url()?>admin/post-add" class="btn btn-primary pull-right">Add New</a>  
                                    
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions datatable">
                                            <thead>
                                                <tr>
                                                    <th>Post Name</th>
                                                    <th>Slug</th>
                                                    <th>Content</th>
                                                    <th>Status</th>
                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                 <?php
                                                if (!empty($post_data)) {
                                                    foreach ($post_data as $post) { //pr($post);die;
                                                        ?>
                                                <tr id="trow_<?= $key ?>">
                                                    <td><strong><?php echo(isset($post['post_name']))?$post['post_name']:'-';?></strong></td>
                                                    <td><strong><?php echo (isset($post['slug'])) ? $post['slug'] : '-'; ?></strong></td>
                                                    <td><strong><?php echo (isset($post['post_content'])) ? $post['post_content'] : '-'; ?></strong></td>
                                                  
                                                    <td><?php echo (isset($post['status'])) && $post['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                                    <td>
                                            <?php echo anchor(base_url() . 'admin/post-edit/' . $post['post_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>                                                       
                                        
                                                <?php if ($post['status'] == 'active') { ?>
                                                        <a href="javascript:" data-href="<?= base_url() . 'admin/post-status/' . $post['post_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/post-status/' . $post['post_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/post-delete/' . $post['post_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
                                         
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
             
                        