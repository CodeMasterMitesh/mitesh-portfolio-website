<?php

include_once('../connection.php');
if (isset($_GET['del']) == 'yes') {
    $sql = "delete from couponcode where id='" . $_GET['id'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Coupon Deleted");window.location="index.php?p=coupon";</script>';
    }
} else if (isset($_GET['option']) == 'yes') {

    $sql = "delete from options where id='" . $_GET['id'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Option Deleted");window.location="index.php?p=option";</script>';
    }
} else {
    $sql = "delete from products where id='" . $_GET['id'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Product Deleted");window.location="index.php?p=product";</script>';
        //exit;
    }
}