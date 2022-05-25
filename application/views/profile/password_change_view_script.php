<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('.form-switch').on('change', function() {
            $('.form').removeClass('active');
            var formToShow = '.form-' + $(this).data('id');
            $(formToShow).addClass('active');
        });

        $("#confirm_pass").keyup(function(){
            if ($("#new_pass").val() != $("#confirm_pass").val()) {
                $("#msg").html("Password do not match").css("color","red");
            }else{
                $("#msg").html("");
            }
        });

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>