<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open(); ?>
    <div class="row">
        <div class="col-md-1">
            <label style="padding-top: 10px;">Category</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="category_id" name="category_id" required>
                <option value="null" disabled selected>--- Select Category ---</option>
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
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="sub_category_id" name="sub_category_id" required>
                <option value="" disabled selected>--- Select Sub-Category ---</option>
            </select>
        </div>
        <div class="col-md-2" id="size_field" hidden>
            <select class="basic-single form-select shadow-none form-control-line" id="download_size" name="download_size" required>
                <option value="" disabled selected>- Select Size -</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="250">150</option>
                <option value="-1">All</option>
            </select>
        </div>
        <div class="col-md-1" id="search_btn">
        </div>
    </div>
</form>

<?php if(!empty($download_accounts)){ ?>
<br>
<h5 class="page-title"><?php echo $this->ModelCommon->single_result('tbl_category','category_name','id',$selected_category_id)." > ".$this->ModelCommon->single_result('tbl_category','category_name','id',$selected_sub_category_id)." (".$selected_size.")"; ?></h5>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Identifier</th>
                    <?php
                        if (!empty($field_info)) {
                            $visible_field = array();
                            foreach ($field_info as $row) {
                                array_push($visible_field,$row->seq);
                                echo "<th scope=\"col\">".$row->field_name."</th>";
                            }
                        }
                    ?>
                    <th scope="col">Input User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($download_accounts)) {
                        $count = 1;
                        foreach ($download_accounts as $row) {
                            $this->ModelDownload->mark_download($row->Id, $this->session->userdata('user_id'));
                            echo "<tr>";
                            echo "<td scope=\"col\">".$count."</td>";
                            echo "<td scope=\"col\">".$row->Id."</td>";
                            foreach ($row as $key => $val) {
                                if(strpos($key, "a_data_") !== false){
                                    if(in_array(substr($key, -1), $visible_field)) {
                                        echo "<td scope=\"col\">".$this->encryption->decrypt($val)."</td>";
                                    }
                                }
                            }
                            echo "<td scope=\"col\">".$row->full_name."</td>";                            
                            echo "</tr>";
                            $count++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php } else if(!empty($selected_sub_category_id)) {
    echo "<br><br><br><h4 class=\"page-title text-center\">No Account Available in this Category!</h4>";
} ?>