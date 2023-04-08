<?php
if (isset($_POST['update'])) {
    $sql = "update currency set ";
    foreach ($_POST as $a => $b) {
        if ($a != 'update' && !in_array($a, $escape)) {
            $dd = "`" . $a . "`=";
            if (is_array($b)) {
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $dd.="'" . implode(",", $pb1) . "'";
            }
            else {
               if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                         $dd.= "'" . dmy2mysql($b) . "'";
                else
                    $dd.= "'" . mysql_escape_string($b) . "'";
            }
        }
        $pa[] = $dd;
    }
    $sql.=implode(',', $pa) . " where id=" . $_GET['id'];
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    if ($q) {
        echo "<script>alert('Currency Updated'); window.location='index.php?p=currencies';</script>"; //
    }
}
$sql = "select * from currency where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update currencies set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Currency Updated'); window.location='index.php?p=currencies&id=" . $_GET['id'] . "';</script>";
}
?> <div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Currencies</h3>
    </div>
</div>
<form method="post">
<div class="tab-content" style="margin-top: 10px;">


    <div class="tab-pane active" id="tab_1_1">

        <div class="widget">
            <div class="widget-content">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default" style="margin-left: -5px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> General</a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <style>
                                            .tables td:nth-child(3)
                                            {
                                                padding-left: 10px;
                                            }
                                        </style>
                                        <table style="width: 500px;vertical-align: top;line-height: 45px;" class="tables">
                                            <tr>
                                                <td>
                                                    Date :
                                                </td>
                                                <td>
                                                    <input type="text"  name="date" class="form-control datepicker required has-error" style="border-radius: 6px;" value="<?php echo mysql2dmy($rdata['date']);?>">

                                                </td>
                                                <td>
                                                    1 USD =    
                                                </td>
                                                <td>
                                                    <input type="text"  name="inr" class="required has-error form-control" style="border-radius: 6px;width:100px;float:left" value="<?php echo ($rdata['inr']);?>">
                                                    <span style="float:left">INR</span>

                                                </td>
                                            </tr>

                                        </table>





                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>



</div>

<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

        <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update"/>
        <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->

    </div>
</form>