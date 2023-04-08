<?php
include_once ('../connection.php');
$sql="delete from customers where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Administrator Deleted");window.location="index.php?p=administrator";</script>';
}
?>