<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:12px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding:10px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding:10px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
    .button {
        background-color: #4CAF50;
        border: solid darkgrey;
        border-radius: 8px;
        color: white;
        padding: 9px 17px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: -1px 12px;
        cursor: pointer;
        font-weight: bold;
    }
    .drop_down {
        background-color: #f0f8ff;
        border: solid 1px;
        color: #2f4f4f;
        padding: 6px 17px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: -4px 19px;
        font-weight: 600;
    }
    td{
        text-align: center;
    }
    th{
        text-align: center;
    }
    #myBtn {
        display: block;
        position: fixed;
        top: 63px;
        left: 185px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color:#a8abad;
        color: #333333;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
        text-decoration: none;
    }

    #myBtn:hover {
        background-color:#98c4e2;
    }

    #assignment {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #assignment td {
        border: 1px solid #414755;
        padding: 8px;
    }

    #assignment th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #assignment tr:nth-child(even){background-color: #f2f2f2;}

    #assignment tr:hover {background-color: #ddd;}

    #assignment th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #414755;
        color: #ddd;
    }
</style>