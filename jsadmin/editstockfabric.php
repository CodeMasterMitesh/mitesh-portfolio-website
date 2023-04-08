<!--<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $weight = $_POST['weight'];
    $scprice = $_POST['scprice'];
    $mprice = $_POST['mprice'];
    $kgprice = $_POST['kgprice'];
    
    $filename = $_FILES["thumbnail"]["name"];
    $tempname = $_FILES["thumbnail"]["tmp_name"];   
    $folder = "../productimages/".$filename;
    
    move_uploaded_file($tempname, $folder);
    
    $sql = "UPDATE products SET name='".$name."', weight='".$weight."', scprice='".$scprice."', meterprice='".$mprice."', kgprice='".$kgprice."', thumbnail='".$filename."' WHERE id=" . $_GET['id'];
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    $pid = $_GET['id'];
    if ($q) {
        $j=$i;
        echo "<script>alert('Product Updated');window.location='index.php?p=stockfabric';</script>"; //window.location='index.php?p=searchproduct';
    }
    
}
?> 
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Fabric Stock Products</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <form class="form-horizontal row-border" id="editprodf" method="post"  action="" enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane active">
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
                                                    <?php 
                                                        $sql = "select * from products where id=" . $_GET['id'];
                                                        $q = mysql_query($sql);
                                                        $r = mysql_fetch_array($q);
                                                    ?>
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" value="<?php echo $r['name'] ?>" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">Weight <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="weight" class="form-control required has-error" value="<?php echo $r['weight'] ?>" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">Swatches Card Price <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="scprice" class="form-control required has-error" value="<?php echo $r['scprice'] ?>" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">Meter Price <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="mprice" class="form-control required has-error" value="<?php echo $r['meterprice'] ?>" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">KG Price <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="kgprice" class="form-control required has-error" value="<?php echo $r['kgprice'] ?>" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>



                            <div class="panel panel-default" style="margin-left: -5px;">
                                
                                
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Image  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div id="acc_images" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="thumbnail">Thumbnail:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['thumbnail'], -3) == 'png' || substr($rdata['thumbnail'], -3) == 'jpg' || substr($rdata['thumbnail'], -4) == 'jpeg' || substr($rdata['thumbnail'], -3) == 'gif' || substr($rdata['thumbnail'], -3) == 'bmp') {
                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control   edit_product_thumbnail product_thumbnail  " > <img src="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['thumbnail']) {
                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control edit_product_thumbnail product_thumbnail  " > <a target="_BLANK" href="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" >Download ' . $rdata['thumbnail'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="thumbnail" class="form-control required has-error" value="<?php echo $r['thumbnail'] ?>" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            
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

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update" value="Update"/>

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
    
     function getsubcategory(d) {
        $.ajax({
            url: 'ajax/getsubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.name').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.name').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.name').html(str);
            }

        });
    }

 function getsupersubcategory(d) {
        $.ajax({
            url: 'ajax/supersubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.gname').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.gname').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.gname').html(str);
            }

        });
    }
</script>-->

<?php
if (isset($_POST['update'])) {
    $sql = "update products set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit' && substr($a, 0, 12) != 'productsize_') {
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
                    $dd.="'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                } else
                    $dd.="'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], '../productimages/' . $b['name']);
                $dd.="'" . $b['name'] . "'";
                $escape[] = $a;
            }
            $pa[] = $dd;
        }
    }

    foreach ($_POST as $a => $b) {
        if ($a != 'update' && !in_array($a, $escape) && substr($a, 0, 12) != 'productsize_') {
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
        $sql1 = "delete from productsize where productid=" . $pid;
        $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);

        for ($i = 0; $i < count($_POST['productsize_size']); $i++) {
            if ($_POST['productsize_size'][$i]) {
                $sql1 = "insert into productsize (`productid`,`size`,`price`)
                values('" . $pid . "','" . $_POST['productsize_size'][$i] . "','" . $_POST['productsize_price'][$i] . "')";
                $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
            }
        }
        $j=$i;
        echo "<script>alert('Product Updated');window.location='index.php?p=stockfabric';</script>"; //window.location='index.php?p=searchproduct';
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
    echo "<script>alert('Product Updated'); window.location='index.php?p=stockfabric';</script>";
}
?> 
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Products <a href="html.php?id=<?php echo $rdata['id'] ?>"  class="btn btn-primary btn-primary " target="_BLANK" >Html Page</a></h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
         <li class=""><a href="#tab_1_2" data-toggle="tab">Size</a></li> 
        <!--<li class=""><a href="#tab_1_2" data-toggle="tab">Media</a></li>     
        <li class=""><a href="#tab_1_3" data-toggle="tab">Quantity discounts</a></li>
        <li class=""><a href="#tab_1_4" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_5" data-toggle="tab">Option</a></li>
        <li class=""><a href="#tab_1_6" data-toggle="tab">SEO/Meta data</a></li>-->

        <!--<li class=""><a href="#tab_1_5" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="editprodf" method="post"  action="" enctype="multipart/form-data">
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
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Categories <span class="required">*</span></label> 
                                                    <div class="col-md-2"> 
                                                        <?php echo getoptn('category', 'name', 'id', 'category', 'select1', ' id="select" onchange="getsubcategory($(this))" ', "", 'None',"where parent=0"); ?>
                                                       
                                                        <!--<input type="hidden" id="e21"  style="width:300px;" tabindex="-1" class="select2-offscreen" value="<?php // echo $rdata['subcatid']; ?>">-->

                                                        <!--<input type="hidden" id="e15" style="width:300px;" value="red,cyan,green,orange" tabindex="-1" class="select2-offscreen">-->


                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>
                                                </div>
                                                
                                                    
                                                    <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Sub Categories <span class="required">*</span></label> 
                                                    <div class="col-md-2" id="subcategory">
                                                        <?php 
                                                            $sql2 = "select * from category where id='" . $rdata['subcategory']."'";
                                                            $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);
                                                            $r2 = mysql_fetch_assoc($q2);
//                                                            debug($r2);
                            
                                                        ?>
                                                        <select name="subcategory" class="form-control name" onchange="getsupersubcategory($(this))" '>
                                                                <option value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                                                        </select>
                                                        
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>
                                                            
                                                </div>

                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Sub Categories <span class="required">*</span></label> 
                                                    <div class="col-md-2" id="subcategory">
                                                        <?php 
                                                            $sql2 = "select * from category where id='" . $rdata['supersubcategory']."'";
                                                            $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);
                                                            $r2 = mysql_fetch_assoc($q2);
//                                                            debug($r2);
                            
                                                        ?>
                                                        <select name="supersubcategory" class="form-control gname">
                                                                <option value="<?php echo $r2['id']; ?>"><?php echo $r2['name']; ?></option>
                                                        </select>
                                                        
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>
                                                            
                                                </div>
  
                                                 


                                                   
                                                 
                                                
                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Detail:</label>
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
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="Active">Active</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="Hidden">Hidden</label>


                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="Disable">Disabled</label>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>



                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Is Available<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isavailable" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isavailable" id="elm_product_status_0_h" value="No">No</label>


                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Arrival<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
<!--                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isavailable" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isavailable" id="elm_product_status_0_h" value="No">No</label>-->

                                                                <select class="form-control" style="width: 70px;" name="arrival" >
                                                                    <option>yes</option>
                                                                    <option>no</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group" style="border-top:none; margin-top: 10px;" >
                                                        <label class="col-md-2 control-label">Item Code <span class="required">*</span></label> 
                                                        <div class="col-md-9"> <input type="text" name="itemcode" class="form-control required has-error" style="border-radius: 6px; width: 50px;">
                                                            <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>



                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Pricing / inventory  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">

                                                <div id="acc_pricing_inventory" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group"  >
                                                            <label class="col-md-2 control-label" for="elm_product_code">CODE:</label>
                                                            <div class="col-md-9"> <input type="text" name="code" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                            <div class="controls">
                                                            </div>
                                                        </div>
                                                    </div>
<!--                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_in_stock">In stock:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="text" name="instock" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>            
                                                        </div>
                                                    </div>-->
                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_min_qty"> quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="qty" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_min_qty">Minimum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="minqty" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_max_qty">Maximum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="maxqty" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="price" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>-->

                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">Swatches Card Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="scprice" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">1 Meter Card Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="meterprice" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">1 Kilogram Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="kgprice" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="discount">Discount Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="discount" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="vat">VAT:</label>
                                                            <div class="col-md-9"> <input type="text" name="vat" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label">Taxes:</label>
                                                            <div class="controls">
                                                                <input type="hidden" name="taxes" value="">

                                                                <label class="col-md-2 control-label" for="elm_taxes_6">
                                                                    <input type="checkbox" name="taxes" id="elm_taxes_6" value="6">
                                                                    VAT</label>
                                                            </div>
                                                        </div>
                                                        <label class="col-md-2 control-label">Is Taxable<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="istaxable" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="istaxable" id="elm_product_status_0_h" value="No">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label">Is Features<span class="required">*</span></label>
                                                            <div class="controls" style="float:left;">
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isfeatures" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isfeatures" id="elm_product_status_0_h" value="No">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Images  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div id="acc_images" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="thumbnail">Thumbnail:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['thumbnail'], -3) == 'png' || substr($rdata['thumbnail'], -3) == 'jpg' || substr($rdata['thumbnail'], -4) == 'jpeg' || substr($rdata['thumbnail'], -3) == 'gif' || substr($rdata['thumbnail'], -3) == 'bmp') {
                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control   edit_product_thumbnail product_thumbnail  " > <img src="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['thumbnail']) {
                                                echo '<input name="thumbnail" value="' . $rdata['thumbnail'] . '" type="hidden" class="form-control edit_product_thumbnail product_thumbnail  " > <a target="_BLANK" href="../productimages/' . $rdata['thumbnail'] . '" style="width:200px;" >Download ' . $rdata['thumbnail'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="thumbnail" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image1">Image 1:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image1'], -3) == 'png' || substr($rdata['image1'], -3) == 'jpg' || substr($rdata['image1'], -4) == 'jpeg' || substr($rdata['image1'], -3) == 'gif' || substr($rdata['image1'], -3) == 'bmp') {
                                                echo '<input name="image1" value="' . $rdata['image1'] . '" type="hidden" class="form-control   edit_product_image1 product_image1  " > <img src="../productimages/' . $rdata['image1'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image1']) {
                                                echo '<input name="image1" value="' . $rdata['image1'] . '" type="hidden" class="form-control edit_product_image1 product_image1  " > <a target="_BLANK" href="../productimages/' . $rdata['image1'] . '" style="width:200px;" >Download ' . $rdata['image1'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image1" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image2">Image 2:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image2'], -3) == 'png' || substr($rdata['image2'], -3) == 'jpg' || substr($rdata['image2'], -4) == 'jpeg' || substr($rdata['image2'], -3) == 'gif' || substr($rdata['image2'], -3) == 'bmp') {
                                                echo '<input name="image2" value="' . $rdata['image2'] . '" type="hidden" class="form-control   edit_product_image2 product_image2  " > <img src="../productimages/' . $rdata['image2'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image2']) {
                                                echo '<input name="image2" value="' . $rdata['image2'] . '" type="hidden" class="form-control edit_product_image2 product_image2  " > <a target="_BLANK" href="../productimages/' . $rdata['image2'] . '" style="width:200px;" >Download ' . $rdata['image2'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image2" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image3">Image 3:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image3'], -3) == 'png' || substr($rdata['image3'], -3) == 'jpg' || substr($rdata['image3'], -4) == 'jpeg' || substr($rdata['image3'], -3) == 'gif' || substr($rdata['image3'], -3) == 'bmp') {
                                                echo '<input name="image3" value="' . $rdata['image3'] . '" type="hidden" class="form-control   edit_product_image3 product_image3  " > <img src="../productimages/' . $rdata['image3'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image3']) {
                                                echo '<input name="image3" value="' . $rdata['image3'] . '" type="hidden" class="form-control edit_product_image3 product_image3  " > <a target="_BLANK" href="../productimages/' . $rdata['image3'] . '" style="width:200px;" >Download ' . $rdata['image3'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image3" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image4">Image 4:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image4'], -3) == 'png' || substr($rdata['image4'], -3) == 'jpg' || substr($rdata['image4'], -4) == 'jpeg' || substr($rdata['image4'], -3) == 'gif' || substr($rdata['image4'], -3) == 'bmp') {
                                                echo '<input name="image4" value="' . $rdata['image4'] . '" type="hidden" class="form-control   edit_product_image4 product_image4  " > <img src="../productimages/' . $rdata['image4'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image4']) {
                                                echo '<input name="image4" value="' . $rdata['image4'] . '" type="hidden" class="form-control edit_product_image4 product_image4  " > <a target="_BLANK" href="../productimages/' . $rdata['image4'] . '" style="width:200px;" >Download ' . $rdata['image4'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image4" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image5">Image 5:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image5'], -3) == 'png' || substr($rdata['image5'], -3) == 'jpg' || substr($rdata['image5'], -4) == 'jpeg' || substr($rdata['image5'], -3) == 'gif' || substr($rdata['image5'], -3) == 'bmp') {
                                                echo '<input name="image5" value="' . $rdata['image5'] . '" type="hidden" class="form-control   edit_product_image5 product_image5  " > <img src="../productimages/' . $rdata['image5'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image5']) {
                                                echo '<input name="image5" value="' . $rdata['image5'] . '" type="hidden" class="form-control edit_product_image5 product_image5  " > <a target="_BLANK" href="../productimages/' . $rdata['image5'] . '" style="width:200px;" >Download ' . $rdata['image5'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image5" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image6">Image 6:</label>
                                                            <div class="col-md-9"> 
                                                                <?php
                                            if (substr($rdata['image6'], -3) == 'png' || substr($rdata['image6'], -3) == 'jpg' || substr($rdata['image6'], -4) == 'jpeg' || substr($rdata['image6'], -3) == 'gif' || substr($rdata['image6'], -3) == 'bmp') {
                                                echo '<input name="image6" value="' . $rdata['image6'] . '" type="hidden" class="form-control   edit_product_image6 product_image6  " > <img src="../productimages/' . $rdata['image6'] . '" style="width:200px;" /> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } elseif ($rdata['image6']) {
                                                echo '<input name="image6" value="' . $rdata['image6'] . '" type="hidden" class="form-control edit_product_image6 product_image6  " > <a target="_BLANK" href="../productimages/' . $rdata['image6'] . '" style="width:200px;" >Download ' . $rdata['image6'] . '</a> <br/> <a onclick="$(this).parent().find(\'input\').attr(\'type\',\'file\');$(this).parent().find(\'img,a\').remove()">Delete</a>';
                                            } else {
                                                ?>
                                                                <input type="file" name="image6" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <?php } ?>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
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
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <style>
                            table th{
                                    background: #4d7496;
                                    color: white;
                                    padding: 10px;
                            }
                        </style>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group">
                                            <table style="width:100%" id="imgtable">
                                                <thead>
                                                    <tr>
                                                        <th>Size</th>
                                                        <!--<th>Price</th>-->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $flag=0;
                                                    $sql1="select * from productsize where productid='".$_GET['id']."'";
                                                    $q1=mysql_query($sql1) or die(mysql_error().$sql1);
                                                    while($r1=mysql_fetch_assoc($q1)){
                                                    $flag=1;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                        <?php echo getoptn('productsize_size[]', 'size', 'id', 'sizemaster', 'form-control', '', $r1['size'], ''); ?>
                                                        </td>
                                                        <!--<td><input type="text" name="productsize_price[]"  class="form-control" value="<?php echo $r1['price']?>" /></td>-->
                                                        
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                    $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                    <?php }if($flag!=1){?>
                                                     <tr>
                                                        <td>
                                                        <?php echo getoptn('productsize_size[]', 'size', 'id', 'sizemaster', 'form-control', '', '', 'None'); ?>
                                                        </td>
                                                        <td><input type="text" name="productsize_price[]" value="" class="form-control" /></td>
                                                        
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                    $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <button><a href="#" onclick="$('#imgtable tbody').append($('#imgtable tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">Add More</a></button>
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

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update" value="Update"/>

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
    
     function getsubcategory(d) {
        $.ajax({
            url: 'ajax/getsubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.name').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.name').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.name').html(str);
            }

        });
    }

 function getsupersubcategory(d) {
        $.ajax({
            url: 'ajax/supersubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.gname').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.gname').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.gname').html(str);
            }

        });
    }
</script>
