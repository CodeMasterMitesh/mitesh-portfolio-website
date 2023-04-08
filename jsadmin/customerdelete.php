<?php
include_once ('../connection.php');
$sql="delete from clients where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Customer Deleted");window.location="index.php?p=customer";</script>';
}
?>