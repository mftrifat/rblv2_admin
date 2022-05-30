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

<?php if(!empty($downloads_list)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Batch Name</th>
                    <th scope="col">Batch Category</th>
                    <!-- <th scope="col">Batch Sub-Category</th> -->
                    <th scope="col">Batch Size</th>
                    <th scope="col">Rejected Account</th>
                    <th scope="col">Download By</th>
                    <th scope="col">Download Date</th>
                    <th scope="col">Status</th>
                    <!-- <th scope="col">Download Again</th> -->
                    <th scope="col">Reset Rejected</th>
                    <th scope="col">Mark Complete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($downloads_list)) {
                        $count = 1;
                        foreach ($downloads_list as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\">".$count."</td>";
                            echo "<td scope=\"col\">".$row->batch_name."</td>";
                            echo "<td scope=\"col\">".$this->ModelCommon->single_result('tbl_category','category_name','id', $row->batch_category)."</td>";
                            // echo "<td scope=\"col\">".$this->ModelCommon->single_result('tbl_category','category_name','id', $row->batch_sub_category)."</td>";
                            echo "<td scope=\"col\">".$row->batch_size."</td>";
                            echo "<td scope=\"col\">".$row->total_rejected."</td>";
                            echo "<td scope=\"col\">".$this->ModelCommon->single_result('tbl_users','full_name','user_id', $row->id_user_download)."</td>";
                            echo "<td scope=\"col\">".$row->date_download."</td>";
                            echo "<td scope=\"col\">";
                            if($row->batch_status == 1) {
                                echo "Downloaded";
                            } else if ($row->batch_status == 2) {
                                echo "Complete";
                            }
                            echo "</td>";
                            // echo "<td scope=\"col\">Download Again</td>";
                            if($row->batch_status == 1) {
                                echo "<td class=\"text-center\">
                                        <a href=\"".base_url()."reset_reject?id=".$row->batch_name."\" onclick=\"return confirm('Do you really want to reset rejected status?');\">
                                            <i class=\"fa fa-refresh fa-2x\" title=\"Complete\" style=\"color:grey;\"></i>
                                        </a>
                                    </td>";
                            } else if ($row->batch_status == 2) {
                                echo "<td class=\"text-center\"></td>";
                            }
                            if($row->batch_status == 1) {
                                echo "<td class=\"text-center\">
                                        <a href=\"".base_url()."download_mark_complete?id=".$row->batch_name."\" onclick=\"return confirm('Do you really want to mark complete?');\">
                                            <i class=\"fa fa-check fa-2x\" title=\"Complete\" style=\"color:grey;\"></i>
                                        </a>
                                    </td>";
                            } else if ($row->batch_status == 2) {
                                echo "<td class=\"text-center\"></td>";
                            }
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