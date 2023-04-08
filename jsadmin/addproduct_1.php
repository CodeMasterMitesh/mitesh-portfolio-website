<?php
if (isset($_POST['submit'])) {
    $sql = "insert into products (`";
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
        if ($a != 'submit' && substr($a, 0, 8) != 'prodimg_' && substr($a, 0, 7) != 'option_') {
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
    $pid = mysql_insert_id();
    if ($q) {
//        $sql1 = "delete from productimages where pid=" . $pid;
//        $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
        for ($i = 0; $i < count($_FILES['prodimg_name']['name']); $i++) {
            if ($_FILES['prodimg_name']['name'][$i]) {
                $filename = time() . "-" . $_FILES['prodimg_name']['name'][$i];
                move_uploaded_file($_FILES['prodimg_name']['tmp_name'][$i], '../catalog/' . $filename);
                echo $sql3 = "insert into productimages (`pid`,`name`,`alttext`,`position`)
                values('" . $pid . "','" . $filename . "','" . $_POST['prodimg_alttext'][$i] . "','" . $_POST['prodimg_position'][$i] . "')";
                exit;
                $q3 = mysql_query($sql3) or die(mysql_error() . $sql3);
            }
        }
//        $sql2 = "delete from productoptions where pid=" . $pid;
//        $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);
        for ($j = 0; $j < count($_POST['oid']); $j++) {
            if ($_POST['oid'][$j]) {
                $sql2 = "insert into productoptions (`oid`, `pid`, `value`, `price`, `incdec`, `desc`)
                values('" . $_POST['option_oid'][$j] . "','" . $pid . "','" . $_POST['option_value'][$j] . "','" . $_POST['option_price'][$j] . "','" . $_POST['option_incdec'][$j] . "','" . $_POST['option_desc'][$j] . "')";
                $q2 = mysql_query($sql2) or die(mysql_error() . $sql2);
            }
        }
        echo "<script>alert('New Product Created');window.location='index.php?p=product';</script>";
    }
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Products</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Media</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Quantity discounts</a></li>
        <li class=""><a href="#tab_1_4" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_5" data-toggle="tab">Option</a></li>
        <li class=""><a href="#tab_1_6" data-toggle="tab">SEO/Meta data</a></li>
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" action="" novalidate="novalidate">
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
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" >
                                                    <label class="col-md-2 control-label">Category <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <?php echo getoptn('category', 'name', 'id', 'category where parent = 0', 'select1', 'id="select"', '', 'None'); ?>
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Detail:</label>
                                                        <div class="col-md-10">
                                                            <textarea style="width: 500px" rows="5" class="form-control" name="description"></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Pricing / inventory  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div id="acc_pricing_inventory" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_product_code">CODE:</label>
                                                            <div class="col-md-9"> <input type="text" name="code" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_in_stock">In stock:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" name="instock" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_min_qty">Minimum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="minqty" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_max_qty">Maximum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="maxqty" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
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
            <!--            <div class="tab-pane" id="tab_1_2">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group">
                                            <table style="width:100%" id="imgtable">
                                                <thead>
                                                    <tr>
                                                        <th>Image File</th>
                                                        <th>Alt Text</th>
                                                        <th>Position</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="file" name="prodimg_name[]" value="" /></td>
                                                        <td><input type="text" name="prodimg_alttext[]" value="" class="form-control" /></td>
                                                        <td>
                                                            <select class="select1" name="prodimg_position[]">
                                                                <option>Banner(565px X 240px)</option>
                                                                <option>Home Page Center Section(450px X 300px)</option>
                                                                <option>Home Page Footer Banner(300px X 250px)</option>
                                                                <option>Product Page Image(800px X 500px)</option>
                                                            </select>
                                                        </td>
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                        $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button><a href="#" onclick="$('#imgtable tbody').append($('#imgtable tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More Images</a></button>
                                        </div>
                                        <div class="form-group has-error" style="border:none;">
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">You tube Video:</label>
                                                <div class="col-md-10" id="addvideo">
                                                    <input style="width: 95%" type="text" name="video" class="addimage form-control required has-error">
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
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div id="content_qty_discounts">
                                                <table class="table table-middle" width="100%">
                                                    <thead class="cm-first-sibling">
                                                        <tr>
                                                            <th width="5%" class=" control-label" style="text-align:left;font-weight: normal;border-radius:">Quantity</th>
                                                            <th width="20%" class=" control-label" style="text-align:left;font-weight: normal;">Value</th>
                                                            <th width="25%" class=" control-label" style="text-align:left;font-weight: normal;">Type&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a></th>
                                                            <th width="25%" class=" control-label" style="text-align:left;font-weight: normal;">User group</th>
                                                            <th width="15%">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="table-row " id="box_add_qty_discount">
                                                            <td width="5%">
                                                                <input class="form-control required has-error" type="text" name="quantity" value="" class="input-micro" style="border-radius:6px;"></td>
                                                            <td width="20%">
                                                                <input class="form-control required has-error" type="text" name="value" value="0.00" size="10" class="input-medium " style="border-radius:6px;"></td>
                                                            <td width="25%">
                                                                <select class="select1" class="span3" name="type">
                                                                    <option value="Absolute" selected="selected">Absolute (<span id="WebRupee">Rs.</span>)</option>
                                                                    <option value="Percent">Percent (%)</option>
                                                                </select></td>
                                                            <td width="25%">
                                                                <select class="select1" id="usergroup_id" name="usergroup">
                                                                    <option value="All">All</option>
                                                                    <option value="Guest">Guest</option>
                                                                    <option value="Registered">Registered</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group" style="border-top:none;margin-left: 10px;">
                                                <button><a href="#" onclick="$('#content_qty_discounts table tbody ').append($('#content_qty_discounts table tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">Add More</a></button>
                                            </div>
                                            <label class="col-md-2 control-label">Price(<span id="WebRupee">Rs.</span>) <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="price" name="price" class="form-control required has-error" style="width: 150px;border-radius: 6px;" requird><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                            </div>
                                            <label class="col-md-2 control-label">Discount <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" name="discount" class="form-control required has-error discount" style="width: 150px;border-radius: 6px; float: left;">%<label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                            </div>
                                            <label class="col-md-2 control-label">Discount Price<span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" name="discountedprice" id="discountedprice" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                            </div>
                                            <label class="col-md-2 control-label">Call For Price<span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" name="callforprice" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                            </div>
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is New Arrival<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a">
                                                        <input type="radio" name="isnewarrival" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                    <label class="radio inline" for="elm_product_status_0_h">
                                                        <input type="radio" name="isnewarrival" id="elm_product_status_0_h" value="No">No</label>
                                                </div>
                                            </div>
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is Best Deal<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isbestdeal" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isbestdeal" id="elm_product_status_0_h" value="No">No</label>
                                                </div>
                                            </div>
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is Featured<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isfeatured" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isfeatured" id="elm_product_status_0_h" value="No">No</label>
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
            <div class="tab-pane" id="tab_1_4">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="controls">
                                                <div class="control-group cm-no-hide-input">
                                                    <label class="col-md-2 control-label" for="discussion_type">Sales amount:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="salesamount" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading toolbar">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Age verification  </a> </h3>
                            <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="control-group">
                                                <label for="age_verification" class="col-md-2 control-label">Age verification:</label>
                                                <div class="col-md-9" style="margin-top: -10px;">
                                                    <input type="hidden" name="ageverification" value="N">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="age_verification" name="ageverification" value="Y">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label for="age_limit" class=" col-md-2 control-label">Age limit:</label>
                                                <div class="col-md-9">
                                                    <input class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                    <span class="year"> &nbsp; years</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label style="margin-top: 15px;" for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
                                                <div class="col-md-9" style="margin-top: 15px;">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;width:300px;" id="age_warning_message" name="warningmessage" cols="55" rows="4"></textarea>
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
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Comments and reviews   </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="controls">
                                                <div class="control-group cm-no-hide-input">
                                                    <label class="col-md-2 control-label" for="discussion_type">Reviews:</label>
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
            <div class="tab-pane" id="tab_1_5">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Options settings </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group">
                                            <table style="width:100%" class="imgtable">
                                                <thead>
                                                    <tr>
                                                        <th>Options type</th>
                                                        <th>Options Value</th>
                                                        <th> Price</th>
                                                        <th>Increment/Decrement:</th>
                                                        <th>Description:</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <?php echo getoptn('option_oid', 'name', 'id', 'options', 'select1', "", "", "None") ?>
                                                        </td>
                                                        <td><input class="form-control required has-error" style="border-radius: 6px;" type="text" id="age_limit" name="option_value[]" class="input-micro"> </td>
                                                        <td><input class="form-control required has-error" style="border-radius: 6px;" type="text" id="age_limit" name="option_price[]" class="input-micro"> </td>
                                                        <td>
                                                            <select class="select1" name="option_incdec[]" id="discussion_type">
                                                                <option value="">--Select-- </option>
                                                                <option value="+">+</option>
                                                                <option value="-">-</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control required has-error" style="border-radius: 6px;" id="age_warning_message" name="option_desc" cols="55" rows="4">
                                                        </td>
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                        $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button><a href="#" onclick="$('.imgtable tbody').append($('.imgtable tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading toolbar">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Age verification  </a> </h3>
                            <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="control-group">
                                                <label for="age_verification" class="col-md-2 control-label">Age verification:</label>
                                                <div class="col-md-9" style="margin-top: -10px;">
                                                    <input type="hidden" name="ageverification" value="N">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="age_verification" name="ageverification" value="Y">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label for="age_limit" class=" col-md-2 control-label">Age limit:</label>
                                                <div class="col-md-9">
                                                    <input class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                    <span class="year"> &nbsp; years</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label style="margin-top: 15px;" for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
                                                <div class="col-md-9" style="margin-top: 15px;">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;width:300px;" id="age_warning_message" name="warningmessage" cols="55" rows="4"></textarea>
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
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Comments and reviews   </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="controls">
                                                <div class="control-group cm-no-hide-input">
                                                    <label class="col-md-2 control-label" for="discussion_type">Reviews:</label>
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
            <div class="tab-pane" id="tab_1_6">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> SEO / Meta data </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_page_title">Page title&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                <div class="col-md-9"> <input type="text" name="metatitle" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_meta_description">Meta description:</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;" name="metadescri" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_meta_description">Meta keywords:</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;" name="metaword" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading toolbar">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Age verification  </a> </h3>
                            <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="control-group">
                                                <label for="age_verification" class="col-md-2 control-label">Age verification:</label>
                                                <div class="col-md-9" style="margin-top: -10px;">
                                                    <input type="hidden" name="ageverification" value="N">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="age_verification" name="ageverification" value="Y">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label for="age_limit" class=" col-md-2 control-label">Age limit:</label>
                                                <div class="col-md-9">
                                                    <input class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                    <span class="year"> &nbsp; years</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label style="margin-top: 15px;" for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
                                                <div class="col-md-9" style="margin-top: 15px;">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;width:300px;" id="age_warning_message" name="warningmessage" cols="55" rows="4"></textarea>
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
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Comments and reviews   </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body">
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error">
                                            <div class="controls">
                                                <div class="control-group cm-no-hide-input">
                                                    <label class="col-md-2 control-label" for="discussion_type">Reviews:</label>
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
            </div>-->
        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
        </div>
    </form>
</div>