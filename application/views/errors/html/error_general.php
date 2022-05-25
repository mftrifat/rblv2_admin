<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<link rel="shortcut icon" sizes="16x16" href="assets/img/logo_icon.ico">
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
        top: 20%;
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
		<img src="assets/img/logo.png" style="width:180px; padding-top:15px;">
		<h1>Error</h1>
		<h2><?php echo $heading; ?></h2>
		<p><?php echo $message; ?></p>
		<br>
        <a href='Home'>Go Back to Homepage</a>
	</div>
</body>
</html>