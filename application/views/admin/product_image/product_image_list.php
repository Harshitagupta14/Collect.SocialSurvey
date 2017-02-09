<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <?php if ($this->session->flashdata('ImageSuccess')) { ?>  
                    <div class="alert alert-success"> <?= $this->session->flashdata('ImageSuccess') ?></div>
                <?php } ?>
                      <form action="" method="post" id="specification_form" enctype="multipart/form-data">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Product Images</h3>
                     <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right" />
                </div>
                <div class="panel-body panel-body-table">
                  
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>Product Image</th> 
                                    <th>Image Color </th>
                                    <th>Is Featured</th> 
                                    <th>Sequence Number</th>
                                    <th>Status</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                if (!empty($product_image)) {
                                    $i = 0;
                                    foreach ($product_image as $product) {
                                        ?>
                                        <tr>
                                             <td>
                                                   <?php
                                               $file_path = FCPATH . "assets/uploads/product_images/" . $product['image_name'];
                                               if ($product['image_name'] != '' && file_exists($file_path)) {
                                                   ?>
                                                   <a class="fancybox fancybox.iframe" href="<?= $this->config->item('uploads') ?>product_images/<?= $product['image_name'] ?>">
                                                       <img class="media-object" width="50px" height="50px"  src="<?= $this->config->item('uploads') ?>product_images/<?= $product['image_name'] ?>" alt="" >
                                                   </a>
                                               <?php } else { ?>
                                                   <img width="50px" height="50px" src="<?=  $this->config->item('uploads') ?>product_images/image_not_available.jpg ">
                                               <?php } ?>   
                                             </td>
                                            <td>
                                                <input type="text" name="image_color[]" value="<?= $product['image_color'] ?>" class="form-control requiredField" />
                                            <input type="hidden" name="product_image_id[]" value="<?= $product['product_image_id'] ?>" />
                                            </td>                                           
                                            <td><input type="radio" value="<?= $product['product_image_id'] ?>" name="is_featured" <?php echo (isset($product['is_featured']) && $product['is_featured'] != 'no') ? 'checked' :'' ?> /></td>  
                                            <td><input type="text" name="seq_number[]" value="<?= $product['seq_number'] ?>" class="form-control requiredField" /></td>                                           
                                            <td>
                                                <select class="form-control requiredField" name="status[]">
                                                    <option value=''>Select</option>
                                                    <option value="active" <?php if ($product['status'] == 'active') { ?> selected="selected" <?php } ?>>Active</option>
                                                    <option value="inactive" <?php if ($product['status'] != 'active') { ?> selected="selected" <?php } ?>>Inactive</option>
                                                </select>
                                            </td>                                             <td>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/product-image-delete/' . $product['product_image_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>

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
                <form action="<?= site_url('admin/upload-product-images/'. $product_id ) ?>" class="dropzone dropzone-mini" id="my-awesome-dropzone" method="post">
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
    $('body').delegate('.check_all', 'click', function () {
        if ($(this).is(':checked')) {
            $('.chk_all').addClass('selectCheck');
            $('.chk_all').prop('checked', 'checked');
            $('.GreyBtn').attr('disabled', false);
        } else {
            $('.chk_all').removeClass('selectCheck');
            $('.chk_all').removeAttr('checked');
            $('.GreyBtn').attr('disabled', 'disabled');
        }
    });
    Dropzone.options.myAwesomeDropzone = {
        addRemoveLinks: false
    };
</script>


