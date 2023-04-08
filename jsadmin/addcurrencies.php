<?php
if (isset($_POST['submit'])) {
    $sql = "insert into currency (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], 'files/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
            $pb[] = $b['name'];
        }
    }
    foreach ($_POST as $a => $b) {
        if ($a != 'submit') {
            if (is_array($b)) {
                $pa[] = $a;
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $pb[] = implode(',', $pb1);
            }
            else {
                $pa[] = $a;
                if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                    $pb[] = dmy2mysql($b);
                else
                    $pb[] = mysql_escape_string($b);
            }
        }
    }
    $sql.=implode('`,`', $pa) . "`) values('" . implode("','", $pb) . "')";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q)
        echo "<script>alert('New Currency Created');window.location='index.php?p=currencies';</script>";
}
?><div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Currencies</h3>
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
                                        <table style="width: 500px;vertical-align: top;line-height: 45px;" class="tables">
                                            <tr>
                                                <td>
                                                    Date :
                                                </td>
                                                <td>
                                                    <input type="text"  name="date" class="form-control datepicker required has-error" style="border-radius: 6px;" value="<?php echo date('d/m/Y');?>">

                                                </td>
                                                <td>
                                                    1 USD =    
                                                </td>
                                                <td>
                                                    <input type="text"  name="inr" class="required has-error form-control" style="border-radius: 6px;width:100px;float:left">
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

        <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
        <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->

    </div>
                                        </form>