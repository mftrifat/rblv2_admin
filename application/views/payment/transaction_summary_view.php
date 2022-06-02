<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">            
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">Total Cashout</th>
                    <th scope="col">Total Charge</th>
                    <th scope="col">Total Commission</th>
                    <th scope="col">Super Admin Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" class="text-center"><?php echo $this->ModelPayments->total_cashout(); ?></td>
                    <td scope="col" class="text-center"><?php echo $this->ModelPayments->total_charge(); ?></td>
                    <td scope="col" class="text-center"><?php echo $this->ModelPayments->total_commission(); ?></td>
                    <td scope="col" class="text-center"><?php echo $this->ModelPayments->total_charge()-$this->ModelPayments->total_commission(); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>

<?php echo form_open(); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <label style="padding-top: 10px;">Select User</label>
        </div>
        <div class="col-md-4">
            <select class="basic-single form-select shadow-none form-control-line" id="selected_user" name="selected_user" required>
                <option value="" disabled selected>--- Select User ---</option>
                <?php
                if (!empty($user_list)) {
                    foreach ($user_list as $row) {
                        ?>
                        <option value="<?php echo $row->user_id; ?>"><?php echo $row->full_name." - ".$row->user_name; ?></option>

                    <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 text-center">
            <button class="btn btn-success text-white mb-2" id="submit" name="submit" value="submit">Search User&nbsp;&nbsp;<span><i class="fa fa-check"></i></span></button>
        </div>
    </div>
</form>


<?php if(!empty($transaction_summary)){ ?>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col">#</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Transaction Details</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Transaction Amount</th>
                    <th scope="col">Balance Before</th>
                    <th scope="col">New Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($transaction_summary)) {
                        $count = 1;
                        foreach ($transaction_summary as $row) {
                            echo "<tr>";
                            echo "<td scope=\"col\" class=\"text-center\">".$count."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->transaction_type."</td>";
                            if($row->batch_category) {
                            echo "<td scope=\"col\">Category: ".$this->ModelCommon->single_result('tbl_category','category_name','id',$row->batch_category)."<br>Input: ".$row->total_input."<br>Accepted: ".$row->total_checked."<br>Rejected: ".$row->total_rejected."</td>";
                            } else {
                                echo "<td scope=\"col\" class=\"text-center\">".$row->remarks."</td>";
                            }                            
                            echo "<td scope=\"col\" class=\"text-center\">".$row->transaction_date."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->total_amount."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->balance_before."</td>";
                            echo "<td scope=\"col\" class=\"text-center\">".$row->balance_new."</td>";
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