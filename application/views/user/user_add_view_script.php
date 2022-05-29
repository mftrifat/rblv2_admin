<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
	$(document).ready(function() {
        $('select[name="user_type_id"]').on('change', function() {
            var category_id = $(this).val();
            if(category_id == '1_Input User') {
            	$('#parent').attr('hidden', false);
            	$('#parent_br').attr('hidden', false);
            	$('#parent_user_id').attr('required', true);
            }else{
            	$('#parent').attr('hidden', true);
            	$('#parent_br').attr('hidden', true);
            	$('#parent_user_id').attr('required', false);            	
            }
        });
    });
</script>