<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li>
</ul>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php if ($this->session->flashdata('CustomerSuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('CustomerSuccess') ?></div>
                <?php } if ($this->session->flashdata('CustomerError')) { ?>
                    <div class="alert alert-danger"> <?= $this->session->flashdata('CustomerError') ?></div>
                <?php } ?>
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Service Provider</h3>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url() ?>admin/admin-add"><span class="fa fa-plus-square"></span>Add New</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions datatable">
                            <thead>
                                <tr>
                                    <th>Service Provider Full Name</th>
                                    <th>Company Name</th>
                                    <th>Company Detail</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($service_provider_data)) {
                                    foreach ($service_provider_data as $key => $service_provider) {
                                        ?>
                                        <tr id="trow_<?= $key ?>">
                                            <td><strong><?php echo (isset($service_provider['upro_first_name'])) ? $service_provider['upro_first_name'] . " " . $service_provider['upro_last_name'] : '-'; ?></strong></td>
                                            <td><strong><?php echo (isset($service_provider['upro_company'])) ? $service_provider['upro_company'] : '-'; ?></strong></td>

                                            <td><strong><?php echo (isset($service_provider['upro_company_detail'])) ? $service_provider['upro_company_detail'] : '-'; ?></strong></td>

                                            <td><?php echo (isset($service_provider['upro_phone'])) ? $service_provider['upro_phone'] : '-'; ?></td>
                                            <td><?php echo (isset($service_provider['uacc_email'])) ? $service_provider['uacc_email'] : '-'; ?></td>
                                            <td>
											<?php if(isset($service_provider['upro_verified']) && $service_provider['upro_verified'] == 1){
												  echo "<span class='label label-success'>Active"; 
											     }else if(isset($service_provider['upro_verified']) && $service_provider['upro_verified'] == 2){
											      echo "<span class='label label-warning'>Under Reivew";
												 }else if(isset($service_provider['upro_verified']) && $service_provider['upro_verified'] == 0){
											      echo "<span class='label label-danger'>In Active";
												 }
											?>
											
											</td>
                                            <td>
                                                <!--  <?php echo anchor(base_url() . 'admin/customer-edit/' . $service_provider['uacc_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?> -->
												<?php if ($service_provider['upro_verified'] == 1) { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/service-provider-status/' . $service_provider['upro_id'] . '/2' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Under Review"></span></a>
                                                <?php } else if($service_provider['upro_verified'] == 2) { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/service-provider-status/' . $service_provider['upro_id'] . '/1' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
													<a href="<?= base_url() . 'admin/service-provider-check-images/' . $service_provider['uacc_id'] ?>" class="btn btn-danger btn-rounded">Check Images</a>
												<?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/service-provider-delete/' . $service_provider['uacc_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>     
                                            </td>
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
