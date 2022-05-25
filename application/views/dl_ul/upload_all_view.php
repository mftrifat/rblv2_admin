<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open_multipart(); ?>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select Category</label>
        </div>
        <div class="col-md-5">
            <select class="basic-single form-select shadow-none form-control-line" id="category_id" name="category_id" required>
                <option value="" disabled selected>--- Select Category ---</option>
                <?php
                if (!empty($category_list)) {
                    foreach ($category_list as $key) {
                ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-5">
            <select class="basic-single form-select shadow-none form-control-line" id="sub_category_id" name="sub_category_id" required>
                <option value="" disabled selected>--- Select Sub-Category ---</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select Options</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="option_select" name="option_select" required>
                <!-- <option value="" disabled selected>- Select Options -</option> -->
                <!-- <option value="email">Fresh Email Account</option> -->
                <option value="check" selected>Checked Accounts</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="file" class="form-control" name="upload_file" required>
        </div>
        <div class="col-md-2" id="search_btn">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="upload">Upload CSV/EXCEL</button>
        </div>
    </div>
</form>

<?php 
if(!empty($upload_accounts)){ 
    foreach ($upload_accounts as $row) {
        foreach ($row as $key => $value) {
            echo $key.": ".$value."<br>";
        }        
    }










}
?>