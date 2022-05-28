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

<?php
if(!empty($user_info)) {
    foreach ($user_info as $row) {
?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Username</label>
        </div>
        <div class="col-md-5">
            <input type="text" id="user_name" name="user_name" class="form-control form-control-line" value="<?php echo $row->user_name; ?>" required readonly>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>            
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">User Type</label>
        </div>
        <div class="col-md-5">
            <input type="hidden" id="user_type_id" name="user_type_id" value="<?php echo $row->user_type_id;?>">
            <input type="text" id="user_type_text" name="user_type_text" class="form-control form-control-line" value="<?php echo $this->ModelCommon->single_result('tbl_user_type', 'user_type', 'user_type_id', $row->user_type_id);?>" required readonly>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">User Full Name</label>
        </div>
        <div class="col-md-5">
            <input type="text" id="full_name" name="full_name" class="form-control form-control-line" maxlength="120" required readonly value="<?php echo $row->full_name; ?>">
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>    
<?php 
    }
    if(!empty($custom_rates)) {
        $count = 1;
?>
    <h5 class="page-title" style="text-decoration: underline;">Rate List</h5>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-center" style="width: 20%;">Category</th>
                        <th class="text-center" style="width: 55%;">Sub-Category</th>
                        <th class="text-center" style="width: 10%;">Rate</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    foreach ($custom_rates as $f_row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>                            
                        </td>
                        <td>
                            <?php echo $this->ModelCommon->single_result('tbl_category', 'category_name', 'id', $f_row->main_category_id); ?>
                        </td>
                        <td>
                            <?php echo $this->ModelCommon->single_result('tbl_category', 'category_name', 'id', $f_row->sub_category_id); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $f_row->rate; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url(); ?>delete_rate?uid=<?php echo $row->user_id; ?>&id=<?php echo $f_row->id; ?>">
                                <i class="fa fa-times fa-2x" title="Delete" style="color:red;"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php 
    }
    echo form_open();
?>
        <br>
        <h5 class="page-title" style="text-decoration: underline;">Add New Rate</h5>
        <br>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 25%;">Category</th>
                            <th class="text-center" style="width: 53%;">Sub-Category</th>
                            <th class="text-center" style="width: 12%;">Rate</th>
                            <th class="text-center" style="width: 10%;">Add</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td>
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
                            </td>
                            <td>
                                <select class="basic-single form-select shadow-none form-control-line" id="sub_category_id" name="sub_category_id" required>
                                    <option value="null" disabled selected>--- Select Sub-Category ---</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" id="rate" name="rate" class="form-control form-control-line" value="0" min="0.01" step="0.01" value="0" required>
                            </td>
                            <td class="text-center">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $row->user_id;?>">
                                <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Add&nbsp;&nbsp;<span><i class="fa fa-save"></i></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
<?php 
}
?>