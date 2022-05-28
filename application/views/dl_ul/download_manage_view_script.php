<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        if($('#table_load').val() === 'loaded') {
            $('#example2').DataTable( {
                "scrollCollapse"    : true,
                "bFilter"           : true,
                "paging"            : true,
                "ordering"          : true,
                "info"              : false
            });
        }

        var clicks = 0;
        $('button.dt-button[type=button]').on('click', function() {
            if(clicks === 0){
                var batch_category = $('#selected_category_id').val();
                var batch_name = "batch_"+Date.now();
                var batch_size = $('#example2 tr').length - 1 ;
                $.ajax({
                    url: 'create_download_batch',
                    data: { batch_category:batch_category, batch_size: batch_size, batch_name: batch_name },
                    success:function(data) {
                        // console.log(batch_name);
                    }
                });
                secondfunc(batch_name);
            }
            clicks++;
        });

        function secondfunc(batch_name) {
            $('#example2 tr').each(function() {
                var markId = $(this).find(".IDCell").html();
                if(markId){
                    $.ajax({
                        url: 'mark_download',
                        data: { mark_id: markId, download_batch_name: batch_name },
                        success:function(data) {
                            // console.log(data);
                        }
                    });
                }
            });
        }
    });
</script>