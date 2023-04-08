<?php
include('../connection.php');
$sql = "select * from chat where sessionid like '" . session_id() . "'";
$q = mysql_query($sql) or die(mysql_error() . $sql);
$flag=0;
while ($r = mysql_fetch_assoc($q)) {
    echo "<div style='text-align:left;'><b>" . $r['from'] . " : </b>" . $r['message'] . "</div>";
    $flag=1;
}
if(!$flag)
    unset($_SESSION['chat']);
?>