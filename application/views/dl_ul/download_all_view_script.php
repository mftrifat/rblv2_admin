<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if(category_id) {
                $('#size_field').attr('hidden', true);
                $('#search_btn').attr('hidden', true);
                $.ajax({
                    url: 'ajax-get-sub-category/'+category_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="sub_category_id"]').empty();
                        $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
                        $.each(data, function(key, value) {
                            $('select[name="sub_category_id"]').append('<option value="'+ value.id +'">'+ value.category_name +'</option>');
                        });
                    }
                });
            }else{
                $('#size_field').attr('hidden', true);
                $('#search_btn').attr('hidden', true);
                $('select[name="sub_category_id"]').empty();
                $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
            }
        });

        $('select[name="sub_category_id"]').on('change', function() {
            var sub_category_id = $(this).val();
            if(sub_category_id) {
                $('#search_btn').removeAttr('hidden');
                $('#size_field').removeAttr('hidden');
                $('#search_btn').empty();
                var html = '';
                html += '<button class="btn btn-success text-white mb-2" id="submit" name="submit" value="download"><i class="mdi mdi-download mdi-18px"></i></button>';
                $('#search_btn').append(html);
            } else {
                $('#size_field').attr('hidden', true);
                $('#search_btn').attr('hidden', true);
            }
        });

        var clicks = 0;
        var batch_name = "batch_"+Date.now();

        if($('#table_load').val() === 'loaded') {
            $('#example2').DataTable( {
                "scrollCollapse"    : true,
                "bFilter"           : false,
                "paging"            : false,
                "ordering"          : false,
                "info"              : false,
                "dom"               : 'Bfrtip',
                "buttons"           :   [
                                            {
                                                extend: 'csv',
                                                title: batch_name
                                            },
                                            {
                                                extend: 'excel',
                                                title: batch_name
                                            }
                                        ]
            });
        }

        $('button.dt-button[type=button]').on('click', function() {
            if(clicks === 0){
                var batch_category = $('#selected_category_id').val();
                var batch_sub_category = $('#selected_sub_category_id').val();
                var batch_size = $('#example2 tr').length - 1 ;
                $.ajax({
                    url: 'create_download_batch',
                    data: { batch_category:batch_category, batch_sub_category:batch_sub_category, batch_size: batch_size, batch_name: batch_name },
                    success:function(data) {
                        // console.log(batch_name);
                        secondfunc(batch_name);
                    }
                });                
            }
            clicks++;
        });

        function secondfunc(batch_name) {
            $('#example2 tr').each(function() {
                var batch_sl = $(this).find(".batch_sl").html();
                var markId = $(this).find(".IDCell").val();
                if(markId){
                    $.ajax({
                        url: 'mark_download',
                        data: { mark_id: markId, batch_sl:batch_sl, download_batch_name: batch_name },
                        success:function(data) {
                            // console.log(data);
                        }
                    });
                }
            });
        }
    });
</script>