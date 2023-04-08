<?php
if (isset($_POST['update'])) {
    $sql = "update customers set ";
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
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    if ($q) {
        echo "<script>alert('Users Group Updated'); </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from customers where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update Users set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Users Group Updated'); window.location='index.php?p=editusergroup&id=" . $_GET['id'] . "';</script>";
}
?> 

<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Editing Profile(Users Group)</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> User account information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div class="form-group has-error" >
                                                    <div class="control-group">
                                                        <label for="email" class=" col-md-2 control-label cm-required cm-email">User Group:<span class="required">*</span></label> 
                                                        <div class="col-md-9">
                                                            <input type="text" name="email" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Type  <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 
                                                        <select name="type" id="user_language" class="select1">
                                                            <option>Customer</option>
                                                            <option>Administrator</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="A">Active</label>
                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Hidden</label>
                                                             <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Disabled</label>
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
                </div>
            </div>
            

        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update" value="update"/>
           
        </div>
    </form>
</div>
<script type="text/javascript">
                                                datas = Array();
<?php
foreach ($rdata as $a => $b) {
   
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