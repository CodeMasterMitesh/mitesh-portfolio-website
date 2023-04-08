<?php
include_once ('../connection.php');
$sql="delete from newsletter where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("newsletter Deleted");window.location="index.php?p=newsletter";</script>';
}
?>