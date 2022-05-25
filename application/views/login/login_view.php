<div class="col-md-4"></div>
<div class="col-md-4">
    <div class="col-md-1"></div>
    <div class="col-md-10 box">
        <h3>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png" style="width:180px; padding-top:15px;"></a>
            <br>
        </h3>
        <hr>
        <div class="form-group">
            <h4>Admin Login</h4>
            <?php echo form_open('login');?>
                <input type="text" id="user_name" name="user_name" placeholder="Username" autocomplete="on" class="form-control margin-bottom-05" value="<?php echo set_value('user_name'); ?>" required>
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="on" class="form-control margin-bottom-05" required><span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                <?php if(validation_errors()) {echo validation_errors();} else {echo "<br>";} ?>
                <button type="submit" class="btn btn-primary" name="log" value="Sign in"><i class="fa fa-sign-in"></i> Sign In</button>
                <br><br>
                <a class="btn btn-danger" href="<?php echo base_url();?>resetpassword">Forgot password?</a><p><br></p>
            </form>
        </div>
        <?php $this->load->view('login/login_footer_view'); ?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-4"></div>