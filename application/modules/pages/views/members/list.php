<div class="container" style="margin-top: 140px;">
    <h4>Hello, <?php echo $this->session->userdata('name'); ?></h4>
    <hr/>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="pull-left">Members List</h1>
        <span class="pull-right">
            <a href="<?php echo site_url('members/add'); ?>" class="button">Add</a>
        </span>
    </div>
    <div style="overflow-x:auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)) : ?>
                    <?php foreach ($members as $ctr => $member) : ?>
                        <tr>
                            <td><?php echo $ctr + 1; ?></td>
                            <td><?php echo htmlspecialchars($member['name']); ?></td>
                            <td><?php echo htmlspecialchars($member['email']); ?></td>
                            <td><?php echo htmlspecialchars($member['phone']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($member['role'])); ?></td>
                            <td>
                                <center>
                                    <a href="<?php echo site_url('members/' . $member['id']); ?>" class="btn btn-bordered">EDIT</a>
                                    <a href="<?php echo site_url('members/' . $member['id'].'/delete'); ?>" class="btn btn-bordered" onclick="return confirm('Are you sure you want to delete this member?');">DELETE</a>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>