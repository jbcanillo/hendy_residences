<div class="container" style="margin-top: 140px;">
    <div class="col-xs-60 col-sm-33 article__image__wrapper">
        <figure class="image-center" style="margin-right:20px;margin-bottom:5px;background-image: url('<?php echo base_url('assets/media/landing/landing-img2.jpg'); ?>');">
        </figure>
    </div>
    <div class="col-xs-60 col-sm-25">
        <div class="card">
            <div class="card-header">
                <h2 class="page-title">Welcome</h2>
            </div>
            <div class="card-body">
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
                <?php echo form_open('log-in'); ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn button btn-block">Log-in</button>
                    </div>
                <?php form_close(); ?>
            </div>
            <div class="card-footer text-center">
                <small>Don't have an account? <a href="<?php echo base_url('register'); ?>">Register here</a></small>
            </div>
        </div>
    </div>
</div>