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
<?php $attrib_form = array('id' => 'profilepicform'); ?>
<?php echo form_open_multipart('', $attrib_form); ?>
<?php foreach ($profile_data as $row) { ?>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Profile Photo: </label>
        </div>
        <div class="col-md-4">
            <input type="file" class="form-control" name="photo" size="20" />
        </div>
        <div class="col-md-2">
            <!-- <label style="padding-top: 10px;">Current Profile Photo: </label>             -->
        </div>
        <div class="col-md-4">
            <img src="<?php echo base_url().$this->session->userdata('photo');?>" alt="user" width="80%">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="upload" disabled>Save Changes &nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
        <div class="col-md-4">            
        </div>
    </div>
    <br>
</form>
<?php } ?>