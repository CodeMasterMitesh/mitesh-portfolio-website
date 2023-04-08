<?php
if (isset($_POST['update'])) {
    $sql = "update clients set ";
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
        echo "<script>alert('customer Updated'); </script>"; //window.location='index.php?p=searchcustomer';
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
    $sql = "update customers set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('customer Updated'); window.location='index.php?p=editcustomer&id=" . $_GET['id'] . "';</script>";
}
?> 
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit customers <a href="html.php?id=<?php echo $rdata['id'] ?>"  class="btn btn-primary btn-primary " target="_BLANK" >Html Page</a></h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Media</a></li>     
        <li class=""><a href="#tab_1_3" data-toggle="tab">Quantity discounts</a></li>
        <li class=""><a href="#tab_1_4" data-toggle="tab">Add-ons</a></li>

        <!--<li class=""><a href="#tab_1_5" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" enctype="multipart/form-data">
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
                                                                        </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button> </div> </div> </div> </div> </div>


                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>

                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Price($) <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="price" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Detail:</label>
                                                        <div class="col-md-10">
                                                            <textarea rows="5" name="_wysihtml5_mode" class="form-control wysiwyg "></textarea> 
                                                            <!--                                                            class for this = "wysiwyg"-->
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
                                                    <div style="clear:both;"></div>


                                                    
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Is Available<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isavailable" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isavailable" id="elm_product_status_0_h" value="H">No</label>


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
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Options settings </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">

                                                <div id="acc_options" class="in collapse"  style="height: auto;">

                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <label class="col-md-2 control-label">Options type: <span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select  class="select1" name="optiontype" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
                                                        </div> 
                                                        <label class="col-md-2 control-label">Exception type: <span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select   class="select1 " name="exceptiontype" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
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

                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_list_price">List price ($) &nbsp;<a class="cm-tooltip" title="Manufacturer suggested retail price."><i class="icon-question-sign"></i></a>:</label>
                                                            <div class="col-md-9"> <input type="text" name="listprice" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_in_stock">In stock:</label>
                                                            <div class="col-md-9"> <input type="text" name="instock" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>            
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <label class="col-md-2 control-label">Zero price action:<span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select class="select1"  name="zeroprice" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
                                                        </div> 
                                                        <label class="col-md-2 control-label">Inventory <span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select  class="select1" name="inventorycontrol" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
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

                                                    <div class="form-group has-error" style="border:none;"> 
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_qty_step">Quantity step:</label>
                                                            <div class="col-md-9"> <input type="text" name="quantitystep" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group has-error" style="border:none;"> 

                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_list_qty_count">List quantity count:</label>                                                                                       
                                                            <div class="col-md-9"> <input type="text" name="quantitylist" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
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
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="istaxable" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="istaxable" id="elm_product_status_0_h" value="H">No</label>


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
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> SEO / Meta data </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 
                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">

                                            <div class="form-group has-error" >
                                                <div class="control-group">
                                                    <label class="col-md-2 control-label" for="elm_category_page_title">Page title&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                    <div class="col-md-9"> <input type="text" name="metatitle" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
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
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Availability  </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">
                                            <div class="form-group has-error" >

                                                <label class="col-md-2 control-label">User groups&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="checkbox" name="usergroup" id="elm_product_status_0_a" checked="checked" value="A">All</label>

                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="checkbox" name="usergroup" id="elm_product_status_0_h" value="H">Guest</label>


                                                    <label class="radio inline" for="elm_product_status_0_d"><input type="checkbox" name="usergroup" id="elm_product_status_0_d" value="D">Registered</label>
                                                </div>
                                            </div>
                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label class="col-md-2 control-label" for="elm_category_position">Position:</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="position" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>
                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label class="col-md-2 control-label" for="elm_category_creation_date">Creation date:</label>
                                                    <div class="controls">

                                                        <div class="calendar col-md-9">
                                                            <input class="form-control required has-error" style="border-radius: 6px;width: 150px;" type="text" id="elm_category_creation_date" name="creationtable" class="cm-calendar hasDatepicker" value="09/23/2013" size="10">
                                                            <span data-ca-external-focus-id="elm_category_creation_date" class="icon-calendar cm-external-focus " style=" position: absolute;top: 10;left: 0;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">
                                                <div class="control-group">
                                                    <label class="col-md-2 control-label" for="elm_date_avail_holder">Avail since:</label>
                                                    <div class="controls">

                                                        <div class="calendar col-md-9">
                                                            <input class="form-control required has-error" style="border-radius: 6px;width: 150px;" type="text" id="elm_category_creation_date" name="availsince" class="cm-calendar hasDatepicker"  size="10">
                                                            <span data-ca-external-focus-id="elm_category_creation_date" class="icon-calendar cm-external-focus " style=" position: absolute;top: 10;left: 0;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">
                                                <div class="control-group">
                                                    <label class="col-md-2 control-label" for="elm_out_of_stock_actions">Out of stock actions&nbsp;<a class="cm-tooltip" title="Note that the 'Buy in advance' option requires a positive product amount while the 'Sign up for notification' option requires a non-positive amount. Also note that the 'Sign up for notification' option is not applied to products tracked with options."><i class="icon-question-sign"></i></a>:</label>
                                                    <div class="controls">
                                                        <select class="select1" class="span3" name="outofstock" id="elm_out_of_stock_actions">
                                                            <option value="N">None</option>
                                                            <option value="B">Buy in advance</option>
                                                            <option value="S">Sign up for notification</option>
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




            <div class="tab-pane" id="tab_1_2">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <div class="form-group has-error" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Image:</label>
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
                                                                <a href="index.php?p=editcustomer&del=image&ids=<?php echo $i; ?>&id=<?php echo $_GET['id'] ?>">Delete</a>
                                                                <input type="hidden" value="<?php echo $image[$i]; ?>" name="image[]" /><br>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-10" id="image">
                                                    <input type="file" name="image[]" class="addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                            <button><a href="#" onclick="$('#image').append($('#image input:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More Images</a></button>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Image Text:</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="imagetext" class="addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Description:</label>
                                                <div class="col-md-10">
                                                    <textarea rows="5" name="description" class="form-control  "></textarea> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Image Url:</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="imagetext" class="addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;">
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Banner:</label>
                                                <div>
                                                    <?php
                                                    $flag = 0;
                                                    $banner = array_filter(array_values(explode(',', $rdata['banner'])));
                                                    for ($i = 0; $i < count($banner); $i++) {
                                                        if ($banner[$i] && file_exists('files/' . $banner[$i])) {
                                                            $flag = 1;
                                                            echo '<img src="files/' . $banner[$i] . '"  width="400px"/>';
                                                            ?>
                                                            <div>
                                                                <a href="index.php?p=editcustomer&del=banner&ids=<?php echo $i; ?>&id=<?php echo $_GET['id'] ?>">Delete</a>
                                                                <input type="hidden" value="<?php echo $banner[$i]; ?>" name="banner[]" /><br>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-10" id="banner">
                                                    <input type="file" name="banner[]" class="addimage form-control required has-error" >               
                                                </div>
                                            </div>
                                            <button><a href="#" onclick="$('#banner').append($('#banner input:last').clone());" id="addmore" style="text-decoration: none;color:#000;">Add More</a></button>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <label class="col-md-2 control-label">Banner on Homepage<span class="required">*</span></label>
                                            <div class="col-md-10" >
                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="banneronimage" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>

                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="banneronimage" id="elm_product_status_0_h" value="No">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">You tube Video:</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="video" class="addimage form-control required has-error" >               
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

                                        <div class="form-group has-error" >

                                            <div id="content_qty_discounts" style="border-top:none;">
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
                                                                    <option value="A" selected="selected">Absolute ($)</option>
                                                                    <option value="P">Percent (%)</option>
                                                                </select></td>
                                                            <td width="25%">
                                                                <select class="select1" id="usergroup_id" name="usergroup" >
                                                                    <option value="0">All</option>
                                                                    <option value="1">Guest</option>
                                                                    <option value="2">Registered</option>
                                                                </select>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="form-group" style="border-top:none;margin-left: 10px;">
                                                <button><a href="#" onclick="$('#content_qty_discounts table tbody ').append($('#content_qty_discounts table tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">Add More</a></button>
                                            </div>




                                            <label class="col-md-2 control-label">Discount <span class="required">*</span></label> 
                                            <div class="col-md-9"> 
                                                <input type="text" name="discount" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                            </div>

                                            <label class="col-md-2 control-label">Discount Price<span class="required">*</span></label> 
                                            <div class="col-md-9"> 
                                                <input type="text" name="discountedprice" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                            </div>

                                            <label class="col-md-2 control-label">Call For Price<span class="required">*</span></label> 
                                            <div class="col-md-9"> 
                                                <input type="text" name="callforprice" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                            </div>



                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is New Arrival<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isnewarrival" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isnewarrival" id="elm_product_status_0_h" value="H">No</label>


                                                </div>
                                            </div>
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is Best Deal<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isbestdeal" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isbestdeal" id="elm_product_status_0_h" value="H">No</label>


                                                </div>
                                            </div>
                                            <div class="form-group" style="border-top:none;">
                                                <label class="col-md-2 control-label">Is Featured<span class="required">*</span></label>
                                                <div class="controls" style="float:left;">
                                                    <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isfeatured" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                    <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isfeatured" id="elm_product_status_0_h" value="H">No</label>


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

                                        <div class="form-group has-error" >

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

                                        <div class="form-group has-error" >

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
                                                    <input   class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                    <span class="year"> &nbsp; years</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-error" style="border-top:none;">

                                            <div class="control-group">
                                                <label style="margin-top: 15px;" for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
                                                <div class="col-md-9" style="margin-top: 15px;">
                                                    <textarea  class="form-control required has-error" style="border-radius: 6px;width:300px;" id="age_warning_message" name="warningmessage" cols="55" rows="4"></textarea>
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

                                        <div class="form-group has-error" >

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