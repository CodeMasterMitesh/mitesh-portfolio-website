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
        <h3>New Features</h3>
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
                                                        <label for="elm_filter_name_0" class="col-md-2 control-label">Name:<span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;" value="">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_code_0">Feature code:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" size="3" name="feature_data[feature_code]" value="" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" id="elm_feature_code_0">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_filter_position_0">Position:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group has-error" style="border-top:none;">
                                                    <label class="col-md-2 control-label">Description:</label>
                                                    <div class="col-md-10">
                                                        <textarea name="description"></textarea>
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



                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label cm-required" for="elm_feature_type_0">Type<span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <select class="select1" name="feature_data[feature_type]" id="elm_feature_type_0" data-ca-feature-id="0" class="cm-feature-type">
                                                                <optgroup label="Check box">
                                                                    <option value="C">Single</option>
                                                                    <option value="M">Multiple</option>
                                                                </optgroup>
                                                                <optgroup label="Select box">
                                                                    <option value="S">Text</option>
                                                                    <option value="N">Number</option>
                                                                    <option value="E">Brand/Manufacturer</option>
                                                                </optgroup>
                                                                <optgroup label="Others">
                                                                    <option value="T">Text</option>
                                                                    <option value="O">Number</option>
                                                                    <option value="D">Date</option>
                                                                </optgroup>
                                                            </select>
                                                            <div class="error-message feature_type_0" style="display: none" id="warning_feature_change_0"><div class="arrow"></div><div class="message"><p>Clicking on Save will remove product variants.</p></div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_group_0">Group</label>
                                                        <div class="col-md-10">
                                                            <select class="select1" name="feature_data[parent_id]" id="elm_feature_group_0" data-ca-feature-id="0" class="cm-feature-group">
                                                                <option value="0">-None-</option>
                                                                <option data-ca-display-on-product="Y" data-ca-display-on-catalog="Y" data-ca-display-on-header="N" value="14">Electronics</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_display_on_product_0">Show on the Features tab&nbsp;<a class="cm-tooltip" title="If enabled, the product feature is displayed on the product details page in the storefront"><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" name="feature_data[display_on_product]" value="N">
                                                            <input type="checkbox" name="feature_data[display_on_product]" value="Y" data-ca-display-id="OnProduct">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_display_on_header_0">Show in product header&nbsp;<a class="cm-tooltip" title="If enabled, the feature is shown under the product header"><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" name="feature_data[display_on_product]" value="N">
                                                            <input type="checkbox" name="feature_data[display_on_product]" value="Y" data-ca-display-id="OnProduct">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_display_on_catalog_0">Show in product list&nbsp;<a class="cm-tooltip" title="If enabled, the product feature is displayed on catalog pages (product list pages)"><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" name="feature_data[display_on_product]" value="N">
                                                            <input type="checkbox" name="feature_data[display_on_product]" value="Y" data-ca-display-id="OnProduct">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_prefix_0">Prefix&nbsp;<a class="cm-tooltip" title="An affix that precedes the product feature."><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_feature_suffix_0">Suffix&nbsp;<a class="cm-tooltip" title="An affix that follows the product feature."><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
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