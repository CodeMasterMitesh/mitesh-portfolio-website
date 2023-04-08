<?php
if (isset($_POST['name'])) {
    $sql = "update products set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit' && substr($a, 0, 8) != 'prodimg_') {
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
        if ($a != 'update' && !in_array($a, $escape) && substr($a, 0, 8) != 'prodimg_'  && substr($a, 0, 7) != 'option_') {
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
        $sql1 = "delete from productimages where pid=" . $pid;
        $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);

        for ($i = 0; $i < count($_POST['prodimg_name']); $i++) {
            if ($_POST['prodimg_name'][$i]) {
                $sql1 = "insert into productimages (`pid`,`name`,`alttext`,`position`)
                values('" . $pid . "','" . $_POST['prodimg_name'][$i] . "','" . $_POST['prodimg_alttext'][$i] . "','" . $_POST['prodimg_position'][$i] . "')";
                $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
            }
        }
        $j=$i;

        for ($i = 0; $i < count($_FILES['prodimg_name']['name']); $i++,$j++) {
            if ($_FILES['prodimg_name']['name'][$i]) {
                $filename = time() . "-" . $_FILES['prodimg_name']['name'][$i];
                move_uploaded_file($_FILES['prodimg_name']['tmp_name'][$i], '../catalog/' . $filename);
                $sql1 = "insert into productimages (`pid`,`name`,`alttext`,`position`)
                values('" . $pid . "','" . $filename . "','" . $_POST['prodimg_alttext'][$j] . "','" . $_POST['prodimg_position'][$j] . "')";
                $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
            }
        }
         $sql2 = "delete from productoptions where pid=" . $pid;
        $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);

        for ($j = 0; $j < count($_POST['oid']); $j++) {
            if ($_POST['oid'][$j]) {
               echo $sql2 = "insert into productoptions (`oid`, `pid`, `value`, `price`, `incdec`, `desc`)
                values('" . $_POST['option_oid'][$j] . "','" . $pid . "','" . $_POST['option_value'][$j] . "','" . $_POST['option_price'][$j] . "','" . $_POST['option_incdec'][$j] . "','" . $_POST['option_desc'][$j] . "')";
               exit; 
               $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);
            }
        }
        echo "<script>alert('Product Updated'); </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from products where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update products set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Product Updated'); window.location='index.php?p=editproduct&id=" . $_GET['id'] . "';</script>";
}
?> 

<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Filters</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Categories</a></li>     

    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
        <div class="tab-content">


            <div class="tab-pane active" id="tab_1_1">

                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 


                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">

                                                <div class="form-group has-error" >

                                            <div class="control-group">
                                                <label for="elm_filter_name_0" class="col-md-2 control-label">Name<span class="required">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;" value="">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group has-error" style="border:none;">
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_filter_position_0">Pos.</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_filter_show_on_home_page_0">Show on home page</label>
                                                <div class="col-md-10">
                                                    <input type="hidden" name="filter_data[show_on_home_page]" value="N">
                                                    <input type="checkbox" id="elm_filter_show_on_home_page_0" name="filter_data[show_on_home_page]" checked="checked" value="Y">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_filter_filter_by_0">Filter by</label>
                                                <div class="col-md-10">

                                                    <select class="select1" name="filter_data[filter_type]" onchange="fn_check_product_filter_type(this.value, 'tab_variants_0', 0);" id="elm_filter_filter_by_0">
                                                        <optgroup label="Features">
                                                            <option value="FF-18">Brand</option>
                                                            <option value="FF-15">Operating System</option>
                                                            <option value="FF-16">Display</option>
                                                            <option value="FF-17">Storage Capacity</option>
                                                        </optgroup>
                                                        <optgroup label="Product fields">
                                                            <option value="B-P">Price</option>
                                                            <option value="B-F">Free shipping</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label class="col-md-2  control-label" for="elm_filter_display_0">Display type</label>
                                                <div class="col-md-10">
                                                    <select class="select1"name="filter_data[display]" id="elm_filter_display_0">
                                                        <option value="Y">Expanded</option>
                                                        <option value="N">Minimized</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group " id="display_count_0_container" style="display: block;">
                                                <label class="col-md-2  control-label" for="elm_filter_display_count_0">Number of displayed filter variants before the "more" link&nbsp;<a class="cm-tooltip" title="The remaining variants will be hidden behind the &quot;more&quot; link."><i class="icon-question-sign"></i></a></label>
                                                <div class="col-md-10">
                                                    <input type="text" id="elm_filter_name_0" name="number" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
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
            <div class="tab-pane" id="tab_1_2">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Categories    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        
                                        <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-3 control-label">Categories <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 


                                                        <div class="row"> 
                                                            <div class="col-md-12">
                                                                <a data-toggle="modal" href="#myModal1" class="btn btn-default btn-block" style="width: 142px;  border-radius: 6px;">Add Categories</a> </div> 
                                                            <div class="modal fade" id="myModal1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog"> 
                                                                    <div class="modal-content"> 
                                                                        <div class="modal-header"> 
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                                            <h4 class="modal-title">Add Categories</h4> 
                                                                        </div> 
                                                                        <div class="modal-body"> 


                                                                        </div> 
                                                                        <div class="modal-footer"> 
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button> 
                                                                        </div> 
                                                                    </div> 
                                                                </div>
                                                            </div> 
                                                        </div>


                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
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
            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>

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