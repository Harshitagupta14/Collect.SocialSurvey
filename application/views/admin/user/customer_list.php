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
            <div class="col-md-12">
                <?php if ($this->session->flashdata('CustomerSuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('CustomerSuccess') ?></div>
                <?php } if ($this->session->flashdata('CustomerError')) { ?>
                    <div class="alert alert-danger"> <?= $this->session->flashdata('CustomerError') ?></div>
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
                                    <th>Customer Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Customer Actions</th>
                                    <th>Product Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($customer_data)) {
                                    foreach ($customer_data as $key => $customer) {
                                        ?>
                                        <tr id="trow_<?= $key ?>">
                                            <td><strong><?php echo (isset($customer['upro_first_name'])) ? $customer['upro_first_name'] . " " . $customer['upro_last_name'] : '-'; ?></strong></td>
                                            <td><?php echo (isset($customer['upro_phone'])) ? $customer['upro_phone'] : '-'; ?></td>
                                            <td><?php echo (isset($customer['uacc_email'])) ? $customer['uacc_email'] : '-'; ?></td>
                                            <td><?php echo (isset($customer['uacc_active'])) && $customer['uacc_active'] == 1 ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                            <td>
                                                <!--  <?php echo anchor(base_url() . 'admin/customer-edit/' . $customer['uacc_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?> -->

                                                <?php if ($customer['uacc_active'] == 1) { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/customer-status/' . $customer['uacc_id'] . '/0' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/customer-status/' . $customer['uacc_id'] . '/1' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/customer-delete/' . $customer['uacc_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>

                                            </td>
                                            <td>
                                                <?php echo anchor(base_url() . 'admin/add-vendor-products-list/' . $customer['uacc_id'], '<span class="fa fa-plus" title="Add Products "></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>

                                                <?php echo anchor(base_url() . 'admin/manage-vendor-products-list/' . $customer['uacc_id'], '<span class="fa fa-table" title="Manage Products"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?> </td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr><td colspan="6" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
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
