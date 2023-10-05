
<?php
include("config/dbconnect.php");
include("includes/header.php");
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .container{
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateY(200%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-success text-center">
                        <?= "THANK YOU <br>" ?>
                        <?= "Your Order Is Placed Successfully" ?>
                    </div>