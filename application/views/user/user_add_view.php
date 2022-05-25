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
<div>
    <?php echo form_open(); ?>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">User Type</label>
            </div>
            <div class="col-md-4">
                <select class="basic-single form-select shadow-none form-control-line" id="user_type_id" name="user_type_id" required>
                    <option value="" disabled selected>--- Select User Type ---</option>
                    <?php
                    if (!empty($user_type)) {
                        foreach ($user_type as $key) {
                            ?>
                            <option value="<?php echo $key->id."_".$key->user_type; ?>"><?php echo $key->user_type; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">New User Full Name</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="new_full_name" name="new_full_name" class="form-control form-control-line" maxlength="120" required value="<?php if($this->input->post('new_full_name')) echo $this->input->post('new_full_name'); ?>">
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                <label style="padding-top: 10px;">New Username</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="new_user_name" name="new_user_name" class="form-control form-control-line" maxlength="64" required value="<?php if($this->input->post('new_user_name')) echo $this->input->post('new_user_name'); ?>">
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">&nbsp;<br></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <?php if(validation_errors()) echo validation_errors(); ?>
                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Create New Category&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
            </div>
        </div>
    </form>
</div>