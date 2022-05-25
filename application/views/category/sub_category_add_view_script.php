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

        var rowIdx = 2;
        var field_count = 1;
        $('#addBtn').on('click', function () {
            if(rowIdx<=10){
                $('#tbody').append(`
                    <tr>
                        <td>
                            <input type="text" id="field_name_${rowIdx}" name="field_name_${rowIdx}" class="form-control form-control-line" maxlength="120" required>
                        </td>
                        <td>
                            <input type="number" id="field_length_${rowIdx}" name="field_length_${rowIdx}" class="form-control form-control-line" required value="250">
                        </td>
                        <td>
                            <select class="basic-single form-select shadow-none form-control-line" id="field_type_${rowIdx}" name="field_type_${rowIdx}" required>
                                <option value="null" disabled selected>--Select Type--</option>
                                <option value="text">Text</option>
                                <option value="email">Email</option>
                                <option value="number">number</option>
                            </select>
                        </td>
                        <td>
                            <input type="checkbox" class="form-check-input " id="field_required_${rowIdx}" name="field_required_${rowIdx}" value="required">
                        </td>
                        <td>
                            <input type="checkbox" class="form-check-input " id="field_hidden_${rowIdx}" name="field_hidden_${rowIdx}" value="1">
                        </td>
                        <td>
                            <button class="btn btn-danger remove" type="button">Remove</button>
                        </td>
                    </tr>
                `);
                $('#field_count').val(rowIdx);
                rowIdx++;
                field_count++;
            } else {
                alert("Maximum number of fields added! Can't add any more!");
            }
        });

        $('#tbody').on('click', '.remove', function () {
            rowIdx--;
            $('#field_count').val(--field_count);
            $(this).closest('tr').remove();
        });

        if($('#table_load').val() === 'loaded') {
            $('#example2').DataTable( {
                "scrollCollapse": true,
                "paging":         true,
                "ordering":       true,
                "info":           false,
            } );
        }
    });
</script>