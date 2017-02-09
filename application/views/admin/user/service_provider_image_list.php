<style>
    .modal-dialog {width:600px;}
    .thumbnail {margin-bottom:6px;}
</style>
<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li>
</ul>
<div class="container">
    <div class="row">
		 <h3>Aadhar Image of Partner</h3>
         <div class="row"><div class="col-lg-3 col-sm-4 col-xs-6"><a title="<?php echo $partner_images[0]['upro_identity_image']; ?>" href="#"><img class="thumbnail img-responsive" src="<?php echo $this->config->item('base_url_partner').'assets/uploads/service_provider_identification_images/' . $partner_images[0]['upro_identity_image']; ?>"></a></div></div> <hr>
         <h3>Work Image of Partner</h3>
		<?php
        foreach ($partner_images as $key => $images) {?>
            <div class="col-lg-3 col-sm-4 col-xs-6"><a title="<?php echo $images['image_name']; ?>" href="#"><img class="thumbnail img-responsive" src="<?php echo $this->config->item('base_url_partner').'assets/uploads/service_provider_work_images/' . $images['image_name']; ?>"></a></div>
                <?php } ?>
        <hr>
		<hr>
    </div>
</div>
<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title">Heading</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.thumbnail').click(function () {
            $('.modal-body').empty();
            var title = $(this).parent('a').attr("title");
            $('.modal-title').html(title);
            $($(this).parents('div').html()).appendTo('.modal-body');
            $('#myModal').modal({show: true});
        });
    });
</script>