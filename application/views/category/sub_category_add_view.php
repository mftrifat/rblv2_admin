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

<?php echo form_open(); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select Category</label>
        </div>
        <div class="col-md-5">
            <select class="basic-single form-select shadow-none form-control-line" id="main_category_id" name="main_category_id" required>
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
        <div class="col-md-3">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Sub-Category Name</label>
        </div>
        <div class="col-md-5">
            <input type="text" id="sub_category_name" name="sub_category_name" class="form-control form-control-line" maxlength="80" required>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <label style="padding-top: 10px;">CSV Template Link</label>
        </div>
        <div class="col-md-4">
            <input type="text" id="template_link_csv" name="template_link_csv" class="form-control form-control-line" maxlength="250">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">TXT Template Link</label>
        </div>
        <div class="col-md-4">
            <input type="text" id="template_link_txt" name="template_link_txt" class="form-control form-control-line" maxlength="250">
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
                        <th class="text-center">Field Name</th>
                        <th class="text-center">Field Length</th>
                        <th class="text-center">Field Type</th>
                        <th class="text-center">Field Required</th>
                        <th class="text-center">Field Hidden</th>
                        <th class="text-center">Remove Field</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td>
                            <input type="text" id="field_name_1" name="field_name_1" class="form-control form-control-line" maxlength="120" required>
                        </td>
                        <td>
                            <input type="number" id="field_length_1" name="field_length_1" class="form-control form-control-line" required value="250">
                        </td>
                        <td>
                            <select class="basic-single form-select shadow-none form-control-line" id="field_type_1" name="field_type_1" required>
                                <option value="" disabled selected>--Select Type--</option>
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="number">number</option>
                            </select>
                        </td>
                        <td>
                            <input type="checkbox" class="form-check-input " id="field_required_1" name="field_required_1" value="required">
                        </td>
                        <td>
                            <input type="checkbox" class="form-check-input " id="field_hidden_1" name="field_hidden_1" value="1">
                        </td>
                        <td>
                            <button class="btn btn-danger remove" type="button" disabled>Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <button class="btn btn-md btn-primary" id="addBtn" type="button">
        <i class="mdi mdi-shape-square-plus"></i>&nbsp;
        Add Another Field
    </button>
    <br>
    <div class="row">
        <div class="col-md-12">&nbsp;<br></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">
            <input type="hidden" id="field_count" name="field_count" value="1">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="add_sub_category">Create New Sub-Category&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
    </div>



    <div class="row" id="input_form" hidden>
    </div>
</form>