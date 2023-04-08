<?php
if (isset($_POST['update'])) {
    $sql = "update promotion set ";
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
                    $dd.="'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                } else
                    $dd.="'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], '../files/' . $b['name']);
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
        echo "<script>alert('Banner Updated');window.location='index.php?p=promotion' </script>";
    }
}
$sql = "select * from promotion where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);

if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update promotion set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Promotion Updated'); window.location='index.php?p=promotion&id=" . $_GET['id'] . "';</script>";
}
?> 



<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Promotions</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Condition</a></li>     
        <li class=""><a href="#tab_1_3" data-toggle="tab">Bonuses</a></li>
    </ul>
    <form class="form-horizontal row-border" id="validate-1" enctype="multipart/form-data" method="post"  action="" novalidate="novalidate">
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
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" value="<?php echo $rdata['name']; ?>" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Detailed description:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="description"><?php echo $rdata['description']; ?></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>  
                                                            <script>
                                                                tinymce.init({selector: 'textarea',
                                                                    theme: "modern",
                                                                    width: '95%',
                                                                    height: 300,
                                                                    plugins: [
                                                                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                                                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                                                        "save table contextmenu directionality emoticons template paste textcolor"
                                                                    ],
                                                                    content_css: "css/content.css",
                                                                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                                                    style_formats: [
                                                                        {title: 'Bold text', inline: 'b'},
                                                                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                                                                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                                                                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                                                                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                                                                        {title: 'Table styles'},
                                                                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                                                                    ]
                                                                });
                                                            </script> 
                                                            <!--                                                            class for this = "wysiwyg"-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Short description:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="shortdescription"><?php echo $rdata['shortdescription']; ?></textarea>
                                                            <!--                                                            class for this = "wysiwyg"-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;" >
                                                        <label class="col-md-2 control-label">Use available period<a class="cm-tooltip"></a>:</label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a">
                                                                <?php
                                                                if ($rdata['useavailperiod'] == 'yes') {
                                                                    ?>
                                                                    <input type="checkbox" name="useavailperiod" id="elm_product_status_0_a" checked="checked" value="yes">
                                                                <?php } else { ?>
                                                                    <input type="checkbox" name="useavailperiod" id="elm_product_status_0_a" value="No">
                                                                <?php } ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Available From <span class="required">*</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="availablefromdate" value="<?php echo mysql2dmy($rdata['availablefromdate']); ?>" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Availale Till <span class="required">*</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="availabletilldate" value="<?php echo mysql2dmy($rdata['availabletilldate']); ?>" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_category_position">Priority:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" name="priority" value="<?php echo $rdata['priority']; ?>" class="form-control required has-error" style="border-radius: 6px;width:250px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <div class="control-group" >
                                                            <label class="col-md-2 control-label" for="elm_out_of_stock_actions">Stop other rules &nbsp<a class="cm-tooltip" title="Note that the 'Buy in advance' option requires a positive product amount while the 'Sign up for notification' option requires a non-positive amount. Also note that the 'Sign up for notification' option is not applied to products tracked with options."><i class="icon-question-sign"></i></a>:</label>
                                                            <div class="controls" style="float:left;">
                                                                <label class="radio inline" for="elm_product_status_0_a">
                                                                    <?php
                                                                    if ($rdata['otherrules'] == 'yes') {
                                                                        ?>
                                                                        <input type="checkbox" name="otherrules" id="elm_product_status_0_a" checked="checked" value="yes">
                                                                    <?php } else { ?>
                                                                        <input type="checkbox" name="otherrules" id="elm_product_status_0_a" value="No">
                                                                    <?php } ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <?php if ($rdata['status'] == 'Active') { ?>
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="Active">Active</label>
                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="Hidden">Hidden</label>
                                                                <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="Disable">Disabled</label>
                                                            <?php }if ($rdata['status'] == 'Hidden') { ?>
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" value="Active">Active</label>
                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" checked="checked" value="Hidden">Hidden</label>
                                                                <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="Disable">Disabled</label>
                                                            <?php }if ($rdata['status'] == 'Disable') { ?>
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" value="Active">Active</label>
                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="Hidden">Hidden</label>
                                                                <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" checked="checked" value="Disable">Disabled</label>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>
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
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Group    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Group:</label>
                                                <div>
                                                    <?php
                                                    $flag = 0;
                                                    $image = array_filter(array_values(explode(',', $rdata['image'])));
                                                    for ($i = 0; $i < count($image); $i++) {
                                                        if ($image[$i] && file_exists('files/' . $image[$i])) {
                                                            $flag = 1;
                                                            echo '<img src="files/' . $image[$i] . '"  width="400px"/>';
                                                            ?>
                                                            <div>
                                                                <a href="index.php?p=addproduct&del=image&ids=<?php echo $i; ?>&id=<?php echo $_GET['id'] ?>">Delete</a>
                                                                <input type="hidden" value="<?php echo $image[$i]; ?>" name="image[]" /><br>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-10" id="image">
                                                    <!--                                                    <div class="option">
                                                    
                                                                                                            <select class="select1" type="file" name="image[]" onchange="Tygh.$.ceAjax('request', 'admin.php?dispatch=promotions.dynamic&amp;zone=catalog&amp;promotion_id=0&amp;prefix=' + escape(this.name) + '&amp;condition=' + this.value + '&amp;elm_id=' + this.id, {result_ids: 'container_' + this.id})" id="add_condition_de7bf1df577693ce860ca182ecca7221_2" name="promotion_data[conditions][conditions][2]">
                                                                                                                <option value=""> -- </option>
                                                                                                                <option value="price">Product price</option>
                                                                                                                <option value="categories">Categories</option>
                                                                                                                <option value="products">Products</option>
                                                                                                                <option value="purchased_products">Purchased products</option>
                                                                                                                <option value="users">Users</option>
                                                                                                                <option value="feature">Product feature</option>
                                                                                                                <option value="usergroup">User group</option>
                                                                                                                <option value="reward_points">Points on user account</option>
                                                                                                            </select>
                                                                                                        </div>-->
                                                    <input type="file" name="" class="select1 addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                            <button><a href="#" onclick="$('#image').append($('#image input:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More Group</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_1_3">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bonuses </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Bonuses:</label>
                                                <div>
                                                    <?php
                                                    $flag = 0;
                                                    $image = array_filter(array_values(explode(',', $rdata['image'])));
                                                    for ($i = 0; $i < count($image); $i++) {
                                                        if ($image[$i] && file_exists('files/' . $image[$i])) {
                                                            $flag = 1;
                                                            echo '<img src="files/' . $image[$i] . '"  width="400px"/>';
                                                            ?>
                                                            <div>
                                                                <a href="index.php?p=addproduct&del=image&ids=<?php echo $i; ?>&id=<?php echo $_GET['id'] ?>">Delete</a>
                                                                <input type="hidden" value="<?php echo $image[$i]; ?>" name="image[]" /><br>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-10" id="image1">
                                                    <!--                                                    <div class="option">
                                                    
                                                                                                            <select class="select1" type="file" name="image[]" onchange="Tygh.$.ceAjax('request', 'admin.php?dispatch=promotions.dynamic&amp;zone=catalog&amp;promotion_id=0&amp;prefix=' + escape(this.name) + '&amp;condition=' + this.value + '&amp;elm_id=' + this.id, {result_ids: 'container_' + this.id})" id="add_condition_de7bf1df577693ce860ca182ecca7221_2" name="promotion_data[conditions][conditions][2]">
                                                                                                                <option value=""> -- </option>
                                                                                                                <option value="price">Product price</option>
                                                                                                                <option value="categories">Categories</option>
                                                                                                                <option value="products">Products</option>
                                                                                                                <option value="purchased_products">Purchased products</option>
                                                                                                                <option value="users">Users</option>
                                                                                                                <option value="feature">Product feature</option>
                                                                                                                <option value="usergroup">User group</option>
                                                                                                                <option value="reward_points">Points on user account</option>
                                                                                                            </select>
                                                                                                        </div>-->
                                                    <input type="file" name="" class="select1 addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                            <button><a href="#" onclick="$('#image1').append($('#image input:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More Bonuses</a></button>
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
    $(document).ready(function () {
        $('#editprodf input[type="text"]').each(function () {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#editprodf input[type="hidden"]').each(function () {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#editprodf textarea').each(function () {
            if (typeof $(this).attr('name') != 'undefined')
                $(this).html(datas[$(this).attr('name')]);
        });
        $('#editprodf input[type="checkbox"]').each(function () {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#editprodf input[type="radio"]').each(function () {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#editprodf select').each(function () {
            $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected', 'selected');
        });
    });
</script>