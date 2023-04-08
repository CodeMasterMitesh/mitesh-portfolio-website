<?php
include_once ('../connection.php');
$sql="delete from category where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Category Deleted");window.location="index.php?p=categories";</script>';
}
?>