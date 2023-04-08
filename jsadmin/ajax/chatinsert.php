<?php
include('../connection.php');
if($_POST['msg']){
    $sql="insert into   chat(`from`, `to`, `message`, `datetime`, `recd`, `sessionid`, `name`, `mobile`, `email`)
        values('admin','".$_POST['name']."','".$_POST['msg']."',now(),1,'".session_id()."','".$_POST['name']."'
            ,'".$_POST['mobile']."','".$_POST['email']."')";
    $q=mysql_query($sql) or die(mysql_error().$sql);
}
?>