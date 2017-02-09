<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= site_url('admin/dashboard') ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active">
                    <?php echo $breadcum ?>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('ProductSuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('ProductSuccess') ?></div>
                <?php } ?>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Manage Product </div>

                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Product Type</th>
                                    <th>Status</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($product_data)) {
                                    foreach ($product_data as $product) {
                                        ?>
                                        <tr id="trow_<?= $key ?>">
                                            <td><strong><?php echo (isset($product['product_title'])) ? $product['product_title'] : '-'; ?></strong></td>
                                            <td><strong><?php echo (isset($product['slug'])) ? $product['slug'] : '-'; ?></strong></td>

                                            <td><strong><?php echo $this->product->getProductCategory($product['category_id'])->category_name; ?></strong></td>
                                            <td><strong><?php echo $this->product->getProductSubCategory($product['subcat_id'])->category_name; ?></strong></td>
                                            <td><strong><?php echo $this->product->getProductType($product['prd_type_id'])->prd_type_name; ?></strong></td>
                                            <td><?php echo (isset($product['status'])) && $product['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                            <td>
                                                <?php echo anchor(base_url() . 'admin/product-edit/' . $product['product_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>

                                                <?php if ($product['status'] == 'active') { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/product-status/' . $product['product_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/product-status/' . $product['product_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/product-delete/' . $product['product_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>

                                                <a href="<?= base_url() . 'admin/product_image-list/' . $product['product_id'] ?>" class="btn btn-danger btn-rounded">Manage Images</a>
                                                <a href="<?= base_url() . 'admin/product_review-list/' . $product['product_id'] ?>" class="btn btn-danger btn-rounded">Manage Reviews</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr><td colspan="5" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

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

