<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php if ($this->session->flashdata('HeaderLinkSuccess')) { ?>  
                    <div class="alert alert-success"> <?= $this->session->flashdata('HeaderLinkSuccess') ?></div>
                <?php } ?>
                <form method="post">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $breadcum ?></h3>
                        <a href="<?= site_url('admin/nav_menu-add') ?>" class="btn btn-primary pull-right">Add New</a>                
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>  
                                        <th>Nav Title</th>
                                        <th>Nav Url </th>
                                        <th>Group Name</th>
                                        <th>Position</th>                           
                                        <!--<th>Is Parent</th>-->
                                        <th>Status</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php
                                    foreach ($nav_menu_data as $nav_menu) {
                                        $group_name = $this->common_model->getSingleFieldFromAnyTable('group_title','group_id',$nav_menu['group_id_fk'],'tbl_nav_groups');         
                                        ?>
                                        <tr id="trow">
                                            <td><strong><?php echo $nav_menu['nav_title'] ?></strong></td>
                                            <td><strong><?php echo $nav_menu['nav_url'] ?></strong></td>
                                            <td><strong><?php echo $group_name ?></strong></td>
                                            <td><strong><?php echo $nav_menu['nav_position'] ?></strong></td>
                                            <!--<td><?php echo (isset($nav_menu['is_parent'])) && $nav_menu['is_parent'] == 'yes' ? "<span class='label label-info'>Yes" : "<span class='label label-warning'>No"; ?></td>-->
                                            <td><?php echo (isset($nav_menu['status'])) && $nav_menu['status'] == 'active' ? "<span class='label label-success'>Active" : "<span class='label label-danger'>Inactive"; ?></td>
                                            <td>
                                                <?php echo anchor(base_url() . 'admin/nav_menu-edit/' . $nav_menu['nav_menu_id'], '<span class="fa fa-pencil" title="Edit"></span>', 'class="btn btn-default btn-rounded btn-condensed btn-sm"'); ?>                                                       

                                                
                                                   
                                                <?php if ($nav_menu['status'] == 'active') { ?>
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/nav_menu-status/' . $nav_menu['nav_menu_id'] . '/inactive' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-ban" title="Inactive"></span></a>
                                                <?php } else { ?>    
                                                    <a href="javascript:" data-href="<?= base_url() . 'admin/nav_menu-status/' . $nav_menu['nav_menu_id'] . '/active' ?>" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                                <?php } ?>
                                                <a href="javascript:" data-href="<?= base_url() . 'admin/nav_menu-delete/' . $nav_menu['nav_menu_id'] ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"><span class="fa fa-times" title="delete"></span></a>

                                            </td> 
                                        </tr>    
                                    <?php } ?>   
                                </tbody>
                            </table>
                        </div>                                

                    </div>
                </form>
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

