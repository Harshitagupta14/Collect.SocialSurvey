<section class="content_section">
    <div class="container">
        <div class="row">
            <?php echo $this->load->view($this->config->item('template') . '/categoryList') ?>
            <div class="col-sm-12 col-md-9 cat_bar">
                <div class="mid">    
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $i = 1;
                            foreach ($banner_slider as $banner) {
                                ?> 
                                <div class="item <?= $i == 1 ? 'active' : ''; ?>">
                                    <img src="<?= $this->config->item('uploads') ?>banner_images/<?= $banner['banner_image'] ?>" alt="" class="img-responsive">
                                </div>
                                <?php
                                $i++;
                            }
                            ?>  
                        </div>
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="tabed_box">
                    <ul class="mytab" role="tablist">
                        <?php
                        $i = 1;
                        foreach ($home_product_types as $home_product_type) {
                            if ($i == 1) {
                                $product_data = $this->product->getProductByArguments(FALSE, $home_product_type['prd_type_id'], FALSE, FALSE, FALSE, 6);
                            }
                            ?>  
                            <li role="presentation" class="productTypes <?php echo ($i == 1) ? 'active' : '' ?> ">
                                <a href="javascript:;" data-attr="<?= $home_product_type['prd_type_id'] ?>"> <?= $home_product_type['prd_type_name']; ?></a>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>
                    <div class="row tab-content" id="product_div">
                        <div role="tabpanel" class="tab-pane active">
                            <?php
                            $j = 1;
                            if (isset($product_data) && !empty($product_data))
                                foreach ($product_data as $product) {
                                    $product_featured_image = $this->product->get_product_featured_image($product['product_id']);
                                    ?>
                                    <div class="col-xs-6 col-sm-4 col-md-4 full_width">
                                        <div class="tab_pro">
                                            <?php
                                            $file_path = FCPATH . "assets/uploads/product_images/" . $product_featured_image->image_name;
                                            if ($product_featured_image->image_name != '' && file_exists($file_path)) {
                                                ?>
                                                <a href="<?= site_url('product/' . $product['slug']) ?>">
                                                    <img class="img-responsive" src="<?= site_url() . image('uploads/product_images/' . $product_featured_image->image_name, array(250, 250)) ?>">
                                                </a>
                                            <?php } else { ?>
                                                <img class="img-responsive" src="http://www.placehold.it/250x250/EFEFEF/AAAAAA&amp;text=no+image">
                                            <?php } ?>
                                            <h2><a href="<?= site_url('product/' . $product['slug']) ?>"><?= $product['product_title'] ?></a></h2>
                                            <p><?= character_limiter($product['product_small_description'], 200) ?> </p>
                                            <a href="<?= site_url('product/' . $product['slug']) ?>" class="view">View Detail</a>
                                        </div>
                                    </div>
                                    <?php if ($j % 3 == 0) { ?>
                                        <div class="clearfix"></div>
                                        <?php
                                    } $j++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="anounce">
    <div class="container">
        <?php $page_content = $this->post_data->getPostRecordByAttributes(3, FALSE); ?>
        <?= $page_content->post_content ?>
    </div>
</div>
<script>
    $('body').delegate('.productTypes', 'click', function () {
        var type_id = $(this).find('a').attr('data-attr');
        $(".productTypes").removeClass("active");
        $(this).addClass("active");
        if (type_id != '') {
            $.ajax({
                type: "POST",
                async: 'false',
                dataType: "json",
                url: baseurl + "product-types",
                data: {
                    "prd_type_id": type_id
                },
                success: function (data) {
                    if (data.success) {
                        $(this).addClass('active');
                        $('#product_div').empty().append(data.html);
                    }
                }
            });
        }
    });
</script>  