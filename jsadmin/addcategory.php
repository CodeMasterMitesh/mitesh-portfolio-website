<?php
if (isset($_POST['submit'])) {
    $sql = "insert into category (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], '../productimages/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], '../productimages/' . $b['name']);
            $pb[] = $b['name'];
        }
    }
    foreach ($_POST as $a => $b) {
        if ($a != 'submit') {
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
            } else {
                $pa[] = $a;
                if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                    $pb[] = dmy2mysql($b);
                else
                    $pb[] = mysql_escape_string($b);
            }
        }
    }
    $sql .= implode('`,`', $pa) . "`) values('" . implode("','", $pb) . "')";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q)
        echo "<script>alert('New category Created');window.location='index.php?p=categories';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Category</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <!-- <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Layout</a></li> -->
        <!--        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" action="" novalidate="novalidate">
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
                                                        <?php echo getoptn('product', 'name', 'id', 'products', 'select1', 'id="select"', '', 'None'); ?><label
                                                            for="req1" generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Name <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="name"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Parameters <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="parameters"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Name Tag <span
                                                            class="required">*</span></label>
                                                    <div class="col-md-9"> <input type="text" name="tag"
                                                            class="form-control required has-error"
                                                            style="border-radius: 6px;"><label for="req1"
                                                            generated="true" class="has-error help-block"
                                                            style="color:#fff;">.</label> </div>
                                                </div>
                                                <!-- <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Header <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="header" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div> -->
                                                <!-- <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Parent <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="parent" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
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
                                                    <!--                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner1:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="banner1" class="form-control required has-error">               
                                                        </div>
                                                    </div>
                                                     <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner2:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="banner2" class="form-control required has-error">               
                                                        </div>
                                                    </div>
                                                     <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Banner3:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="banner3" class="form-control required has-error">               
                                                        </div>
                                                    </div>-->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Image:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="image" class="form-control required has-error">               
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Thumbnail:</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="thumbnail" class="form-control required has-error">               
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Start Price:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="pricestart" class="form-control required has-error">               
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">End Price:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="priceend" class="form-control required has-error">               
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">No.Of Products:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="noofproducts" class="form-control required has-error">               
                                                        </div>
                                                    </div> -->

                                                    <!-- <div class="form-group" style="border-top:none;">
                                                        <div class="form-group has-error" style="border-top:none;">
                                                            <label class="col-md-2 control-label"> Subcat Image<span class="required">*</span></label>
                                                            <div class="col-md-10" >
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="islistsubcatimg" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>
                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="islistsubcatimg" id="elm_product_status_0_h" value="H">No</label>
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
                                                            <textarea class="form-control required has-error" style="border-radius: 6px;" name="metakeyword" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
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
                                                    <div class="col-md-9">
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
                                                <label for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
                                                <div class="col-md-9">
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
            </div> -->
            <!-- <div class="tab-pane" id="tab_1_3">
                <div class="widget">
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
                                                <label class="col-md-2 control-label" for="elm_category_product_layout">Product details layout&nbsp;<a class="cm-tooltip" title="By default, the template that is defined in the appearance settings of the storefront is used"><i class="icon-question-sign"></i></a>:</label>
                                                <div class="col-md-9">
                                                    <select class="select1" id="elm_category_product_layout" name="productdetail">
                                                        <option value="default">Parent (Default template)</option>
                                                        <option value="default_long_options_template">Default template (long product option names)</option>
                                                        <option value="default_template">Default template</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label for="age_verification" class="col-md-2 control-label">Use custom layout:</label>
                                                <div class="col-md-9">
                                                    <input type="hidden" name="customlayout" value="N">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="age_verification" name="customlayout" value="Y">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">
                                            <div class="control-group">
                                                <label for="age_limit" class=" col-md-2 control-label">Product columns:</label>
                                                <div class="col-md-9">
                                                    <input   class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="productcolumn" size="10" maxlength="2" class="input-micro">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <label class="col-md-2 control-label">Available layouts:</label>
                                            <div class="controls" style="float:left;">
                                                <label class="radio inline" for="elm_product_status_0_a"><input type="checkbox" name="availablelayout" id="elm_product_status_0_a" checked="checked" value="A">Grid</label>
                                                <label class="radio inline" for="elm_product_status_0_h"><input type="checkbox" name="availablelayout" id="elm_product_status_0_h" value="H">List without options</label>
                                                <label class="radio inline" for="elm_product_status_0_d"><input type="checkbox"  name="availablelayout" id="elm_product_status_0_d" value="D">Compact list</label>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_default_layout">Default category layout:</label>
                                                <div class="controls">
                                                    <select class="select1" id="elm_category_default_layout" class="cm-combo-select cm-toggle-element" name="defaultcategory">
                                                        <option value="products_multicolumns">Grid</option>
                                                        <option value="products_without_options">List without options</option>
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
            <input type="submit" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;"
                name="submit" />
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
        </div>
    </form>
</div>