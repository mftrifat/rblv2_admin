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
            <h4>Request Password Reset</h4>
            <?php echo form_open('resetpassword');?>
                <br>
                <input type="text" id="user_name" name="user_name" placeholder="Username" class="form-control margin-bottom-05" value="<?php echo set_value('user_name'); ?>" required>                
                <?php if($this->session->flashdata('msg_reset')){ echo $this->session->flashdata('msg_reset')."<br><br>";} else {echo "<br><br>";} ?>
                <button type="submit" class="btn btn-primary"><i class="fa fa-caret-square-o-right"></i> Submit</button>
                <br><br>
                <a class="btn btn-danger" href="<?php echo base_url();?>"><i class="fa fa-arrow-left"></i> Back To Sign In</a><p><br></p>
            </form>
        </div>
        <?php $this->load->view('login/login_footer_view'); ?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-4"></div>