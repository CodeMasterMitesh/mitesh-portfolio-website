<?php
if (isset($_POST['update'])) {
    $escape = array();
    $sql = "update about set";
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
                    $dd .= "'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                } else
                    $dd .= "'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
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
        echo "<script>alert('about Updated');window.location='index.php?p=about'; </script>"; //
    }
}
$sql = "select * from about where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if (isset($_GET['del'])) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update page set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('about Updated'); window.location='index.php?p=editabout&id=" . $_GET['id'] . "';</script>";
}
?>

<div class="tabbable tabbable-custom" style="margin: 2px;">
    <form class="form-horizontal row-border" id="validate-1" method="post" action="" novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne"> Edit About </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <table id="table">
                                            <tbody>
                                                <!-- <tr> -->
                                                <!-- <td> 
                                                        <label style="width:125px;"> Product:</label>   
                                                            <//?php echo getoptn("pid", "name", "id", "products", "select1", "", "", "") ?>
                                                    </td> -->
                                                <!-- <td>
                                                        <label style="width:125px;">Date:</label>
                                                        <input class="select1" type="text" name="aboutdate"
                                                            class="medium" class="form-control datepicker"
                                                            autocomplete="off">
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <!-- <td>  
                                                        <label style="width:125px;"> Status:</label>
                                                        <select name="status" class="select1 ">
                                                            <option value="Pending">Pending</option>
                                                            <option value="Approved">Approved</option>
                                                        </select>
                                                    </td> -->
                                                    <td>

                                                        <label style="width:125px;">Heading:</label>
                                                        <input class="select1" type="text" name="name" class="medium"
                                                            autocomplete="off">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <!-- <td>  
                                                        <label style="width:125px;"> Email:</label>
                                                       <input class="select1"  type="text" name="email" class="medium" autocomplete="off">
                                               
                                                    </td> -->
                                                    <!-- <td>

                                                        <label style="width:125px;">Rating:</label>   
                                                        <input class="select1"  type="text" name="rating" class="medium" autocomplete="off">
                                                    </td> -->
                                                </tr>

                                                <tr>
                                                    <td colspan="2">
                                                        <label style="width:125px;">Description</label>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div style="clear:both"></div>
                                                        <textarea name="description" cols="50"
                                                            style="width:100%"><?php echo $rdata['description']; ?></textarea>


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group has-error" style="border:none;">
                                                            <div class="control-group">

                                                            </div>
                                                        </div>
                                                        <label class="col-md-2 control-label" for="image">Customer
                                                            Image:</label>
                                                        <div class="col-md-9">
                                                            <?php
                                                            if (
                                                                substr($rdata['image'], -3) == 'png' || substr($rdata['image'], -3) == 'jpg' || substr($rdata['image'], -4) == 'jpeg' || substr($rdata['image'], -3) == 'gif' || substr($rdata['image'], -3) == 'bmp'
                                                                || substr($rdata['image'], -3) == 'svg' || substr($rdata['image'], -3) == 'SVG'
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
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

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
<script src="tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea',
    theme: "modern",
    width: '100%',
    height: 300,
    plugins: [
        "advlist autolink link image lists charmap print pabout hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print pabout media fullpage | forecolor backcolor emoticons",
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