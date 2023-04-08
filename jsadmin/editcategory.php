<?php
if (isset($_POST['update'])) {
    $escape = array();
    $sql = "update category set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit') {
            if (is_array($b['name'])) {
                $dd = '`' . $a . '`=';
                $b['name'] = array_unique(array_values(array_filter($b['name'])));
                $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
                for ($i = 0; $i < count($b['name']); $i++) {
                    $b['name'][$i] = time() . '-' . $b['name'][$i];
                    move_uploaded_file($b['tmp_name'][$i], '../productimages/' . $b['name'][$i]);
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
                move_uploaded_file($b['tmp_name'], '../productimages/' . $b['name']);
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
        echo "<script>alert('Category Updated'); </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from category where id=" . $_GET['id'];
$q = mysql_query($sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if (isset($_GET['del'])) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update category set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Category Updated'); window.location='index.php?p=category&id=" . $_GET['id'] . "';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Category</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <!-- <li class=""><a href="#tab_1_2" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Layout</a></li> -->
        <!--        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" action="" novalidate="novalidate"
        enctype="multipart/form-data">
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
                                                    <label class="col-md-2 control-label">Product Name <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <?php echo getoptn('product', 'name', 'id', 'products', 'select1', 'id="select"', $rdata['product'], 'None'); ?><label
                                                            for="req1" generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Name <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="name"
                                                            value="<?php echo $rdata['name'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Parameters <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="parameters"
                                                            value="<?php echo $rdata['parameters'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Name Tag <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="tag"
                                                            value="<?php echo $rdata['tag'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <!-- <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Header <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="header"
                                                            value="<?php echo $rdata['header'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div> -->
                                                <!-- <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Parent <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="parent"
                                                            value="<?php echo $rdata['header'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div> -->
                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span
                                                                class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    checked="checked" value="A">Active</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="status" id="elm_product_status_0_h"
                                                                    value="H">Hidden</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    value="D">Disabled</label>
                                                        </div>
                                                    </div>
                                                    <!--                                                   <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner1:</label>
                                                        <div class="col-md-9">
                                                             <?php if (file_exists('../productimages/' . $rdata['banner1']) && $rdata['banner1']) {
                                                                ?>
                                                <div>
                                                    <img src="../productimages/<?php echo $rdata['banner1']; ?>"/>
                                                    <a href="index.php?p=editcategory&id=<?php echo $rdata['id']; ?>&del=banner1">Delete</a>
                                                    <input type="hidden" name="banner1"  value="<?php echo $rdata['banner1']; ?>"/> 
                                                </div>
                                            <?php } else {
                                            ?>
                                                <input type="file" name="banner1" class="form-control required has-error" value="<?php echo $rdata['banner1']; ?>"/>
                                            <?php } ?>               
                                                        </div>
                                                    </div>-->
                                                    < <!--!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner2:</label>
                                                        <div class="col-md-9">
                                                            <?php if (file_exists('../productimages/' . $rdata['banner2']) && $rdata['banner2']) {
                                                            ?>
                                                            <div>
                                                                <img
                                                                    src="../productimages/<?php echo $rdata['banner2']; ?>" />
                                                                <a
                                                                    href="index.php?p=editcategory&id=<?php echo $rdata['id']; ?>&del=banner2">Delete</a>
                                                                <input type="hidden" name="banner2"
                                                                    value="<?php echo $rdata['banner2']; ?>" />
                                                            </div>
                                                            <?php } else {
                                                            ?>
                                                            <input type="file" name="banner2"
                                                                class="form-control required has-error"
                                                                value="<?php echo $rdata['banner2']; ?>" />
                                                            <?php } ?>
                                                        </div>
                                                </div>-->
                                                <!--                                                     <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner3:</label>
                                                        <div class="col-md-9">
                                                             <?php if (file_exists('../productimages/' . $rdata['banner3']) && $rdata['banner3']) {
                                                                ?>
                                                <div>
                                                    <img src="../productimages/<?php echo $rdata['banner3']; ?>"/>
                                                    <a href="index.php?p=editcategory&id=<?php echo $rdata['id']; ?>&del=banner3">Delete</a>
                                                    <input type="hidden" name="banner3"  value="<?php echo $rdata['banner3']; ?>"/> 
                                                </div>
                                            <?php } else {
                                            ?>
                                                <input type="file" name="banner3" class="form-control required has-error" value="<?php echo $rdata['banner3']; ?>"/>
                                            <?php } ?>               
                                                        </div>
                                                    </div>-->

                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">Image:</label>
                                                    <div class="col-md-9">
                                                        <?php
                                                        if (substr($rdata['image'], -3) == 'png' || substr($rdata['image'], -3) == 'jpg' || substr($rdata['image'], -4) == 'jpeg' || substr($rdata['image'], -3) == 'gif' || substr($rdata['image'], -3) == 'bmp') {
                                                            echo '<input name="image" value="' . $rdata['image'] . '" type="hidden" class="form-control   edit_dealer_image dealer_image  " > <img src="../productimages/' . $rdata['image'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                        } elseif ($rdata['image']) {
                                                            echo '<input name="image" value="' . $rdata['image'] . '" type="hidden" class="form-control edit_dealer_image dealer_image  " > <a target="_BLANK" href="../productimages/' . $rdata['image'] . '" style="width:200px;" >Download ' . $rdata['image'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                        } else {
                                                        ?>
                                                        <input type="file" name="image"
                                                            class="form-control required has-error">
                                                        <?php } ?>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">Thumbnail:</label>
                                                    <div class="col-md-9">
                                                        <?php
                                                        if (substr($rdata['thumbnail'], -3) == 'png' || substr($rdata['thumbnail'], -3) == 'jpg' || substr($rdata['thumbnail'], -4) == 'jpeg' || substr($rdata['thumbnail'], -3) == 'gif' || substr($rdata['thumbnail'], -3) == 'bmp') {
                                                            echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control   edit_dealer_thumbnail dealer_thumbnail  " > <img src="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                        } elseif ($rdata['thumbnail']) {
                                                            echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control edit_dealer_thumbnail dealer_thumbnail  " > <a target="_BLANK" href="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" >Download ' . $rdata['thumbnail'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                                        } else {
                                                        ?>
                                                        <input type="file" name="thumbnail"
                                                            class="form-control required has-error">
                                                        <?php } ?>
                                                    </div>
                                                </div> -->

                                                <!--                                                     <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Image:</label>
                                                        <div class="col-md-9">
                                                             <?php if (file_exists('../productimages/' . $rdata['image']) && $rdata['image']) {
                                                                ?>
                                                <div>
                                                    <img src="../productimages/<?php echo $rdata['image']; ?>"/>
                                                    <a href="index.php?p=editcategory&id=<?php echo $rdata['id']; ?>&del=image">Delete</a>
                                                    <input type="hidden" name="image"  value="<?php echo $rdata['image']; ?>"/> 
                                                </div>
                                            <?php } else {
                                            ?>
                                                <input type="file" name="image" class="form-control required has-error" value="<?php echo $rdata['image']; ?>"/>
                                            <?php } ?>               
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Thumbnail:</label>
                                                        <div class="col-md-9">
                                                             <?php if (file_exists('../productimages/' . $rdata['thumbnail']) && $rdata['thumbnail']) {
                                                                ?>
                                                <div>
                                                    <img src="../productimages/<?php echo $rdata['thumbnail']; ?>"/>
                                                    <a href="index.php?p=editcategory&id=<?php echo $rdata['id']; ?>&del=thumbnail">Delete</a>
                                                    <input type="hidden" name="thumbnail"  value="<?php echo $rdata['thumbnail']; ?>"/> 
                                                </div>
                                            <?php } else {
                                            ?>
                                                <input type="file" name="thumbnail" class="form-control required has-error" value="<?php echo $rdata['thumbnail']; ?>"/>
                                            <?php } ?>               
                                                        </div>
                                                    </div>-->
                                                <!--                                                     <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Thumbnail:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="thumbnail" class="form-control required has-error">               
                                                        </div>
                                                    </div>-->
                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">Start Price:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="pricestart"
                                                            value="<?php echo $rdata['pricestart'] ?>"
                                                            class="form-control required has-error">
                                                    </div> -->
                                                <!-- </div> -->
                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">End Price:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="priceend"
                                                            value="<?php echo $rdata['priceend'] ?>"
                                                            class="form-control required has-error">
                                                    </div>
                                                </div> -->
                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">No.Of Products:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="noofproducts"
                                                            value="<?php echo $rdata['noofproducts'] ?>"
                                                            class="form-control required has-error">
                                                    </div>
                                                </div> -->
                                                <!-- <div class="form-group" style="border-top:none;">
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label"> Subcat Image<span
                                                                class="required">*</span></label>
                                                        <div class="col-md-9">
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="islistsubcatimg" id="elm_product_status_0_a"
                                                                    value="Y"
                                                                    <?php if ($rdata['islistsubcatimg'] == 'Y') echo 'checked'; ?>>
                                                                Yes</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="islistsubcatimg" id="elm_product_status_0_h"
                                                                    value="H"
                                                                    <?php if ($rdata['islistsubcatimg'] == 'H') echo 'checked'; ?>>No</label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseOne"> SEO / Meta data </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body">
                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">
                                            <div class="form-group has-error">
                                                <div class="control-group">
                                                    <label class="col-md-2 control-label"
                                                        for="elm_category_page_title">Page title&nbsp;<a
                                                            class="cm-tooltip"><i
                                                                class="icon-question-sign"></i></a>:</label>
                                                    <div class="col-md-9"> <input type="text" name="metatitle"
                                                            value="<?php echo $rdata['metatitle'] ?>"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label class="col-md-2 control-label"
                                                        for="elm_category_meta_description">Meta description:</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control required has-error"
                                                            style="border-radius: 6px;" name="metadescri"
                                                            id="elm_category_meta_description" cols="55" rows="4"
                                                            class="input-large"><?php echo $rdata['metadescri'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label class="col-md-2 control-label"
                                                        for="elm_category_meta_description">Meta keywords:</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control required has-error"
                                                            style="border-radius: 6px;" name="metakeyword"
                                                            id="elm_category_meta_description" cols="55" rows="4"
                                                            class="input-large"><?php echo $rdata['metakeyword'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="tab-pane" id="tab_1_2">
            <div class="widget">
                <div class="panel panel-default">
                    <div class="panel-heading toolbar">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                data-parent="#accordion" href="#collapseOne"> Age verification </a> </h3>
                        <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i
                                    class="icon-angle-down"></i></span> </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body">


                            <div class="widget box" style="border:none;">
                                <div class="widget-content">

                                    <div class="form-group has-error">

                                        <div class="control-group">
                                            <label for="age_verification" class="col-md-2 control-label">Age
                                                verification:</label>
                                            <div class="col-md-9">
                                                <span class="checkbox">
                                                    <input type="checkbox" id="age_verification" name="ageverification"
                                                        value="<?php echo $rdata['ageverification'] ?>">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-error" style="border-top:none;">
                                        <div class="control-group">
                                            <label for="age_limit" class=" col-md-2 control-label">Age limit:</label>
                                            <div class="col-md-9">
                                                <input class="form-control required has-error"
                                                    style="border-radius: 6px;width:200px;" type="text" id="age_limit"
                                                    name="agelimit" size="10" maxlength="2"
                                                    value="<?php echo $rdata['agelimit'] ?>" class="input-micro">
                                                <span class="year"> &nbsp; years</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-error" style="border-top:none;">
                                        <div class="control-group">
                                            <label for="age_warning_message" class="col-md-2 control-label">Warning
                                                message:</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control required has-error"
                                                    style="border-radius: 6px;width:300px;" id="age_warning_message"
                                                    name="warningmessage" cols="55"
                                                    rows="4"><?php echo $rdata['warningmessage'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                data-parent="#accordion" href="#collapseOne">Comments and reviews </a> </h3>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body">
                            <div class="widget box" style="border:none;">
                                <div class="widget-content">
                                    <div class="form-group has-error">
                                        <div class="controls">
                                            <div class="control-group cm-no-hide-input">
                                                <label class="col-md-2 control-label"
                                                    for="discussion_type">Reviews:</label>
                                                <div class="controls">
                                                    <select class="select1" name="reviews" id="discussion_type">
                                                        <option value="B">Communication and Rating</option>
                                                        <option value="C">Communication</option>
                                                        <option value="R">Rating</option>
                                                        <option selected="selected" value="D">Disabled</option>
                                                    </select>
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
        <div class="tab-pane" id="tab_1_3">
            <div class="widget">
                <div class="panel panel-default">
                    <div class="panel-heading toolbar">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                data-parent="#accordion" href="#collapseOne"> Age verification </a> </h3>
                        <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i
                                    class="icon-angle-down"></i></span> </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body">
                            <div class="widget box" style="border:none;">
                                <div class="widget-content">
                                    <div class="form-group has-error">
                                        <div class="control-group">
                                            <label class="col-md-2 control-label"
                                                for="elm_category_product_layout">Product details layout&nbsp;<a
                                                    class="cm-tooltip"
                                                    title="By default, the template that is defined in the appearance settings of the storefront is used"><i
                                                        class="icon-question-sign"></i></a>:</label>
                                            <div class="col-md-9">
                                                <select class="select1" id="elm_category_product_layout"
                                                    name="productdetail">
                                                    <option value="default">Parent (Default template)</option>
                                                    <option value="default_long_options_template">Default template (long
                                                        product option names)</option>
                                                    <option value="default_template">Default template</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-error" style="border:none;">
                                        <div class="control-group">
                                            <label for="age_verification" class="col-md-2 control-label">Use custom
                                                layout:</label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="customlayout" value="N">
                                                <span class="checkbox">
                                                    <input type="checkbox" id="age_verification" name="customlayout"
                                                        value="Y"
                                                        <?php if ($rdata['customlayout'] == 'Y') echo 'checked'; ?>>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-error" style="border-top:none;">
                                        <div class="control-group">
                                            <label for="age_limit" class=" col-md-2 control-label">Product
                                                columns:</label>
                                            <div class="col-md-9">
                                                <input class="form-control required has-error"
                                                    style="border-radius: 6px;width:200px;" type="text" id="age_limit"
                                                    name="productcolumn" size="10" maxlength="2" class="input-micro">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-error" style="border:none;">
                                        <label class="col-md-2 control-label">Available layouts:</label>
                                        <div class="controls" style="float:left;">
                                            <label class="radio inline" for="elm_product_status_0_a"><input
                                                    type="checkbox" name="availablelayout" id="elm_product_status_0_a"
                                                    value="A"
                                                    <?php if ($rdata['availablelayout'] == 'A') echo 'checked'; ?>>Grid</label>
                                            <label class="radio inline" for="elm_product_status_0_h"><input
                                                    type="checkbox" name="availablelayout" id="elm_product_status_0_h"
                                                    value="H"
                                                    <?php if ($rdata['availablelayout'] == 'H') echo 'checked'; ?>>List
                                                without options</label>
                                            <label class="radio inline" for="elm_product_status_0_d"><input
                                                    type="checkbox" name="availablelayout" id="elm_product_status_0_d"
                                                    value="D"
                                                    <?php if ($rdata['availablelayout'] == 'D') echo 'checked'; ?>>Compact
                                                list</label>
                                        </div>
                                    </div>
                                    <div class="form-group has-error" style="border:none;">
                                        <div class="control-group">
                                            <label class="col-md-2 control-label"
                                                for="elm_category_default_layout">Default category layout:</label>
                                            <div class="controls">
                                                <select class="select1" id="elm_category_default_layout"
                                                    class="cm-combo-select cm-toggle-element" name="defaultcategory">
                                                    <option value="products_multicolumns">Grid</option>
                                                    <option value="products_without_options">List without options
                                                    </option>
                                                    <option value="short_list">Compact list</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</div>
<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
    <input type="submit" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update"
        value="Update" />
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