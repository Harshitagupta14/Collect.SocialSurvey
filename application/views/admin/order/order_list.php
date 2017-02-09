<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php if ($this->session->flashdata('OrderSuccess')) { ?>  
                    <div class="alert alert-success"> <?= $this->session->flashdata('OrderSuccess') ?></div>
                <?php } ?>
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Orders</h3>                                   
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Order Number</th>         
                                    <th>Name</th>         
                                    <th>Email</th>     
                                    <th>Total</th>    
                                    <th>Order Time</th>      
                                    <!--<th>Date Of Delivery</th>-->      
                                    <th>Status</th>                                 
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                if (!empty($order_data)) {
                                    foreach ($order_data as $order) {
                                        ?>
                                        <tr id="trow">

                                            <td><strong>SBF-00<?php echo (isset($order['order_id'])) ? $order['order_id'] : '-'; ?></strong></td>
                                            <td><?php echo (isset($order['first_name'])) ? $order['first_name'].' '.$order['last_name'] : '-'; ?></td>
                                            <td><?php echo (isset($order['email_id'])) ? $order['email_id'] : '-'; ?></td>
                                            <td><?php echo (isset($order['total_amount'])) ? $order['total_amount'] : '-'; ?></td>
                                            <td><?php echo (isset($order['add_time'])) ? date('d-m-Y h:i A', $order['add_time']) : '-'; ?></td>
                                            <!--<td><?php// echo (isset($order['delivery_date'])) ? date('d-m-Y', $order['delivery_date']) : '-'; ?></td>-->
                                            <td>
                                                <?php if ($order['order_status'] == 'pending') { ?>
                                                    <span class="label btn-danger">Pending</span>
                                                <?php } else if ($order['order_status'] == 'completed') { ?>
                                                    <span class="label label-success">Completed</span>
                                                <?php } else if ($order['order_status'] == 'cancelled') { ?>
                                                    <span class="label label-info">Cancelled</span>
                                                <?php } ?>
                                            </td>                 
                                            <td>
                                                <a data-height="700" style="float: contour;" data-width="900" class="btn btn-default btn-rounded btn-condensed btn-sm" href="<?= base_url() . 'admin/order-view/' . $order['order_id']; ?>"><span class="fa fa-eye" title="view"></span></a> 

                                                <?php if ($order['order_status'] != 'cancelled') { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/order-status/' . $order['order_id'] . '/cancelled' ?>" class="btn btn-primary btn-rounded btn-condensed btn-sm changestatus" data-id="<?= $key ?>"><span class="fa fa-ban" title="cancel it"></span></a> 
                                                <?php } if ($order['order_status'] != 'completed') { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/order-status/' . $order['order_id'] . '/completed' ?>" class="btn btn-primary btn-rounded btn-condensed btn-sm changestatus" data-id="<?= $key ?>"><span class="fa fa-check-square" title="complete"></span></a>
                                                <?php } ?>                                                         
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/order-delete/' . $order['order_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times" title="delete"></span></a>
                                            </td> 
                                        </tr>    
                                        <?php
                                    }
                                }
                                ?>   
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
        box.find(".mb-control-yes").on("click", function() {
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });

    $('body').delegate('.changestatus', 'click', function(evt) {
        var hrefUrl = $(this).attr('data-href');
        var box = $("#mb-status-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click", function() {
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });

</script>