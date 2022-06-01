<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if(!empty($all_price_list)){ ?>
<br>
<div>
    <div class="table-responsive" id="view_table">
        <table id="example2" class="display table table-bordered table-striped" style="width: 98% !important;">
            <input type="hidden" id="table_load" value="loaded"><br>
            <thead>
                <tr class="text-center" id="table_header">
                    <th scope="col" width="10%">#</th>
                    <th scope="col" width="60%">Category Name</th>
                    <th scope="col" width="10%">Rate</th>
                    <th scope="col" width="20%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($all_price_list)) {
                        $count = 1;
                        foreach ($all_price_list as $row) {
                            echo "<tr>";
                            if($row->category_level == 0) {
                                echo "<td style=\"background:skyblue; \" colspan=\"4\" class=\"text-left\">".$row->category_name."</td>";
                                $count = 1;
                            } else {
                                echo "<td scope=\"col\">".$count."</td>";
                                echo "<td scope=\"col\">".$row->category_name."</td>";
                                echo "<td scope=\"col\" class=\"text-center\">".$row->default_rate."</td>";
                                echo "<td scope=\"col\" class=\"text-center\">";
                                if($row->status == 1){
                                    echo "Active";
                                } else if($row->status == 0) {
                                    echo "Not Active";
                                }
                                echo "</td>";
                                $count++;
                            }
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>