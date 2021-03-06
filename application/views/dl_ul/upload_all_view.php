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

<?php echo form_open_multipart(); ?>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select Batch File</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="batch_name" name="batch_name" required>
                <option value="" disabled selected>--- Select Batch ---</option>
                <?php
                if (!empty($downloads_list)) {
                    foreach ($downloads_list as $key) {
                ?>
                        <option value="<?php echo $key->batch_name; ?>"><?php echo $key->batch_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="file" class="form-control" name="upload_file" accept=".xls,.xlsx,.csv" required>
        </div>
        <div class="col-md-2" id="upload_btn">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="upload_reject">Upload CSV/EXCEL</button>
        </div>
    </div>
</form>