<?php
if (isset($_POST['update'])) {
    $escape = array();
    $sql = "update blog set ";
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

    //    debug($pa);
    //    debug($_FILES);
    //    exit;
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
        echo "<script>alert('Blog Updated');window.location='index.php?p=blog';</script>"; //
        // exit;
    }
}
$sql = "select * from blog where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
?>

<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Blog</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <!--        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" action="" enctype="multipart/form-data">
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
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Name <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="name"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label"
                                                            for="image1">Image:</label>
                                                        <div class="col-md-9">
                                                            <?php
                                                            if (substr($rdata['image1'], -3) == 'png' || substr($rdata['image1'], -3) == 'jpg' || substr($rdata['image1'], -4) == 'jpeg' || substr($rdata['image1'], -3) == 'gif' || substr($rdata['image1'], -3) == 'bmp') {
                                                                echo '<input name="image1" value="' . $rdata['image1'] . '" type="hidden" class="form-control   edit_product_image1 product_image1  " > <img src="../files/' . $rdata['image1'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } elseif ($rdata['image1']) {
                                                                echo '<input name="image1" value="' . $rdata['image1'] . '" type="hidden" class="form-control edit_product_image1 product_image1  " > <a target="_BLANK" href="../files/' . $rdata['image1'] . '" style="width:200px;" >Download ' . $rdata['image1'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } else {
                                                            ?>
                                                            <input type="file" name="image1"
                                                                class="form-control required has-error"
                                                                style="border-radius: 6px;width:350px;">
                                                            <?php } ?>
                                                            <label for="req1" generated="true"
                                                                class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                        <div class="controls"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label"
                                                            for="thumbnail">Thumbnail:</label>
                                                        <div class="col-md-9">
                                                            <?php
                                                            if (substr($rdata['thumbnail'], -3) == 'png' || substr($rdata['thumbnail'], -3) == 'jpg' || substr($rdata['thumbnail'], -4) == 'jpeg' || substr($rdata['thumbnail'], -3) == 'gif' || substr($rdata['thumbnail'], -3) == 'bmp') {
                                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control   edit_product_thumbnail product_thumbnail  " > <img src="../files/' . $rdata['thumbnail'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } elseif ($rdata['thumbnail']) {
                                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control edit_product_thumbnail product_thumbnail  " > <a target="_BLANK" href="../files/' . $rdata['thumbnail'] . '" style="width:200px;" >Download ' . $rdata['thumbnail'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                            } else {
                                                            ?>
                                                            <input type="file" name="thumbnail"
                                                                class="form-control required has-error"
                                                                style="border-radius: 6px;width:350px;">
                                                            <?php } ?>
                                                            <label for="req1" generated="true"
                                                                class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                        <div class="controls"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Description:</label>
                                                        <div class="col-md-10">
                                                            <textarea
                                                                name="description"><?php echo $rdata['description']; ?></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>
                                                            <script>
                                                            tinymce.init({
                                                                selector: 'textarea',
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
                                                                style_formats: [{
                                                                        title: 'Bold text',
                                                                        inline: 'b'
                                                                    },
                                                                    {
                                                                        title: 'Red text',
                                                                        inline: 'span',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Red header',
                                                                        block: 'h1',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Example 1',
                                                                        inline: 'span',
                                                                        classes: 'example1'
                                                                    },
                                                                    {
                                                                        title: 'Example 2',
                                                                        inline: 'span',
                                                                        classes: 'example2'
                                                                    },
                                                                    {
                                                                        title: 'Table styles'
                                                                    },
                                                                    {
                                                                        title: 'Table row 1',
                                                                        selector: 'tr',
                                                                        classes: 'tablerow1'
                                                                    }
                                                                ]
                                                            });
                                                            </script>
                                                            <!--                                                            class for this = "wysiwyg"-->
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Description 2:</label>
                                                        <div class="col-md-10">
                                                            <textarea
                                                                name="description2"><//?php echo $rdata['description2']; ?></textarea>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group has-error">
                                                        <label class="col-md-2 control-label">Comment <span
                                                                class="required">*</span></label>
                                                        <div class="col-md-9"> <input type="text" name="comment"
                                                                class="form-control required has-error"
                                                                style="border-radius: 6px;">
                                                            <label for="req1" generated="true"
                                                                class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Date <span
                                                                class="required">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="startdate"
                                                                class="form-control required has-error datepicker"
                                                                style="width: 150px;border-radius: 6px;"><label
                                                                for="req1" generated="true" class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Open in new window<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a">
                                                                <input type="checkbox" name="status" id="elm_product_status_0_a"  value="A"></label>

                                                        </div>
                                                    </div>-->
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span
                                                                class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    checked="checked" value="Active">Active</label>



                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    value="Disable">Disabled</label>
                                                        </div>
                                                    </div>
                                                    <!--                                                <div class="form-group has-error" >
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Pos. <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;width:250px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>-->
                                                    <!--                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_category_default_layout">Type</label>
                                                        <div class="controls">
                                                            <select class="select1" id="elm_category_default_layout" class="cm-combo-select cm-toggle-element" name="defaultcategory">
                                                                <option value="products_multicolumns">Graphic banner</option>
                                                                <option value="products_without_options">Text banner</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border-top:none;">



                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Image:</label>
                                                        <div class="col-md-10">
                                                            <input type="file" name="image" class="form-control required has-error">               
                                                        </div>
                                                    </div>


                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Open in new window<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a">
                                                                <input type="checkbox" name="status" id="elm_product_status_0_a"  value="A"></label>

                                                        </div>
                                                    </div>

                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">URl: <span class="required">*</span></label> 
                                                        <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Creation Date <span class="required">*</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="startdate" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="A">Active</label>
                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="H">Hidden</label>
                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Disabled</label>
                                                        </div>
                                                    </div>
                                                </div>-->
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
            <input type="submit" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;"
                name="update" />
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
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
        $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected',
            'selected');
    });
});
</script>
<script type="text/javascript">
var data = CKEDITOR.instances['body'].getData();
CKEDITOR.replace('description');
</script>
<script src="tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea',
    theme: "modern",
    width: '100%',
    height: 300,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    style_formats: [{
            title: 'Bold text',
            inline: 'b'
        },
        {
            title: 'Red text',
            inline: 'span',
            styles: {
                color: '#ff0000'
            }
        },
        {
            title: 'Red header',
            block: 'h1',
            styles: {
                color: '#ff0000'
            }
        },
        {
            title: 'Example 1',
            inline: 'span',
            classes: 'example1'
        },
        {
            title: 'Example 2',
            inline: 'span',
            classes: 'example2'
        },
        {
            title: 'Table styles'
        },
        {
            title: 'Table row 1',
            selector: 'tr',
            classes: 'tablerow1'
        }
    ]
});
</script>