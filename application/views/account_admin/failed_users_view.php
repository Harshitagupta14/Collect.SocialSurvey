<?php $this->load->view($this->config->item('adminFolderName') . '/header'); ?> 
<ul class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('admin_login_url') . '/dashboard') ?>">Home</a></li>
    <li class="active"><?php echo $page_title;?></li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">             
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_title; ?></h3>     
                </div>
                <?php if (!empty($message)) { ?>
                    <div id="message">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Group</th>
                                    <?php if (isset($status) && $status == 'failed_login_users') { ?>
                                        <th>Failed Attempts</th>
                                    <?php } ?>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <?php if (!empty($users)) { ?>
                                <tbody>         
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url($this->config->item('admin_login_url') . '/update-user/' . $user[$this->flexi_auth->db_column('user_acc', 'id')]) ?>">
                                                    <?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')]; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $user['upro_first_name']; ?></td>
                                            <td><?php echo $user['upro_last_name']; ?></td>
                                            <td><?php echo $user[$this->flexi_auth->db_column('user_group', 'name')]; ?></td>
                                            <?php if (isset($status) && $status == 'failed_login_users') { ?>
                                                <td><?php echo $user[$this->flexi_auth->db_column('user_acc', 'failed_logins')]; ?></td>
                                            <?php } ?>
                                            <td><?php echo ($user[$this->flexi_auth->db_column('user_acc', 'active')] == 1) ? 'Active' : 'Inactive'; ?></td>
                                        </tr>
                                    <?php } ?>   
                                </tbody>
                            <?php } else { ?>
                                <tbody>
                                    <tr>
                                        <td colspan="<?php echo (isset($status) && $status == 'failed_login_users') ? '6' : '5'; ?>" class="highlight_red">
                                            No users are available.
                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>  
                </div>                
            </div>                                                
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('adminFolderName') . '/footer'); ?> 