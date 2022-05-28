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
            <label style="padding-top: 10px;">Sub-Category Name</label>
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
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">Default Rate</label>
        </div>
        <div class="col-md-4">
            <input type="number" id="default_rate" name="default_rate" class="form-control form-control-line"  min="0.01" step="0.01" value="<?php echo $row->default_rate; ?>" required>
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Load Email</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="load_email" name="load_email" required>
                <option value="1" <?php if($row->load_email == 1) echo "selected" ;?>>Yes</option>
                <option value="0" <?php if($row->load_email == 0) echo "selected" ;?>>No</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">CSV Template Link</label>
        </div>
        <div class="col-md-4">
            <input type="text" id="template_link_csv" name="template_link_csv" class="form-control form-control-line" maxlength="250" value="<?php echo $row->template_link_csv; ?>">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">TXT Template Link</label>
        </div>
        <div class="col-md-4">
            <input type="text" id="template_link_txt" name="template_link_txt" class="form-control form-control-line" maxlength="250" value="<?php echo $row->template_link_txt; ?>">
        </div>
    </div>
    <br>

    <h5 class="page-title" style="text-decoration: underline;">Field List</h5>

    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-center" style="width: 25%;">Field Name</th>
                        <th class="text-center" style="width: 10%;">Field Length</th>
                        <th class="text-center" style="width: 20%;">Field Type</th>
                        <th class="text-center" style="width: 10%;">Required</th>
                        <th class="text-center" style="width: 10%;">Hidden</th>
                        <th class="text-center" style="width: 20%;">Field Source</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    if(!empty($field_info)) {
                        $count = 1;
                        foreach ($field_info as $f_row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                            <input type="hidden" id="field_id_<?php echo $count; ?>" name="field_id_<?php echo $count; ?>" value="<?php echo $f_row->Id; ?>">                            
                        </td>
                        <td>
                            <input type="text" id="field_name_<?php echo $count; ?>" name="field_name_<?php echo $count; ?>" class="form-control form-control-line" maxlength="120" required value="<?php echo $f_row->field_name; ?>">
                        </td>
                        <td>
                            <input type="number" id="field_length_<?php echo $count; ?>" name="field_length_<?php echo $count; ?>" class="form-control form-control-line" required value="<?php echo $f_row->field_length; ?>">
                        </td>
                        <td>
                            <select class="basic-single form-select shadow-none form-control-line" id="field_type_<?php echo $count; ?>" name="field_type_<?php echo $count; ?>" required>
                                <option value="" disabled selected>--Select Type--</option>
                                <option value="text" <?php if($f_row->field_type == 'text') echo "selected"; ?>>Text</option>
                                <option value="email" <?php if($f_row->field_type == 'email') echo "selected"; ?>>Email</option>
                                <option value="number" <?php if($f_row->field_type == 'number') echo "selected"; ?>>number</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input " id="field_required_<?php echo $count; ?>" name="field_required_<?php echo $count; ?>" value="required" <?php if($f_row->field_required == 'required') echo "checked"; ?>>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input " id="field_hidden_<?php echo $count; ?>" name="field_hidden_<?php echo $count; ?>" value="1" <?php if($f_row->field_hidden == '1') echo "checked"; ?>>
                        </td>
                        <td>
                            <select class="basic-single form-select shadow-none form-control-line" id="field_source_<?php echo $count; ?>" name="field_source_<?php echo $count; ?>">
                                <option value="null" selected>--Select Source--</option>
                                <option value="field_data_0" <?php if($f_row->field_source == 'field_data_0') echo "selected"; ?>>Field 1</option>
                                <option value="field_data_1" <?php if($f_row->field_source == 'field_data_1') echo "selected"; ?>>Field 2</option>
                                <option value="field_data_2" <?php if($f_row->field_source == 'field_data_2') echo "selected"; ?>>Field 3</option>
                            </select>
                        </td>
                    </tr>
                    <?php
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>














    <div class="row">
        <div class="col-md-12">&nbsp;<br><br></div></div>
        <div class="row"><div class="col-md-5"></div><div class="col-md-2">
            <input type="hidden" id="field_count" name="field_count" value="<?php echo $count-1; ?>">

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