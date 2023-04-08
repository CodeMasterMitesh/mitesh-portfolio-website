<?php

include_once ('../connection.php');

    $sql = "delete from products where id='" . $_GET['id'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Product Deleted");window.location="index.php?p=stockfabric";</script>';
    }
    
?>

