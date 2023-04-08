<?php
include_once ('../connection.php');
$sql="delete from testimonial where id='".$_GET['id']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Testimonial Deleted");window.location="index.php?p=testimonial";</script>';
}
?>