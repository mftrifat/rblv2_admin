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
                <label style="padding-top: 10px;">Category Name</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="category_name" name="category_name" class="form-control form-control-line" maxlength="80" required>
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
                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Create New Category&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
            </div>
        </div>
    </form>
</div>