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
        
        if($('#table_load').val() === 'loaded') {
            $('#example2').DataTable( {
                "scrollCollapse"    : true,
                "bFilter"           : false,
                "paging"            : true,
                "ordering"          : false,
                "info"              : false,
                "dom"               : 'Bfrtip',
                "buttons"           : ['csv', 'excel']
            });
        }
    });
</script>