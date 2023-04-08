<?php
if (isset($_POST['update'])) {
    $sql = "update  orders set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit') {
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
        if ($a != 'update' && !in_array($a, $escape)) {
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
    // echo $sql;
    // exit;
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    if ($q) {
        echo "<script>alert('Order Updated');window.location='index.php?p=orders'; </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from  orders where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update  orders set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Product Updated'); window.location='index.php?p=editproduct&id=" . $_GET['id'] . "';</script>";
}
?> 

<form class="form-horizontal row-border"  method="post"  action="" novalidate="novalidate">
    <div>
        <div class="page-header" > 
            <div class="page-title"> <h3> Edit Status</h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div> 
    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">General </a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->

                <style>
                    .email_table td:nth-child(3){
                        padding-left: 25px;
                    }
                </style>
                <table style="width: 100%;line-height: 50px;" class="email_table">

                    <tr>

                        <td>
                            Name:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            E-mail subject: 
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            E-mail header:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Color
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No


                        </td>

                    </tr>
                    <tr>
                        <td>
                            Notify customer
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No

                        </td>

                        <td>
                            Notify orders department
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No </td>

                    </tr>
                    <tr>
                        <td>
                            Inventory
                        </td>
                        <td>
                            <select name="" class="form-control required has-error" style="border-radius: 6px;width:250px;">
                                <option value="not_active" selected="selected">Increase</option>
                                <option value="active">Decrease</option>
                            </select>
                        </td>

                        <td>
                            Remove CC info
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No  </td>

                    </tr>
                    <tr>
                        <td>
                            Pay order again
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No
                        </td>

                        <td>
                            Invoice/Credit memo
                        </td>
                        <td>
                            <select name="" class="form-control required has-error" style="border-radius: 6px;width:250px;">
                                <option value="D">Default</option>
                                <option value="I">Invoice</option>
                                <option value="C">Credit memo</option>
                                <option value="O">Order</option>
                            </select>
                        </td>

                    </tr>


                </table>


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
        $('#validate-1 input[type="text"]').each(function() {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#validate-1 input[type="hidden"]').each(function() {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#validate-1 textarea').each(function() {
            if (typeof $(this).attr('name') != 'undefined')
                $(this).html(datas[$(this).attr('name')]);
        });
        $('#validate-1 input[type="checkbox"]').each(function() {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#validate-1 input[type="radio"]').each(function() {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#validate-1 select').each(function() {
            $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected', 'selected');
        });
    });
</script>