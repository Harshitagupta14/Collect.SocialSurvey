<?php $this->load->view($this->config->item('adminFolderName') . '/header'); ?> 
<ul class="breadcrumb">
    <li><a href="<?= site_url($this->config->item('admin_login_url') . '/dashboard') ?>">Home</a></li>
    <li class="active">User Accounts</li> 
</ul>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">             
                <div class="panel-heading">
                    <h3 class="panel-title">User Accounts</h3>                             
                     <div class="pull-right">
                        <a href="<?= site_url($this->config->item('admin_login_url') . '/create-user') ?>"  class="btn btn-primary btn-lg">Insert New User</a>
                    </div>
                </div>
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

<!--                <form method="post">
                    <div class="form-group pull-right">
                                            <div class="col-md-6">
                                                <label class="control-label">Search Users</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-addon"> <input type="submit" name="search_users" value="Search" class="btn btn-primary"/></span>
                                                   <input type="text" name="search_query" value="<?php echo set_value('search_users', $search_query); ?>" class="form-control"/>
                                                </div>                 
                                            </div>
                                        </div>
                   
                </form>-->
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
                                        <th>Account Suspended</th>
                                        <th>Delete</th>
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
                                                <td>
                                                    <?php echo $user['upro_first_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['upro_last_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $user[$this->flexi_auth->db_column('user_group', 'name')]; ?>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="current_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="<?php echo $user[$this->flexi_auth->db_column('user_acc', 'suspend')]; ?>"/>
                                                    <input type="hidden" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="0"/>
                                                    <?php if ($this->flexi_auth->is_privileged('Update Users') && $user[$this->flexi_auth->db_column('user_acc', 'id')]!='1') { ?>
                                                        <input type="checkbox" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="1" <?php echo ($user[$this->flexi_auth->db_column('user_acc', 'suspend')] == 1) ? 'checked="checked"' : ""; ?>/>
                                                    <?php } else { ?>
                                                        <input type="checkbox" disabled="disabled"/>
                                                        <small>Not Privileged</small>
                                                        <input type="hidden" name="suspend_status[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="0"/>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($this->flexi_auth->is_privileged('Delete Users') && $user[$this->flexi_auth->db_column('user_acc', 'id')]!='1') { ?>
                                                        <input type="checkbox" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="1"/>
                                                    <?php } else { ?>
                                                        <input type="checkbox" disabled="disabled"/>
                                                        <small>Not Privileged</small>
                                                        <input type="hidden" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="0"/>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <?php $disable = (!$this->flexi_auth->is_privileged('Update Users') && !$this->flexi_auth->is_privileged('Delete Users')) ? 'disabled="disabled"' : NULL; ?>
                                                <input type="submit" name="update_users" value="Update / Delete Users" class="btn btn-danger" <?php echo $disable; ?>/>
                                            </td>
                                        </tr>
                                    </tfoot>                
                                <?php } ?>
                            </table>
                        </form>
                    </div>  
                </div>                
            </div>                                                
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('adminFolderName') . '/footer'); ?> 