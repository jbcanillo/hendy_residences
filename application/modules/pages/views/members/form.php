<div class="container" style="margin-top: 140px;">
    <a href="<?php echo site_url('members'); ?>" class="btn btn-secondary" style="margin-bottom: 30px;font-size:20px">Back</a>
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
    <h1><?php echo isset($member) ? 'Edit Member' : 'Add Member'; ?></h1>
    <?php echo form_open(isset($member) ? 'members/' . $member['id'] : 'members/add'); ?>
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($member) ? htmlspecialchars($member['name']) : set_value('name'); ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($member) ? htmlspecialchars($member['email']) : set_value('email'); ?>" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" value="<?php echo isset($member) ? htmlspecialchars($member['phone']) : set_value('phone'); ?>">
        </div>
        <div>
            <?php if(isset($member)): ?>
                <label for="password">Change Password (Leave blank to keep the old password):</label>
            <?php else: ?>
                <label for="password">Password:</label>
            <?php endif; ?>
            <input type="password" id="password" name="password" <?php echo isset($member) ? '' : 'required'; ?>>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" <?php echo isset($member) ? '' : 'required'; ?>>
        </div>
        <div>
            <button type="submit"><?php echo isset($member) ? 'Update Member' : 'Add Member'; ?></button>
        </div>
    <?php form_close(); ?>
</div>