  <?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
  <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" id="theme" href="<?= $this->config->item('adminassets') ?>css/dropzone/dropzone.css"/>
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Account</a></li>
            <li class="active">Upload Work Image</li>
        </ol>
        <?php if ($this->session->flashdata('ImageSuccess')) { ?>  
                    <div class="alert alert-success"> <?= $this->session->flashdata('ImageSuccess') ?></div>
        <?php } ?>    
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">       
                      <form action="" method="post" id="specification_form" enctype="multipart/form-data">
                <div class="panel-heading">
					
                    <div class="panel-title">Your Work Images 
					 <a href="<?php echo site_url('account/upload-work-image');?>" class="btn btn-primary" >Update</a>
					 <input type="submit" name="update_account" id="submit" value="Submit" class="btn btn-primary pull-right"/>
					</div>
                     
                </div>
                <div class="panel-body panel-body-table">
                  
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>Work Image</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                if (!empty($work_image)) {
                                    $i = 0;
                                    foreach ($work_image as $image) {
                                        ?>
                                        <tr>
                                            <td>
                                                   <?php
                                               $file_path = FCPATH . "assets/uploads/service_provider_work_images/" . $image['image_name'];
                                               if ($image['image_name'] != '' && file_exists($file_path)) {
                                                   ?>
                                                   <a class="fancybox fancybox.iframe" href="<?= $this->config->item('uploads') ?>service_provider_work_images/<?= $image['image_name'] ?>">
                                                       <img class="media-object" width="50px" height="50px"  src="<?= $this->config->item('uploads') ?>service_provider_work_images/<?= $image['image_name'] ?>" alt="" >
                                                   </a>
                                               <?php } else { ?>
                                                   <img width="50px" height="50px" src="<?=  $this->config->item('uploads') ?>service_provider_work_images/image_not_available.jpg ">
                                               <?php } ?>   
                                             </td>                              
                                           <td> <a href="<?= base_url() . 'account/work-image-delete/' . $image['partner_image_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>
											</td> 
                                        </tr>    
                                        <?php
                                         $i++;
                                    }
                                    
                                } else {
                                    ?>  
                                    <tr><td colspan="5" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                    </div>          
                        
                    
                </div>
                              </form>
            </div>                                                

        </div>
        <div class="col-md-3">
            <div class="block push-up-10">
                <form action="<?= site_url('account/upload-work-image/'. $user['upro_uacc_fk']) ?>" class="dropzone dropzone-mini" id="my-awesome-dropzone" method="post">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/dropzone/dropzone.min.js"></script>

<script>
    $('body').delegate('.delete', 'click', function (evt) {
        var hrefUrl = $(this).attr('data-href');
        var box = $("#mb-remove-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });

    $('body').delegate('.changestatus', 'click', function (evt) {
        var hrefUrl = $(this).attr('data-href');
        var box = $("#mb-status-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });

</script>



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
<?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>
