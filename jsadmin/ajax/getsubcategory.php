<?php
ini_set('display_errors',1);
include('../../connection.php');
//    $sql = "SELECT * from `category` where `parent` = ".$_POST['id'].""; // and company='".$_SESSION['udata']['company']['id']."' and `delete`=0 and active=1 
//    $q = mysql_query($sql) or die(mysql_error() . $sql);
//while ($r = mysql_fetch_assoc($q)) {
//    $data[] = $r;
//        $data[$i]['label'] = $row['name'];
//        $data[$i]['value'] = $row['name'];
//        $i++;
//}
if(!empty($_POST['id'])){
$sql = "SELECT id,name,parent from `category` where `parent` = '".$_POST['id']."'"; //and company='".$_SESSION['udata']['company']['id']."' and `delete`=0 and active=1  "; 
$getName = mysql_query($sql) or die(mysql_error().$sql);
    $i = 0;
while ($row = mysql_fetch_assoc($getName)) {
$data[$i]=$row;
        $data[$i]['label'] = $row['name'];
        $data[$i]['value'] = $row['name'];
        $i++;
}
} 
echo json_encode($data);
?>
