<?php
include_once ('../connection.php');
$sql="delete from feedback1 where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Feedback Deleted");window.location="index.php?p=feedback";</script>';
}
?>