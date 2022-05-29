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

<?php if(!empty($user_list)) { ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">User Full Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit Profile</th>
                    <th scope="col">Edit Rates</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($user_list)) {
                        $count = 1;
                        foreach ($user_list as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";
                            echo "<td scope=\"col\">".$row->full_name."</td>";
                            echo "<td scope=\"col\">".$row->user_name."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$this->ModelCommon->single_result('tbl_user_type','user_type','user_type_id',$row->user_type_id)."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->signup_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">";
                            if($row->account_status == 1){
                                echo "Active";
                            } else if($row->account_status == -1){
                                echo "Locked";
                            } else {
                                echo "Not Active";
                            }
                            echo "</td>";
                            echo "<td class=\"text-center\">
                                    <a href=\"".base_url()."edit_user?id=".$row->user_id."\">
                                        <i class=\"fa fa-edit fa-2x\" title=\"Edit\" style=\"color:grey;\"></i>
                                    </a>
                                </td>";
                            echo "<td class=\"text-center\">
                                    <a href=\"".base_url()."edit_user_rate?id=".$row->user_id."\">
                                        <i class=\"fa fa-dollar fa-2x\" title=\"Edit\" style=\"color:grey;\"></i>
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
<?php } ?>