<div class="container" style="margin-top: 140px;">
    <div class="col-xs-60 col-sm-33 article__image__wrapper">
        <figure class="image-center" style="margin-right:20px;margin-bottom:5px;background-image: url('<?php echo base_url('assets/media/landing/landing-img3.jpg'); ?>');">
        </figure>
    </div>
    <div class="col-xs-60 col-sm-25">
        <div class="card">
            <div class="card-header">
                <h2 class="page-title">Create an Account</h2>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open('register'); ?>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name*" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone*" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password*" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn button btn-block">Register</button>
                </div>
                <?php form_close(); ?>
            </div>
            <div class="card-footer text-center">
                <small>Already have an account? <a href="<?php echo base_url('log-in'); ?>">Log in here</a></small>
            </div>
        </div>
    </div>
</div>