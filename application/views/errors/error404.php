<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html>
<head>
    <title>404 Page Not Found</title>
    <link rel="shortcut icon" sizes="16x16" href="<?php echo base_url();?>assets/img/logo_icon.ico">
    <style>
        body{
            width: 99%;
            height: 100%;
            /*background-color: mediumturquoise;*/
            background-color: #414755;
            color: white;
            font-family: sans-serif;
        }
        div {
            position: absolute;
            width: 400px;
            height: 300px;
            z-index: 15;
            top: 35%;
            left: 50%;
            margin: -100px 0 0 -200px;
            text-align: center;
        }
        h1,h2{
            text-align: center;
        }
        h1{
            font-size: 60px;
            margin-bottom: 10px;
            border-bottom: 1px solid white;
            padding-bottom: 10px;
        }
        h2{
            margin-bottom: 40px;
        }
        a {
            text-transform: uppercase;
            text-decoration: none;
            background: #b3b3b3;
            color: #0a0a0a;
            padding: 1rem 4rem;
            border-radius: 4rem;
            font-size: 0.875rem;
            letter-spacing: 0.05rem;
        }
    </style>
</head>
<body>
    <div>
        <h1>404</h1>
        <h2>We can't find that page</h2>     
        <p>We're fairly sure that page used to be here, but seems to have gone missing. We do apologise on it's behalf.</p>
        <br>
        <a href='<?= base_url(); ?>' >Back to Homepage</a>
    </div>
</body>
</html>