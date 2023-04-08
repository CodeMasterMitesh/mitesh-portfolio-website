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
    // debug($_POST);
    if ($q)
        echo "<script>alert('New Product Created'); window.location='index.php?p=vieweditproduct';</script>";
}
?>




<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Filters</h3>
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