<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
if(!empty($category_info)) {
    echo form_open();
    foreach ($category_info as $row) {
?>
    <input type="hidden" name="category_id" value="<?php echo $row->id; ?>">    
    <br>
    <div class="row" id="input_form">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Category Name</label>
        </div>
        <div class="col-md-4">
            <input type="text" id="category_name" name="category_name" class="form-control form-control-line" maxlength="80" value="<?php echo $row->category_name; ?>" required>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <br>
    <div class="row" id="input_form">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Status</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="status" name="status" required>
                <option value="1" <?php if($row->status == 1) echo "selected"; ?>>Active</option>
                <option value="0" <?php if($row->status == 0) echo "selected"; ?>>Not Active</option>
            </select>
        </div>
        <div class="col-md-4">
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">&nbsp;<br><br></div></div>
        <div class="row"><div class="col-md-5"></div><div class="col-md-2">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Submit&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
    </div>
<?php 
    }
?>
</form>
<?php 
}
?>