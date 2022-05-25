<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('#profileform').on('input change', function() {
            $('#submit').attr('disabled', false);
        });
    })
</script>