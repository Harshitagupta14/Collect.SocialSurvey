<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php
            $current_url = current_url();
            $meta_tags = $this->common_model->getMetaTags($current_url);
            if ($meta_tags) {
                $METATITLE = $meta_tags['metatag_title'];
                $METAKEYWORDS = $meta_tags['metatag_keyword'];
                $METADESCRIPTION = $meta_tags['metatag_description'];
            }
            if ($METATITLE) {
                echo $METATITLE;
            } else {
                echo $this->config->item('site_title');
            }
            ?>
        </title>
        <?php if ($METAKEYWORDS) { ?>
            <meta name="keywords" content="<?php echo $METAKEYWORDS ?>" />
        <?php } else { ?>
            <meta name="keywords" content="<?php echo $this->config->item('meta_keywords'); ?>" />
        <?php } ?>
        <?php if ($METADESCRIPTION) { ?>
            <meta name="description" content="<?php echo $METADESCRIPTION ?>" />
        <?php } else { ?>
            <meta name="description" content="<?php echo $this->config->item('meta_description'); ?>" />
        <?php } ?>
        <link href="<?= $this->config->item('frontassets') ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?= $this->config->item('frontassets') ?>css/font-awesome.css" rel="stylesheet">
        <script src="<?= $this->config->item('frontassets') ?>js/jquery.min.js"></script>
        <link href="<?= $this->config->item('frontassets') ?>css/bootstrap-theme.css" rel="stylesheet">
        <!--<script src="<?= $this->config->item('frontassets') ?>js/jquery-1.10.2.js"></script> -->
        <script src="<?= $this->config->item('frontassets') ?>js/jquery-ui.js"></script>
        <script src="<?= $this->config->item('frontassets') ?>js/carousel.js"></script>
        <script src="<?= $this->config->item('frontassets') ?>js/script.js"></script>
        <script src="<?= $this->config->item('frontassets') ?>js/bootstrap-select.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= $this->config->item('frontassets') ?>css/thumbelina.css" />
        <script type="text/javascript" src="<?= $this->config->item('frontassets') ?>js/thumbelina.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= $this->config->item('frontassets') ?>css/cloudzoom.css" />
        <script type="text/javascript" src="<?= $this->config->item('frontassets') ?>js/cloudzoom.js"></script>
        <script>
            var baseurl = '<?= base_url() ?>';
        </script>
    </head>
    <body>
        <header>
            <div class="topbar">
                <div class="container">
                    <ul class="top_list">
                        <?php
                        if ($this->flexi_auth->is_logged_in()) {
                            $user_data = $this->flexi_auth->get_user_by_identity_row_array();
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?= site_url('account/logout') ?>">Signout <i class="glyphicon glyphicon-off"></i> </a></li>
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?= $user_data['uacc_email']; ?></span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
                                    <ul class="dropdown-menu user-menu">
                                        <li class="active"><a <?= site_url('account/dashboard') ?>><i class="icon-home"></i> Account
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="post-ads.html">Post Free Add</a></li>
                            </ul>
                        <?php } else { ?>
                            <li><a data-target="#login-modal" data-toggle="modal" href="javascript:;">Sign In</a></li>
                            <li><a data-target="#register-modal" data-toggle="modal" href="javascript:void(0);">Create an Account</a></li>
                        <?php } ?>
                        <li class="dropdown">
                            <div id="google_translate_element"></div><script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                }
                            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </li>
                        <li><a href="<?= site_url('contact'); ?>">Contact</a></li>

                    </ul>
                </div>
            </div>
            <div class="logosec">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="logo"><a href="<?= site_url() ?>"><img src="<?= $this->config->item('frontassets') ?>img/logo.png" alt="Catslink"></a></div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="search-outer">
                                <div class="col-sm-10 col-md-9">
                                    <form id="" method="get" action="<?= site_url('product-search') ?>">
                                        <div class="input-group">

                                            <input type="text" name="search" class="form-control" placeholder="<?php translate("Search for...", $this->config->item('lang_abbr')); ?>">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                            </span>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <div class="btn-group cart_text">
                                        <?php $cart_items_data = $this->common_model->countCartItems(); ?>
                                        <a href="<?= site_url('cart') ?>" class="btn btn-danger" id="total_cart_items">CART <small>(<?= $cart_items_data ?>)</small></a>

                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="fa fa-angle-down"></span>
                                        </button>
                                        <?php $cart_items = $this->common_model->getCartItemDetail(); ?>
                                        <div class="cart_box">
                                            <?php foreach ($cart_items as $items) { ?>
                                                <a href="#"><?= $items['product_title'] ?> <span class="badge"><?= $items['product_quantity']; ?></span></a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <ul class="nav navbar-nav">
                            <?php
                            $headerlinks = $this->common_model->getHeaderLinks(); //pr($headerlinks);die;
                            foreach ($headerlinks as $header) {
                                ?>
                                <li <?php echo (trim($this->common_model->curPageURL(), '/') == trim(($header['nav_url']), '/')) ? 'class="active"' : '' ?>>
                                    <a href="<?= $header['nav_url'] ?>"><?= $header['nav_title'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="clearfix"></div>