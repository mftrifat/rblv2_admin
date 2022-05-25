<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
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