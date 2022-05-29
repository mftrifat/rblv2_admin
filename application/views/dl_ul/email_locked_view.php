<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $msg = $this->session->userdata('msg');
    $cls = $this->session->userdata('cls');
    if ($msg) {
?>
    <h4 style="color: red"> 
        <div class="alert alert-warning alert-dismissible fade show">
            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a> -->
            <strong><?php if(!empty($cls)) echo $cls; else echo "Error!!!"?></strong> <font color="red"> <?php echo $msg; ?></font>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </h4>
<?php
        $this->session->unset_userdata('msg');
        $this->session->unset_userdata('cls');
    }
?>

<?php if(!empty($locked_emails)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Field 1</th>
                    <th scope="col">Field 2</th>
                    <th scope="col">Field 3</th>
                    <th scope="col">Locked By</th>
                    <th scope="col">Locked Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($locked_emails)) {
                        $count = 1;
                        foreach ($locked_emails as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\">".$count."</td>";
                            echo "<td scope=\"col\">".$row->field_data_0."</td>";
                            echo "<td scope=\"col\">".$row->field_data_1."</td>";
                            echo "<td scope=\"col\">".$row->field_data_2."</td>";
                            echo "<td scope=\"col\">".$row->id_locked_user."</td>";
                            echo "<td scope=\"col\">".$row->date_locked."</td>";
                            echo "<td>
                                    <a href=\"".base_url()."unlock_email?id=".$row->id."\" onclick=\"return confirm('Do you really want to release?');\">
                                        <i class=\"fa fa-check fa-2x\" title=\"Unlock\" style=\"color:red;\"></i>
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
<?php } else {
    echo "<h4 class=\"page-title text-center\">No Locked Email Available!</h4>";
} ?>