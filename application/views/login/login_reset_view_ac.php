<div class="col-md-4"></div>
<div class="col-md-4">
    <div class="col-md-1"></div>
    <div class="col-md-10 box">
        <h3>
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png" style="width:180px; padding-top:15px;"></a>
            <!-- <br><br>
            CIB Reporting System -->
            <br>
        </h3>
        <hr>
        <div class="form-group">
            <h4>Set New Password</h4>
            <?php 
            echo form_open();
            if($this->session->flashdata('msg_pass_reset')) 
            {
                echo "<br><br><br>".$this->session->flashdata('msg_pass_reset')."<br><br><br><br><br>";
            }
            else 
            {
            ?>
                <input type="hidden" id="user_name" name="user_name" placeholder="User Name" autocomplete="on" class="form-control margin-bottom-05" value="<?php echo $uname; ?>" required>
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="on" class="form-control margin-bottom-05" required><span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Retype Password" autocomplete="off" class="form-control margin-bottom-05" required><span toggle="#confirm_password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                <div id="msg"></div>
                <?php if(validation_errors()) {echo validation_errors();} else {echo "<br>";} ?>
                <button type="submit" class="btn btn-primary" name="log" value="Sign in"><i class="fa fa-sign-in"></i> Set Password</button>
                <br><br>
            <?php
            }
            ?>
                <a class="btn btn-danger" href="<?php echo base_url();?>"><i class="fa fa-arrow-left"></i> Back To Login</a><p><br></p>
            </form>            
        </div>
        <?php $this->load->view('login/login_footer_view'); ?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-4"></div>