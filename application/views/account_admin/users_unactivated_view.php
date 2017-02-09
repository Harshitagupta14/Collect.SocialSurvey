<?php $this->load->view($this->config->item('adminFolderName') . '/header'); ?> 
<ul class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('admin_login_url') . '/dashboard') ?>">Home</a></li>
    <li class="active">Admin: User Accounts Not Activated in 31 Days</li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">             
                <div class="panel-heading">
                    <h2>User Accounts Not Activated in 31 Days</h2>                     
                </div>
                <?php if (!empty($message)) { ?>
                    <div role="alert" class="alert alert-danger">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <form method="post">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>User Group</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>         
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo site_url($this->config->item('admin_login_url') . '/update-user/' . $user[$this->flexi_auth->db_column('user_acc', 'id')]) ?>">
                                                    <?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')]; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $user['upro_first_name']; ?></td>
                                            <td><?php echo $user['upro_last_name']; ?></td>
                                            <td><?php echo $user[$this->flexi_auth->db_column('user_group', 'name')]; ?></td>
                                            <td><?php echo ($user[$this->flexi_auth->db_column('user_acc', 'active')] == 1) ? 'Active' : 'Inactive'; ?></td>
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <input type="submit" name="delete_unactivated" value="Delete Listed Users" class="btn btn-danger"/>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>   
                    </div>  
                </div>                
            </div>                                                
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('adminFolderName') . '/footer'); ?> 