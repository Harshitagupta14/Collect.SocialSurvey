<ul class="breadcrumb">
    <li><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
     <li class="active"><?php echo $breadcum ?></li> 
</ul> 
<div class="page-content-wrap">                
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Manage Admin Log</h3>
                                    <ul class="panel-controls">
                                        <li><a href="javascript:" data-href="<?= base_url() ?>admin/adminlog-delete" class="clearLog"><span class="fa fa-trash-o" title="Clear Log"></span></a></li>
                                    </ul>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Admin User Name</th>
                                                    <th>Login Time</th>                                       
                                                    <th>Login IP</th>
                                                    <th>Browser</th>                                 
                                                    <th>Operating System</th>  
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                   <?php
                                                    if (!empty($log_data)) {
                                                        foreach ($log_data as $log) {
                                                            ?>
                                                <tr>
                                                    <td><?php echo (isset($log['admin_username'])) ? $log['admin_username'] : '-'; ?></td>
                                                    <td><?php echo (isset($log['login_time'])) ? date('m/d/Y h:i:s A', $log['login_time']) : '-'; ?></td>
                                                    <td><?php echo (isset($log['login_ip'])) ? $log['login_ip'] : '-'; ?></td>                                   
                                                    <td><?php echo (isset($log['browser'])) ? $log['browser'] : '-'; ?></td>                                   
                                                    <td><?php echo (isset($log['operating_system'])) ? $log['operating_system'] : '-'; ?></td>  
                                                </tr>    
                                                    <?php }} else {?>
                                                
                                                  <tr><td colspan="5" style="color: black; padding-top: 10%; padding-bottom: 10%; text-align: center;"><h2>No Record Found</h2></td></tr>
                                                    <?php }?>
                                            </tbody>
                                        </table>
                                    </div>                                

                                </div>
                            </div> 
                        </div>
            </div>
</div>
<script>
   $('body').delegate('.clearLog', 'click', function(evt) {
        var hrefUrl = $(this).attr('data-href');
       var box = $("#mb-clear-row");
        box.addClass("open");
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            window.location.href = hrefUrl;
        });
    });   

</script>

                        