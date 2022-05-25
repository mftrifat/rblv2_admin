<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if(category_id) {
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
                $('#search_btn').attr('hidden', true);
                $('select[name="sub_category_id"]').empty();
                $('select[name="sub_category_id"]').append('<option value="null" disabled selected>--- Select Sub-Category ---</option>');
            }
        });

        $('select[name="sub_category_id"]').on('change', function() {
            var sub_category_id = $(this).val();
            if(sub_category_id) {
                $('#search_btn').removeAttr('hidden');
                $('#search_btn').empty();
                var html = '';
                html += '<button class="btn btn-success text-white mb-2" id="submit" name="submit" value="search">Search</button>';
                $('#search_btn').append(html);
            } else {
                $('#search_btn').attr('hidden', true);
            }
        });
    });
</script>