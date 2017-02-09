<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Order Detail</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="<?= $this->config->item('adminassets') ?>css/theme-default.css"/>     
    </head>
    <body>
        <div class="page-content-wrap">                    
            <div class="row">
                <div class="col-md-12">                            
                    <div class="panel panel-default">
                        <div class="panel-body">                            
                            <h2>INVOICE <strong>SBF-00<?= $view_data['order_id'] ?></strong></h2>
                            <div class="push-down-10 pull-right">
<!--                                        <button class="btn btn-default"><span class="fa fa-print"></span> Print</button>                                        -->
                            </div>
                            <!-- INVOICE -->
                            <div class="invoice">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="invoice-address">
                                            <h5>To</h5>
                                            <h6>Organization Name</h6>
                                            <p><?= $view_data['first_name'] .' '.$view_data['last_name'] ?></p>
                                            <p><?= $view_data['address'] ?></p>
                                            <p><strong>Email:</strong> <?= $view_data['email_id'] ?></p>
                                            <p><strong>Phone:</strong> <?= $view_data['contact_no'] ?></p>
                                            <p><strong>Comment:</strong> <?= $view_data['comments'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-address">
                                            <h5>From</h5>
                                            <h6>Your Company Name</h6>
                                            <p>SofaByFancy</p>
                                            <p>1255 Lorimar Drive <br>Mississauga, ON Canada <br>L5S 1R2</p>
                                            <p><strong>Email:</strong>  info@sofabyfancy.com</p>
                                            <p><strong>Phone:</strong> (905)-565-9566</p>
                                        </div>   
                                    </div>
                                    <!--                                            <div class="col-md-4">
                                                                                    <div class="invoice-address">
                                                                                        <h5>Invoice</h5>
                                                                                        <table class="table table-striped">
                                                                                            <tr>
                                                                                                <td width="200">Invoice Number:</td><td class="text-right">#Y14-152</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Invoice Date:</td><td class="text-right">23/11/2015</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><strong>Total:</strong></td><td class="text-right"><strong>$2,697.64</strong></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>      
                                                                                </div>-->
                                </div>
                                <div class="table-invoice">
                                    <table class="table">
                                        <tr>
                                            <th>Product Title</th>                                                                      
                                            <th>Quantity</th>                                                                                                                                       
                                            <th>Product Price</th>    
                                            <th>Total Price</th>    
                                        </tr>
                                        <?php foreach ($order_item as $order) { ?>                                                            
                                            <tr>         
                                                <td><?php echo (isset($order['product_title'])) ? $order['product_title'] : '-'; ?></td>
                                                <td><?php echo (isset($order['product_quantity'])) ? $order['product_quantity'] : '-'; ?></td>
                                                <td><?php echo (isset($order['unit_product_price'])) ? number_format($order['unit_product_price'], 2, '.', '') : '-'; ?></td>
                                                <td><?php echo (isset($order['total_product_price'])) ? number_format($order['total_product_price'], 2, '.', '') : '-'; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>  
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--                                                <h4>Payment Methods</h4>
                                                                                        
                                                                                        <div class="paymant-table">
                                                                                            <a href="#" class="active">
                                                                                                <img src="img/cards/paypal.png"/> PayPal
                                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                                                            </a>
                                                                                            <a href="#">
                                                                                                <img src="img/cards/visa.png"/> Visa
                                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                                                            </a>
                                                                                            <a href="#">
                                                                                                <img src="img/cards/mastercard.png"/> Master Card
                                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                                                            </a>
                                                                                        </div>-->
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Amount Due</h4>

                                        <table class="table table-striped">
                                            <tr>
                                                <td width="200"><strong>Sub Total:</strong></td><td class="text-right">$<?php echo number_format($view_data['sub_total'], 2, '.', '') ?></td>
                                            </tr>

                                            <?php if ($view_data['gst_per'] != '0' && $view_data['gst_per'] != '0.00') { ?>
                                                <tr>
                                                    <td><strong>GST(<?= $view_data['gst_per'] ?> %) :</strong></td><td class="text-right"><?php echo number_format($view_data['gst'], 2, '.', '') ?></td>
                                                </tr>
                                            <?php } ?>    
                                            <?php if ($view_data['pst_per'] != '0' && $view_data['pst_per'] != '0.00') { ?>
                                                <tr>
                                                    <td><strong>PST(<?= $view_data['pst_per'] ?> %) :</strong></td><td class="text-right"><?php echo number_format($view_data['pst'], 2, '.', '') ?></td>
                                                </tr>
                                            <?php } ?>    
                                            <?php if ($view_data['hst_per'] != '0' && $view_data['hst_per'] != '0.00') { ?>
                                                <tr>
                                                    <td><strong>HST(<?= $view_data['hst_per'] ?> %) :</strong></td><td class="text-right"><?php echo number_format($view_data['hst'], 2, '.', '') ?></td>
                                                </tr>
                                            <?php } ?>                                        
                                            <?php if ($view_data['discount'] != '0' && $view_data['discount'] != '0.00') { ?>
                                                <tr>
                                                    <td><strong>Discount:</strong></td><td class="text-right"><?php echo number_format($view_data['discount'], 2, '.', '') ?></td>
                                                </tr>
                                            <?php } ?>   
                                            <?php if ($view_data['delivery_charges'] != '0' && $view_data['delivery_charges'] != '0.00') { ?>
                                                <tr>
                                                    <td><strong>Delivery Charges:</strong></td><td class="text-right"><?php echo number_format($view_data['delivery_charges'], 2, '.', '') ?></td>
                                                </tr>
                                            <?php } ?>   
                                            <tr class="total">
                                                <td>Total Amount:</td><td class="text-right">$<?php echo number_format($view_data['total_amount'], 2, '.', '') ?></td>
                                            </tr>
                                        </table>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>                                    
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/bootstrap/bootstrap.min.js"></script>      
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/datatables/jquery.dataTables.min.js"></script>  
        <!-- END PLUGINS -->
        <!-- THIS PAGE PLUGINS -->
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins/owl/owl.carousel.min.js"></script>             
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/plugins.js"></script>      
        <script type="text/javascript" src="<?= $this->config->item('adminassets'); ?>js/actions.js"></script>     
    </body>
</html>