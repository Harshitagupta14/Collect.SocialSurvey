<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>

<div class="main-container">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>">Dashboard</a></li>
            <li class="active">Order History</li>
        </ol>
        <?php if (!empty($message)) { ?>
            <div id="message">
                <?php echo $message; ?>
            </div
        <?php } ?>

        <div class="row">
            <div class="col-sm-3 page-sidebar">
                <aside>
                    <div class="inner-box">
                        <div class="user-panel-sidebar">
                            <div class="collapse-box">
                                <h5 class="collapse-title no-border"> My Account <a href="#MyClassified" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                                <div class="panel-collapse collapse in" id="MyClassified">
                                    <ul class="acc-list">

                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/dashboard') ?>"> <i class="icon-home"></i> Dashboard</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-account') ?>">Update Profile</a></li>
                                        <li  class="active"><a href="<?= site_url($this->config->item('public_login_url') . '/order-history') ?>">My Order History</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/change-password') ?>">Change Password</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/update-email') ?>">Change Email</a></li>
                                        <li><a href="<?= site_url($this->config->item('public_login_url') . '/logout') ?>">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Service Name</th>
                                <th>Service Code</th>
                                <th>Quantity(if any)</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $customer_id = $this->data['user']['uacc_id'];
                            $order_id = $this->order->getOrderIdByCustomerId($customer_id);
                            foreach ($order_id as $order) {
                                $order_detail = $this->order->getOrderItems($order['order_id']);
                                foreach ($order_detail as $order_item) {
                                    ?>
                                    <tr>
                                        <td><?= $order_item->order_id; ?></td>
                                        <td><?= $order_item->product_title; ?></td>
                                        <td><?= $order_item->product_code; ?></td>
                                        <td><?= $order_item->product_quantity; ?></td>
                                        <td><?= $order_item->total_product_price; ?></td>

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

    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>











