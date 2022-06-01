<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(function($) {
        console.log($('#table_load').val());
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