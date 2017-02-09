<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= site_url('admin/dashboard') ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active"><?php echo (isset($parent_id) && $parent_id != '') ? $breadcum . ' <i class="fa fa-angle-right"></i>  ' . $category_name : $breadcum; ?></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('ProductCategorySuccess')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('ProductCategorySuccess') ?></div>
                <?php } ?>
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i><?php echo (isset($parent_id) && $parent_id != '') ? $breadcum_sub : $breadcum; ?></div>

                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">

                            <thead>
                                <tr>
                                    <th>Category Title</th>
                                    <th>Slug</th>
                                    <th>Category Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($category_data)) {
                                    foreach ($category_data as $category) {
                                        ?>
                                        <tr id="trow_<?= $key ?>">
                                            <td><?php echo (isset($category['category_name'])) ? $category['category_name'] : '-'; ?></td>
                                            <td><?php echo (isset($category['slug'])) ? $category['slug'] : '-'; ?></td>
                                            <td>  <?php
                                                $file_path = FCPATH . "assets/uploads/category_images/" . $category['category_image'];
                                                if ($category['category_image'] != '' && file_exists($file_path)) {
                                                    ?>
                                                    <a class="fancybox" href="<?= $this->config->item('uploads') ?>category_images/<?= $category['category_image'] ?>">
                                                        <img width="50px" height="50px"  src="<?= $this->config->item('uploads') ?>category_images/<?= $category['category_image'] ?>">
                                                    </a>
                                                <?php } else { ?>
                                                    <img width="50px" height="50px" src="<?= $this->config->item('uploads') ?>category_images/image_not_available.jpg ">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo (isset($category['status'])) && $category['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                            <td>
                                                <?php echo anchor(base_url() . 'admin/category-edit/' . $category['category_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>

                                                <?php $prnt_id = $this->common_model->getSingleFieldFromAnyTable('parent_id', 'category_id', $category['category_id'], 'tbl_category'); ?>
                                                <?php
                                                if ($prnt_id) {
                                                    $cat_row = $this->category->getCategoryById($prnt_id);
                                                    ?>
                                                    <?php
                                                } if ($cat_row) {
                                                    $cat_row1 = $this->category->getCategoryById($cat_row['parent_id']);
                                                    ?>
                                                <?php } if ($cat_row1['parent_id'] != '0') { ?>
                                                    <?php echo anchor(base_url() . 'admin/category-list/' . $category['category_id'], '<span class="fa fa-table" title="Sub Categories"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>
                                                <?php } ?>

                                                <?php if ($category['status'] == 'active') { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/category-status/' . $category['category_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/category-status/' . $category['category_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/category-delete/' . $category['category_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete" data-id="<?= $key ?>"><span class="fa fa-times" title="delete"></span></a>

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
