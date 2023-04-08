<?php
if (isset($_POST['update'])) {
    $escape = array();
    $sql = "update certificate set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit') {
            if (is_array($b['name'])) {
                $dd = '`' . $a . '`=';
                $b['name'] = array_unique(array_values(array_filter($b['name'])));
                $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
                for ($i = 0; $i < count($b['name']); $i++) {
                    $b['name'][$i] = time() . '-' . $b['name'][$i];
                    move_uploaded_file($b['tmp_name'][$i], '../files/' . $b['name'][$i]);
                }
                if ($_POST[$a][0]) {
                    unset($pb1);
                    for ($i = 0; $i < count($_POST[$a]); $i++) {
                        $pb1[] = mysql_escape_string($_POST[$a][$i]);
                    }
                    $dd .= "'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                } else
                    $dd .= "'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], '../files/' . $b['name']);
                $dd .= "'" . $b['name'] . "'";
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
                $dd .= "'" . implode(",", $pb1) . "'";
            } else {
                if (strpos($a, "time") || strpos($a, "date") || $a == 'datetime')
                    $dd .= "'" . dmy2mysql($b) . "'";
                else
                    $dd .= "'" . mysql_escape_string($b) . "'";
            }
        }
        $pa[] = $dd;
    }
    $sql .= implode(',', $pa) . " where id=" . $_GET['id'];
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    if ($q) {
        echo "<script>alert('certificate Updated');window.location='index.php?p=certificate' </script>";
        //exit;
    }
}
$sql = "select * from certificate where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);

if (isset($_GET['del'])) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update certificate set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('certificate Updated');window.location='index.php?p=certificate&id=" . $_GET['id'] . "';</script>";
    //exit;
}
?>


<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit certificate</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <!--        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" enctype="multipart/form-data" action=""
        novalidate="novalidate">
        <!--        <input type="hidden" value="certificate" name="db"/>
        <input type="hidden" value="<?php //echo $rdata['id'];       
                                    ?>" name="id"/>-->
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <!-- <div class="form-group has-error" >
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" value="<?php echo $rdata['name']; ?>" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div> -->
                                                <!--                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Pos. <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="pos" value="<?php echo $rdata['pos']; ?>" class="form-control required has-error" style="border-radius: 6px;width:250px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>-->
                                                <!--                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_category_default_layout">Type</label>
                                                        <div class="controls">
                                                            <select class="select1" id="elm_category_default_layout" class="cm-combo-select cm-toggle-element" name="type">
                                                                <?php
                                                                if ($rdata['type'] == 'Graphic certificate') {
                                                                ?>
                                                                    <option selected="">Graphic certificate</option>
                                                                    <option>Text certificate</option>
                                                                    <?php
                                                                }
                                                                if ($rdata['type'] == 'Text certificate') {
                                                                    ?>
                                                                    <option>Graphic certificate</option>
                                                                    <option selected="">Text certificate</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label" for="image">Certificate
                                                            1:</label>
                                                        <div class="col-md-9">
                                                            <?php
                                                            if (
                                                                substr($rdata['image'], -3) == 'png' || substr($rdata['image'], -3) == 'jpg' || substr($rdata['image'], -3) == 'JPG' || substr($rdata['image'], -4) == 'jpeg' || substr($rdata['image'], -3) == 'gif' || substr($rdata['image'], -3) == 'bmp'
                                                                || substr($rdata['image'], -3) == 'svg'
                                                                || substr($rdata['image'], -3) == 'SVG'
                                                            ) {
                                                                echo '<input name="image" value="' . $rdata['image'] . '" type="hidden" class="form-control   edit_product_image product_image  " > <img src="../files/' . $rdata['image'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } elseif ($rdata['image']) {
                                                                echo '<input name="image" value="' . $rdata['image'] . '" type="hidden" class="form-control edit_product_image product_image  " > <a target="_BLANK" href="../files/' . $rdata['image'] . '" style="width:200px;" >Download ' . $rdata['image'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } else {
                                                            ?>
                                                            <input type="file" name="image"
                                                                class="form-control required has-error"
                                                                style="border-radius: 6px;width:350px;">
                                                            <?php } ?>
                                                            <label for="req1" generated="true"
                                                                class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                        <div class="controls"></div>
                                                    </div>
                                                    <!--                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-4 control-label">Open in new window<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a">
                                                                <?php
                                                                if ($rdata['newwindow'] == 'yes') {
                                                                ?>
                                                                    <input type="checkbox" name="newwindow" id="elm_product_status_0_a" selected="" value="yes">
                                                                <?php } else { ?>
                                                                    <input type="checkbox" name="newwindow" id="elm_product_status_0_a" value="No">
                                                                <?php } ?>
                                                            </label>
                                                        </div>
                                                    </div>-->
                                                    <!--                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">URl: <span class="required">*</span></label> 
                                                        <div class="col-md-9"> <input type="text" value="<?php echo $rdata['url']; ?>" name="url" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Creation Date <span class="required">*</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="creationdate" value="<?php echo mysql2dmy($rdata['creationdate']); ?>" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                        </div>
                                                    </div>-->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                       <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Link:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="link" style="width: 200px;" value="<?php echo $rdata['sort']; ?>"class="form-control required has-error">               
                                                        </div>
                                                    </div>  -->
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span
                                                                class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <?php if ($rdata['status'] == 'Active') { ?>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    checked="checked" value="Active">Active</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="status" id="elm_product_status_0_h"
                                                                    value="Hidden">Hidden</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    value="Disabled">Disabled</label>
                                                            <?php }
                                                            if ($rdata['status'] == 'Hidden') { ?>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    value="Active">Active</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="status" id="elm_product_status_0_h"
                                                                    checked="checked" value="Hidden">Hidden</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    value="Disabled">Disabled</label>
                                                            <?php }
                                                            if ($rdata['status'] == 'Disabled') { ?>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    value="Active">Active</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="status" id="elm_product_status_0_h"
                                                                    value="Hidden">Hidden</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    checked="checked" value="Disabled">Disabled</label>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <div class="form-group" style="border-top:none;">
                                                            <label class="col-md-2 control-label">Sort:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="sort" style="width: 200px;"
                                                                    value="<?php echo $rdata['sort']; ?>"
                                                                    class="form-control required has-error">
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
        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
            <input type="submit" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update"
                value="update" />
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
        </div>
    </form>
</div>


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
        $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected',
            'selected');
    });
});
</script>