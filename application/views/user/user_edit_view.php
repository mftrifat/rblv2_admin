<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
if(!empty($user_info)) {
    echo form_open();
    foreach ($user_info as $row) {
?>
    <div class="row">
        <div div class="col-md-9">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">Username</label>
                </div>
                <div class="col-md-5">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $row->user_id;?>">
                    <input type="text" id="user_name" name="user_name" class="form-control form-control-line" value="<?php echo $row->user_name; ?>" required readonly>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>            
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">User Type</label>
                </div>
                <div class="col-md-5">
                    <input type="hidden" id="user_type_id" name="user_type_id" value="<?php echo $row->user_type_id;?>">
                    <input type="text" id="user_type_text" name="user_type_text" class="form-control form-control-line" value="<?php echo $this->ModelCommon->single_result('tbl_user_type', 'user_type', 'user_type_id', $row->user_type_id);?>" required readonly>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <?php if($row->parent_user_id != 0) { ?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">Admin Name</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control form-control-line" value="<?php echo $this->ModelCommon->single_result('tbl_users', 'full_name', 'user_id', $row->parent_user_id);?>" readonly>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <?php } ?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">User Full Name</label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="full_name" name="full_name" class="form-control form-control-line" maxlength="120" required value="<?php echo $row->full_name; ?>">
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">User Email</label>
                </div>
                <div class="col-md-5">
                    <input type="email" id="user_email" name="user_email" class="form-control form-control-line" maxlength="120" required value="<?php echo $row->user_email; ?>">
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">User Phone</label>
                </div>
                <div class="col-md-5">
                    <input type="tel" id="phone" name="phone" placeholder="01XXXXXXXXX" pattern="[0-9]{11}" class="form-control form-control-line" required value="<?php echo $row->phone ?>">
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">Payment Charge</label>
                </div>
                <div class="col-md-4">
                    <input type="number" id="payment_charge" name="payment_charge" class="form-control form-control-line" min="0" required value="<?php echo $row->payment_charge ?>">
                </div>
                <div class="col-md-4"><label style="padding-top: 5px;">%</label></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <label style="padding-top: 10px;">User Status</label>
                </div>
                <div class="col-md-5">
                    <?php
                    if($row->account_status == -1) { 
                        echo "<input type=\"hidden\" id=\"account_status\" name=\"account_status\" value=\"-1\">";
                        echo "<input type=\"text\" id=\"account_status_text\" name=\"account_status_text\" class=\"form-control form-control-line\" value=\"Locked (Too many wrong password)\" required readonly>";
                    } else {
                        $selected_active = "";
                        $selected_inactive = "";
                        if($row->account_status == 1) $selected_active = "selected";
                        if($row->account_status == 0) $selected_inactive = "selected";
                        echo "<select class=\"basic-single form-select shadow-none form-control-line\" id=\"account_status\" name=\"account_status\" required>";
                        echo "<option value=\"1\" ".$selected_active.">Active</option>";
                        echo "<option value=\"0\" ".$selected_inactive.">Inactive</option>";
                        echo "</select>";
                    }
                    ?>
                </div>
                <div class="col-md-3">
                    <?php
                    if($row->account_status == -1) { 
                        echo "<a class=\"btn btn-success text-white mb-2\" href=\"".base_url()."unlock_user?id=".$row->user_id."\" >Unlock Account&nbsp;&nbsp;<span><i class=\"fa fa-unlock\"></i></span></a>"; 
                    }
                    ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">&nbsp;<br></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-5 text-center">
                    <?php if(validation_errors()) echo validation_errors(); ?>
                    <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Save Changes&nbsp;&nbsp;<span><i class="fa fa-save"></i></span></button>
                </div>
            </div>
        </div>
        <div div class="col-md-3">
            <?php
                if(!empty($row->photo)){$pro_pic = $row->photo;}else {$pro_pic = "assets/img/user1.jpg";}
            ?>
            <img src="<?php echo base_url().$pro_pic;?>" alt="user" width="100%">
        </div>
    </div>
<?php 
    }
?>
</form>
<?php 
}
?>