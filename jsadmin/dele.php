<?php
include_once ('../connection.php');
$sql="delete from blog where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Blog Deleted");window.location="index.php?p=blog";</script>';
}
?>