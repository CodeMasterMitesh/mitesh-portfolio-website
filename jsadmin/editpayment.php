<?php
if (isset($_POST['name'])) {
    $sql = "update payments set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit' && substr($a, 0, 3) != 'pd_') {
            if (is_array($b['name'])) {
                $dd = '`' . $a . '`=';
                $b['name'] = array_unique(array_values(array_filter($b['name'])));
                $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
                for ($i = 0; $i < count($b['name']); $i++) {
                    $b['name'][$i] = time() . '-' . $b['name'][$i];
                    move_uploaded_file($b['tmp_name'][$i], 'files/' . $b['name'][$i]);
                }
                if ($_POST[$a][0]) {
                    unset($pb1);
                    for ($i = 0; $i < count($_POST[$a]); $i++) {
                        $pb1[] = mysql_escape_string($_POST[$a][$i]);
                    }
                    $dd.="'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                }
                else
                    $dd.="'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
                $dd.="'" . $b['name'] . "'";
                $escape[] = $a;
            }
            $pa[] = $dd;
        }
    }

    foreach ($_POST as $a => $b) {
        if ($a != 'update' && !in_array($a, $escape) && substr($a, 0, 3) != 'pd_') {
            $dd = "`" . $a . "`=";
            if (is_array($b)) {
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || strpos($a, "date") || $a == 'datetime')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $dd.="'" . implode(",", $pb1) . "'";
            }
            else {
                if (strpos($a, "time") || strpos($a, "date") || $a == 'datetime')
                    $dd.= "'" . dmy2mysql($b) . "'";
                else
                    $dd.= "'" . mysql_escape_string($b) . "'";
            }
        }
        $pa[] = $dd;
    }
    $sql.=implode(',', $pa) . " where id=" . $_GET['id'];
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    $pid = $_GET['id'];
    if ($q) {
        $sql1 = "delete from payment_details where pid=" . $pid;
        $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);

        for ($i = 0; $i < count($_POST['pd_name']); $i++) {
            if ($_POST['pd_name'][$i]) {
                $sql1 = "insert into payment_details (`pid`,`name`,`value`)
                values('" . $pid . "','" . $_POST['pd_name'][$i] . "','" . $_POST['pd_value'][$i] . "')";
                $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
            }
        }
        $j=$i;
        echo "<script>alert('Product Updated'); </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from payments where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update payments set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Payment Updated'); window.location='index.php?p=editpayment&id=" . $_GET['id'] . "';</script>";
}
?> 

<div class="page-header" > 
            <div class="page-title"> <h3>Edit Payments</h3> </div> 
            <a href="index.php?p=payment">

            </a>
        </div> 
<form class="form-horizontal row-border" id="editprodf" method="post"  action="" enctype="multipart/form-data">
<div class="panel panel-default" style="vertical-align: top; ">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Payment</a> </h3>
        </div>
       
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
            
                  <style>
                    .reports td:nth-child(3){
                        padding-left: 16px;
                    }
                </style>
                <table style="width: 100%;vertical-align: top;line-height: 46px; " class="reports">
                    <tr>
                        <td>
                           Name
                        </td>
                        <td>
                              <input type="text" name="name"  class="form-control required has-error discount" style="border-radius: 6px; "> 
                        </td>
                        
                        <td>
                           Help Url 
                        </td>
                      
                        <td>
                            <input type="text" name="helpurl"  class="form-control required has-error discount" style="border-radius: 6px; "> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Status
                        </td>
                        <td>
                            <select name="status" class="form-control required has-error discount" style="border-radius: 6px;">
                                <option>Active</option>
                                 <option>Inactive</option>
                                
                            </select>
                        </td>
                    </tr>
                </table>                
               

                    

            </div>
        </div>
    </div>

<div class="panel panel-default" style="vertical-align: top; ">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Payment</a> </h3>
        </div>
       
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="form-group" >
                                            <table style="width:100%" id="imgtable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Value</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php 
$sql1="select * from payment_details where pid=".$_GET['id'];
$q1=mysql_query($sql1) or die(mysql_error().$sql1);
while($r1=mysql_fetch_assoc($q1)){

?>
                                                    <tr>
                                                        <td><input type="text" name="pd_name[]" value="<?php echo $r1['name']?>" class="form-control"  /></td>
                                                        <td><input type="text" name="pd_value[]" value="<?php echo $r1['value']?>" class="form-control"  /></td>
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                    $(this).parent().parent().remove()" /></td>
                                                    </tr>
<?php }?>
                                                    <tr>
                                                        <td><input type="text" name="pd_name[]" value="<?php echo $r1['name']?>" class="form-control"  /></td>
                                                        <td><input type="text" name="pd_value[]" value="<?php echo $r1['value']?>" class="form-control"  /></td>
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                    $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button><a href="#" onclick="$('#imgtable tbody').append($('#imgtable tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More </a></button>
                                        </div>
        </div>
    </div>
    
    <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update" value="Update"/>

        </div>

</form>


<script type="text/javascript">
                                                            datas = Array();
<?php
foreach ($rdata as $a => $b) {
    // echo "$('input[name=\"".$a."\"]').val('".$b."');";
    // echo "$('select[name=\"".$a."\"] option[value=\"".$b."\"]').attr('selected','selected');";
    if (strpos($a, "date") || $a == "date" || strpos($a, "datetime") || $a == 'datetime')
        echo 'datas["' . $a . '"]="' . mysql2dmy($b) . '";';
    elseif ($a != 'description')
        echo 'datas["' . $a . '"]="' . mysql_escape_string($b) . '";';
}
?>
                                                            $(document).ready(function() {
                                                                $('#editprodf input[type="text"]').each(function() {
                                                                    if (typeof datas[$(this).attr('name')] != 'undefined') {
                                                                        $(this).val(datas[$(this).attr('name')]);
                                                                    }
                                                                });
                                                                $('#editprodf input[type="hidden"]').each(function() {
                                                                    if (typeof datas[$(this).attr('name')] != 'undefined') {
                                                                        $(this).val(datas[$(this).attr('name')]);
                                                                    }
                                                                });
                                                                $('#editprodf textarea').each(function() {
                                                                    if (typeof $(this).attr('name') != 'undefined')
                                                                        $(this).html(datas[$(this).attr('name')]);
                                                                });
                                                                $('#editprodf input[type="checkbox"]').each(function() {
                                                                    if ($(this).val() == datas[$(this).attr('name')]) {
                                                                        $(this).attr('checked', 'checked')
                                                                    }
                                                                });
                                                                $('#editprodf input[type="radio"]').each(function() {
                                                                    if ($(this).val() == datas[$(this).attr('name')]) {
                                                                        $(this).attr('checked', 'checked')
                                                                    }
                                                                });
                                                                $('#editprodf select').each(function() {
                                                                    $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected', 'selected');
                                                                });
                                                            });
</script>