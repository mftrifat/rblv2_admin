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

<?php if(!empty($pending_payment)){ ?>
<div>
<?php 
    echo form_open();
    foreach ($pending_payment as $row) {
?>
        <input type="hidden" id="payment_id" name="payment_id" value="<?php echo $row->id; ?>">
        <input type="hidden" id="pay_user_id" name="pay_user_id" value="<?php echo $row->user_id; ?>">
        <input type="hidden" id="commision_user_id" name="commision_user_id" value="<?php echo $row->commision_user_id; ?>">
        <div class="row">
            <div class="col-md-2">
                <label style="padding-top: 10px;">User Name</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="user_name" name="user_name" class="form-control form-control-line" value="<?php echo $this->ModelCommon->single_result('tbl_users','full_name','user_id',$row->user_id); ?>" readonly>
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">User Type</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="user_type" name="user_type" class="form-control form-control-line" value="<?php echo $this->ModelCommon->single_result('tbl_user_type','user_type','user_type_id', substr($row->user_id,0,1)); ?>" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
                <label style="padding-top: 10px;">Requested Amount</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="request_amount" name="request_amount" class="form-control form-control-line" value="<?php echo $row->request_amount; ?>" readonly>
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">Charge Amount</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="charge_amount" name="charge_amount" class="form-control form-control-line" value="<?php echo $row->charge_amount; ?>" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">Total Payment</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="payment_amount" name="payment_amount" class="form-control form-control-line text-center" value="<?php echo $row->payment_amount; ?>" style="background: red;color: white;" readonly>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row" id="admin_info" >
            <div class="col-md-2">
                <label style="padding-top: 10px;">Admin Name</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="commision_user" name="commision_user" class="form-control form-control-line text-center" value="<?php echo $this->ModelCommon->single_result('tbl_users','full_name','user_id',$row->commision_user_id); ?>" readonly>
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">Admin Commission</label>
            </div>
            <div class="col-md-4">
                <input type="number" id="commision_amount" name="commision_amount" class="form-control margin-bottom-05 text-center" min="0" max="<?php echo $row->charge_amount; ?>" value="<?php echo $row->charge_amount; ?>" step="1" required>
            </div>
        </div>
        <br>
        <div class="row" id="admin_info" >
            <div class="col-md-2">
                <label style="padding-top: 10px;">Remarks</label>
            </div>
            <div class="col-md-10">
                <input type="text" id="payment_remarks" name="payment_remarks" class="form-control form-control-line" maxlength="50" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">&nbsp;<br></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <?php if(validation_errors()) echo validation_errors(); ?>
            <div class="col-md-3 text-center">
                <button class="btn btn-danger text-white mb-2" id="submit" name="submit" value="rejecet">Reject Payment&nbsp;&nbsp;<span><i class="fa fa-times"></i></span></button>
            </div>
            <div class="col-md-3 text-center">                
                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="approve">Approve Payment&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
</div>
<?php
    }
}
?>