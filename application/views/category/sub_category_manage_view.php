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
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="search">Search</button>
        </div>
    </div>
</form>



<?php 
if(!empty($sub_category_list)) {
?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Sub-Category Name</th>
                    <th scope="col">Default Rate</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($sub_category_list)) {
                        $count = 1;
                        foreach ($sub_category_list as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";
                            echo "<td scope=\"col\">".$row->category_name."</td>";
                            echo "<td scope=\"col\">".$row->default_rate."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$this->ModelCommon->single_result('tbl_users','full_name','user_id',$row->id_user_create)."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->date_create."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">";
                            if($row->status == 1){
                                echo "Active";
                            } else {
                                echo "Not Active";
                            }
                            echo "</td>";
                            echo "<td class=\"text-center\">
                                    <a href=\"".base_url()."edit_sub_category?id=".$row->id."\">
                                        <i class=\"fa fa-edit fa-2x\" title=\"Release\" style=\"color:grey;\"></i>
                                    </a>
                                </td>";
                            echo "</tr>";
                            $count++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
}
?>