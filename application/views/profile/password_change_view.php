<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h4 style="color: red"> 
<?php
    $msg = $this->session->userdata('msg');
    $cls = $this->session->userdata('cls');
    if ($msg) {
?>
        <div class="alert alert-warning alert-dismissible fade show">
            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a> -->
            <strong><?php if(!empty($cls)) echo $cls; else echo "Error!!!"?></strong> <font color="red"> <?php echo $msg; ?></font>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php
        $this->session->unset_userdata('msg');
        $this->session->unset_userdata('cls');
    }
?>
</h4>

<?php echo form_open(); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Old Password</label>
        </div>
        <div class="col-md-4">
            <input type="password" id="old_pass" name="old_pass" placeholder="Type Old Password" autocomplete="on" class="form-control margin-bottom-05" required><span toggle="#old_pass   " class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">New Password</label>
        </div>
        <div class="col-md-4">
            <input type="password" id="new_pass" name="new_pass" placeholder="Type New Password" autocomplete="on" class="form-control margin-bottom-05" required><span toggle="#new_pass" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>            
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Retype New Password</label>
        </div>
        <div class="col-md-4">
            <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Retype New Password" autocomplete="off" class="form-control margin-bottom-05" required><span toggle="#confirm_pass" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>           
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div id="msg"></div>
            <?php echo validation_errors(); ?>
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="change">Change Password&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
</form>




