<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="robots" content="noindex,follow">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo_icon.ico">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" class="theme-stylesheet" id="theme-style" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles_login.css" />  

    <title>RBL &#8226; <?php echo $title;?></title>

    <style type="text/css">
        body:before {
            content: "";
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
            /*background: url("<?php echo base_url();?>assets/img/agrani0-bongobondu-corner1.jpg") no-repeat center center;*/
            background: linear-gradient(140deg, #EADEDB 0%, #BC70A4 50%, #BFD641 75%);
            opacity: 80%;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;    
        }
    </style>
</head>

<body>
    <div class="index_container text-center" id="con">
        <div class="row base-section">
            <?php echo $contents;?>
        </div>
    </div> 
 
	<!-- basic scripts -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.form-switch').on('change', function() {
                $('.form').removeClass('active');
                var formToShow = '.form-' + $(this).data('id');
                $(formToShow).addClass('active');
            });

            $("#confirm_password").keyup(function(){
                if ($("#password").val() != $("#confirm_password").val()) {
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

            // $("#branch_code").focusout(function(){
            //     var br_code_check = $("input[name='branch_code']").val();

            //     $.ajax({
            //         url: '/ajax-request',
            //         type: 'POST',
            //         data: {br_code: br_code_check, is_branch: 1},
            //         error: function() {
            //             alert('Something is wrong');
            //         },
            //         success: function(data) {
            //         }
            //     });
            // });
        });
    </script>
</body>
</html>