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
<?php $attrib_form = array('id' => 'profileform'); ?>
<?php echo form_open('', $attrib_form); ?>
<?php foreach ($profile_data as $row) { ?>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Full Name: </label>
        </div>
        <div class="col-md-10">
            <input type="text" id="full_name" name="full_name" placeholder="Full Name" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->full_name ?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Email: </label>
        </div>
        <div class="col-md-4">
            <input type="email" id="user_email" name="user_email" placeholder="User Email" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->user_email ?>">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Phone: </label>
        </div>
        <div class="col-md-4">
            <input type="tel" id="phone" name="phone" placeholder="01XXXXXXXXX" pattern="[0-9]{11}" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->phone ?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">skype: </label>
        </div>
        <div class="col-md-4">
            <input type="text" id="skype" name="skype" placeholder="User Skype" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->skype ?>">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Facebook Link: </label>
        </div>
        <div class="col-md-4">
            <input type="text" id="fblink" name="fblink" placeholder="User FB Link" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->fblink ?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">National ID: </label>
        </div>
        <div class="col-md-4">
            <input type="number" id="nid" name="nid" placeholder="User NID" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->nid ?>" min="0" max="99999999999999999" >
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Date of Birth: </label>
        </div>
        <div class="col-md-4">
            <input type="date" id="dob" name="dob" placeholder="DD-MM-YYYY" autocomplete="off" class="form-control margin-bottom-05" required value="<?php echo $row->dob ?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="change" disabled>Save Changes &nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
</form>
<?php } ?>