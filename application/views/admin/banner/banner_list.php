<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#banner-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :baseurl+"admin/banner-grid-data", // json datasource
						type: "post",// method  , by default get
						error: function(){  // error handling
							$(".banner-grid-error").html("");
							$("#banner-grid").append('<tbody class="banner-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#banner-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $breadcum ?></li> 
</ul>
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                    <?php if ($this->session->flashdata('BannerSuccess')) { ?>  
                                    <div class="alert alert-success"> <?= $this->session->flashdata('BannerSuccess') ?></div>
                                <?php } ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Banner</h3>
                                       <a href="<?= base_url()?>admin/banner-add" class="btn btn-primary pull-right">Add New</a>  
                                    
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                       
											<table id="banner-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Banner Id</th>
							<th>Banner Title</th>
							<th>Banner Text</th>
							<th>Banner Image</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
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
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });   
    
     $('body').delegate('.changestatus', 'click', function(evt) {   
	  var hrefUrl = $(this).attr('data-href'); 
       var box = $("#mb-status-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
             window.location.href = hrefUrl;
        });
    });   
    
</script>
             
                        