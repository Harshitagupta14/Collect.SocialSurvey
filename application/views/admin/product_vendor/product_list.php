<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= site_url('admin/dashboard') ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active"><?php echo $breadcum; ?></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12" id="scrollToTop">
                <div class="alert alert-success" id="successMsg" style="display:none;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success! </strong> Product Has Been Added To Vendors List.
                </div>
                <?php if ($this->session->flashdata('ProductSuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('ProductSuccess') ?></div>
                <?php } if ($this->session->flashdata('ProductError')) { ?>
                    <div class="alert alert-danger"> <?= $this->session->flashdata('ProductError') ?></div>
                <?php } ?>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i><?php echo $breadcum; ?></div>

                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Code</th>
                                    <th>Product Price</th>
                                    <th>Quantity Available</th>
                                    <th>Quantity Required</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($product_data)) {
                                    foreach ($product_data as $product) {
                                        ?>
                                        <tr id="trow_<?= $key ?>">
                                            <td><strong><?php echo (isset($product['product_title'])) ? $product['product_title'] : '-'; ?></strong></td>
                                            <td><strong><?php echo (isset($product['product_code'])) ? $product['product_code'] : '-'; ?></strong></td>
                                            <td><strong><?php echo (isset($product['product_price'])) ? $product['product_price'] : '-'; ?></strong></td>
                                            <td><strong><?php echo (isset($product['product_quantity'])) ? $product['product_quantity'] : '-'; ?></strong></td>
                                            <td><input name="qty" id="qty<?= $product['product_id']; ?>"/></td>
                                            <td><?php echo (isset($product['status'])) && $product['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                            <td>
                                                <?php
                                                $count = $this->common_model->num_rows('tbl_vendor_products', array('prd_id_fk' => $product['product_id'], 'user_id' => $user_id));
                                                if ($count < 1) {
                                                    ?>
                                                    <a href = "javascript:;" class = "btn btn-primary btn-block addToCart" data-product_id = "<?= $product['product_id']; ?>" data-user-id = "<?= $user_id ?>"><i class = " icon-mail-2"></i> Add</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr><td colspan="7" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
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
    $('body').delegate('.addToCart', 'click', function () {
        var product_id = $(this).attr('data-product_id');
        var user_id = $(this).attr('data-user-id');
        var quantity = $('#qty' + product_id).val();
        if (quantity == '') {
            alert("Please Enter Quantity");
        } else {
            var baseurl = '<?php echo base_url() ?>';
            if (product_id != '') {

                $.ajax({
                    type: "POST",
                    async: 'false',
                    url: baseurl + "admin/add-vendor-product",
                    // dataType: "html",
                    data: {"product_id": product_id, "product_quantity": quantity, "user_id": user_id},
                    success: function (msg) {
                        $('#successMsg').show().delay(5000).fadeOut();
                        $('html,body').animate({scrollTop: $('#scrollToTop').offset().top}, 'slow');
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    }
                })
            } else {
                alert("Please Check Fields");
            }
        }

    });
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

