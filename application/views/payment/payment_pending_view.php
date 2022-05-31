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

<?php if(!empty($pending_payment)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Request By</th>
                    <th scope="col">Request Date</th>
                    <th scope="col">Request Amount</th>
                    <th scope="col">Charge Amount</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($pending_payment)) {
                        $count = 1;
                        foreach ($pending_payment as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";                            
                            echo "<td scope=\"col\" class=\"text-center\">".$this->ModelCommon->single_result('tbl_users','user_name','user_id',$row->user_id)."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->request_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->request_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->charge_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->payment_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">";
                            if($row->payment_status == 0){
                                echo "Reqested";
                            } else if($row->payment_status == 1) {
                                echo "Paid";
                            } else if($row->payment_status == -1) {
                                echo "Rejected";
                            }
                            echo "</td>";
                            echo "<td scope=\"col\" class=\"text-center\">
                                    <a class=\"btn btn-success text-white\" href=\"".base_url()."confirm_payment?id=".$row->id."\" >Action
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