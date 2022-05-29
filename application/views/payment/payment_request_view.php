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

<h5 class="page-title">Avaiable Balance: <?php echo $balance; ?> Taka</h5>
<br>
<?php 
if($payment_pending == 0) { 
    echo form_open(); 
?>
        <div class="row">
            <input type="hidden" id="payment_charge" name="payment_charge" value="<?php echo $payment_charge; ?>">
            <div class="col-md-2">
                <label style="padding-top: 10px;">Enter Amount</label>
            </div>
            <div class="col-md-2">
                <input type="number" id="request_amount" name="request_amount" autocomplete="off" class="form-control margin-bottom-05 text-center" min="10" max="<?php echo $balance; ?>" value="10" step="1" required>
            </div>
            <div class="col-md-1">
                <label style="padding-top: 10px;">Charge</label>
            </div>
            <div class="col-md-1">
                <input type="text" id="charge_amount" name="charge_amount" class="form-control margin-bottom-05 text-center" value="1" required readonly>
            </div>
            <div class="col-md-2 text-right">
                <label style="padding-top: 10px;">You Will Get</label>
            </div>
            <div class="col-md-2">
                <input type="text" id="payment_amount" name="payment_amount" class="form-control margin-bottom-05 text-center" style="background-color: red;color: white;" value="1" required readonly>
            </div>
            <div class="col-md-2 text-center">
                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="request">Request</button>
            </div>
        </div>
    </form>
<?php 
} else if ($post_act == 0) { 
?>
<h4 style="color: red">
    <div class="alert alert-warning show">
        <strong>Sorry!</strong> <font color="red"> You have pending request. Please try later. </font>
    </div>
</h4>
<?php
} 
?>